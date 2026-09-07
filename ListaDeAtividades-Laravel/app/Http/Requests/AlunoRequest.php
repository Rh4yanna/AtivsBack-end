<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AlunoRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array { return ['nome' => ['required','string','min:3','max:255'], 'email' => ['required','email','max:255', Rule::unique('alunos')->ignore($this->route('aluno'))], 'curso' => ['required','string','max:255']]; }
    public function messages(): array { return ['required' => 'O campo :attribute é obrigatório.', 'nome.min' => 'O nome deve ter pelo menos 3 caracteres.', 'email.email' => 'Informe um e-mail válido.', 'email.unique' => 'Este e-mail já está cadastrado.', 'max' => 'O campo :attribute deve ter no máximo :max caracteres.', 'exists' => 'O :attribute selecionado não existe.']; }
    public function attributes(): array { return ['nome' => 'nome', 'email' => 'e-mail', 'curso_id' => 'curso', 'user_id' => 'professor']; }
}
