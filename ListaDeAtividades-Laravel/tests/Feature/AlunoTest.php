<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlunoTest extends TestCase
{
    use RefreshDatabase;

    private function user(string $role = 'professor'): User
    {
        return User::factory()->create(['role' => $role]);
    }

    private function data(): array
    {
        return ['nome' => 'Ana Teste', 'email' => 'ana@example.com', 'curso_id' => Curso::firstOrCreate(['nome' => 'Informática'])->id];
    }

    public function test_public_routes_and_guest_protection(): void
    {
        foreach (['/', '/sobre', '/contato', '/login', '/register'] as $url) {
            $this->get($url)->assertOk();
        }
        foreach (['produto', 'categoria', 'usuario'] as $recurso) {
            $this->get('/'.$recurso.'/42')->assertOk()->assertSee('42');
        }
        $this->get('/alunos')->assertRedirect('/login');
        $this->post('/alunos', $this->data())->assertRedirect('/login');
    }

    public function test_admin_can_complete_crud(): void
    {
        $admin = $this->user('admin');
        $professor = $this->user();
        $data = $this->data() + ['user_id' => $professor->id];
        $this->actingAs($admin)->get('/alunos/create')->assertOk();
        $this->post('/alunos', $data)->assertSessionHasNoErrors()->assertRedirect();
        $aluno = Aluno::firstOrFail();
        $this->assertDatabaseHas('alunos', $data);
        foreach (['/alunos', '/alunos/'.$aluno->id, '/alunos/'.$aluno->id.'/edit', '/cursos/'.$aluno->curso_id, '/admin', '/professor', '/dashboard', '/profile'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->put('/alunos/'.$aluno->id, array_replace($data, ['nome' => 'Ana Atualizada']))->assertSessionHasNoErrors();
        $this->assertDatabaseHas('alunos', ['id' => $aluno->id, 'nome' => 'Ana Atualizada']);
        $this->delete('/alunos/'.$aluno->id)->assertRedirect('/alunos');
        $this->assertDatabaseMissing('alunos', ['id' => $aluno->id]);
    }

    public function test_professor_can_only_edit_assigned_students_and_cannot_reassign(): void
    {
        $professor = $this->user();
        $other = $this->user();
        $aluno = Aluno::create($this->data() + ['user_id' => $professor->id]);
        $this->actingAs($professor)->get('/alunos/'.$aluno->id.'/edit')->assertOk();
        $this->put('/alunos/'.$aluno->id, array_replace($this->data(), ['nome' => 'Nome editado', 'user_id' => $other->id]))->assertSessionHasNoErrors();
        $this->assertDatabaseHas('alunos', ['id' => $aluno->id, 'nome' => 'Nome editado', 'user_id' => $professor->id]);
        $this->get('/alunos/create')->assertForbidden();
        $this->post('/alunos', $this->data())->assertForbidden();
        $this->delete('/alunos/'.$aluno->id)->assertForbidden();
        $this->get('/admin')->assertForbidden();
        $this->get('/professor')->assertOk();
        $this->actingAs($other)->get('/alunos/'.$aluno->id.'/edit')->assertForbidden();
        $this->put('/alunos/'.$aluno->id, $this->data())->assertForbidden();
        $this->get('/alunos/'.$aluno->id)->assertOk()->assertDontSee('>Editar</a>', false)->assertDontSee('Excluir aluno');
    }

    public function test_validation_unique_email_and_foreign_keys(): void
    {
        $this->actingAs($this->user('admin'));
        $this->post('/alunos', [])->assertSessionHasErrors(['nome', 'email', 'curso_id']);
        $this->assertSame('O campo nome é obrigatório.', session('errors')->first('nome'));
        $aluno = Aluno::create($this->data());
        $this->post('/alunos', $this->data())->assertSessionHasErrors('email');
        $this->put('/alunos/'.$aluno->id, $this->data())->assertSessionHasNoErrors();
        $this->put('/alunos/'.$aluno->id, array_replace($this->data(), ['curso_id' => 999]))->assertSessionHasErrors('curso_id');
        $this->put('/alunos/'.$aluno->id, $this->data() + ['user_id' => auth()->id()])->assertSessionHasErrors('user_id');
        $this->get('/alunos/99999')->assertNotFound();
    }

    public function test_seeders_filters_and_relationships(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);
        $this->assertDatabaseCount('alunos', 10);
        $this->assertDatabaseCount('cursos', 2);
        $this->assertSame(5, Aluno::doCurso('Informática')->count());
        $this->assertSame(1, Aluno::nomeContem('Ana')->count());
        $this->assertSame(10, Aluno::recentes()->count());
        $aluno = Aluno::firstOrFail();
        $aluno->created_at = now()->subDays(31);
        $aluno->save();
        $this->assertSame(9, Aluno::recentes()->count());
        $professor = User::where('email', 'professor@example.com')->firstOrFail();
        $this->assertSame(10, $professor->alunos()->count());
        $this->actingAs($professor)->get('/alunos?nome=Ana')->assertOk()->assertSee('Ana Silva')->assertDontSee('Bruno Lima');
        $this->get('/cursos/'.$aluno->curso_id)->assertOk()->assertSee('Ana Silva')->assertDontSee('Bruno Lima');
    }

    public function test_registration_cannot_grant_admin_role(): void
    {
        $this->post('/register', ['name' => 'Novo Professor', 'email' => 'novo@example.com', 'password' => 'password', 'password_confirmation' => 'password', 'role' => 'admin'])->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', ['email' => 'novo@example.com', 'role' => 'professor']);
    }
}
