# Lista de Atividades — Laravel

Sistema de alunos com Laravel 12, PHP 8.2+, Blade, SQLite, Eloquent e Laravel Breeze. As **23 atividades e os desafios** estão organizados em **12 branches cumulativas**, com um commit por atividade. A versão completa está em **tema-12-policies**, na pasta `ListaDeAtividades-Laravel`.

## Executar neste computador

As dependências já foram instaladas e o banco local foi preparado. No terminal da pasta do repositório:

```powershell
cd ListaDeAtividades-Laravel
php artisan serve
```

Acesse http://127.0.0.1:8000. Depois de alterar CSS ou JavaScript, execute `npm run build`.

## Instalar após clonar

Requisitos: PHP 8.2+ com extensões do Laravel e `pdo_sqlite`, Composer e Node.js 22+ com npm.

```powershell
git clone --branch tema-12-policies https://github.com/Rh4yanna/AtivsBack-end.git
cd AtivsBack-end/ListaDeAtividades-Laravel
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite
php artisan migrate --seed
npm ci
npm run build
php artisan serve
```

No Linux/macOS, use `cp .env.example .env` e `touch database/database.sqlite` em vez dos comandos PowerShell correspondentes. O `.env.example` usa SQLite. `.env`, banco SQLite, `vendor` e `node_modules` ficam fora do Git. A clonagem desta branch pressupõe sua publicação no GitHub.

## Contas de demonstração

| Papel | E-mail | Senha local |
| --- | --- | --- |
| Administrador | admin@example.com | Laravel@123 |
| Professor | professor@example.com | Laravel@123 |

O seeder cria 10 alunos e 2 cursos e vincula os alunos ao professor de demonstração. Executá-lo novamente não duplica esses registros; restaura os dados demonstrativos e as senhas dessas duas contas. Use essas credenciais apenas para a atividade local.

Novas contas registradas pelo Breeze recebem o papel `professor`. O registro público não permite escolher `admin`.

## Permissões

| Ação | Visitante | Professor | Administrador |
| --- | --- | --- | --- |
| Home, sobre, contato e exemplos com parâmetro | Sim | Sim | Sim |
| Consultar alunos e alunos por curso | Não | Sim | Sim |
| Cadastrar e excluir aluno | Não | Não | Sim |
| Editar aluno | Não | Apenas alunos vinculados a ele | Sim |
| Escolher professor responsável | Não | Não | Sim |
| `/admin` | Não | Não | Sim |
| `/professor` | Não | Sim | Sim |

`AlunoPolicy` é descoberta automaticamente pelo Laravel pela convenção de nomes. O controller e o `AlunoRequest` verificam autorização no servidor; as views usam `@can`. O administrador escolhe o professor responsável no formulário. O professor não pode trocar esse vínculo por uma requisição manipulada.

Relacionamentos: `User hasMany Aluno`, `Aluno belongsTo User`, `Curso hasMany Aluno` e `Aluno belongsTo Curso`. Excluir um usuário deixa seus alunos sem responsável; excluir um curso com alunos é impedido pela chave estrangeira.

## Atividades e branches

| Branch | Atividades | Onde conferir |
| --- | --- | --- |
| `tema-01-rotas` | 1 e 2 | `routes/web.php`: textos e parâmetros |
| `tema-02-controllers` | 3 e 4 | `AlunoController`, sete métodos e `Route::resource` |
| `tema-03-views` | 5 e 6 | `resources/views/alunos` |
| `tema-04-blade` | 7, 8 e 9 + desafio | `layouts/app.blade.php`, home, páginas de alunos e `partials/menu.blade.php` |
| `tema-05-models-eloquent` | 10 e 11 | Model Aluno, migration e `routes/console.php` |
| `tema-06-seeders` | 12 | `AlunoSeeder`: dez alunos |
| `tema-07-crud` | 13 | Persistência nos sete métodos do controller |
| `tema-08-forms-requests` | 14 e 15 + desafio | Formulários, `AlunoRequest` e mensagens em português |
| `tema-09-relacionamentos` | 16 e 17 + desafio | Model Curso, chave estrangeira e `cursos/show.blade.php` |
| `tema-10-autenticacao` | 18, 19 e 20 | Breeze, relacionamento User/Aluno e coluna role |
| `tema-11-middleware` | 21 | `EnsureRole`, alias em `bootstrap/app.php`, `/admin` e `/professor` |
| `tema-12-policies` | 22 e 23 | `AlunoPolicy`, autorização do CRUD e testes |

Cada branch parte do tema anterior. As primeiras são etapas didáticas; execute a aplicação completa na última. Na ATV 1, `/alunos` retorna texto; a partir da ATV 4, essa URL passa a ser o índice do CRUD, preservando a versão original no histórico. A migration do relacionamento converte o curso textual em chave estrangeira e preserva os nomes existentes.

## Rotas e consultas

```text
GET     /alunos                 index
GET     /alunos/create          create
POST    /alunos                 store
GET     /alunos/{aluno}         show
GET     /alunos/{aluno}/edit    edit
PUT     /alunos/{aluno}         update (também PATCH)
DELETE  /alunos/{aluno}         destroy
GET     /cursos/{curso}         alunos de um curso
```

As rotas da ATV 2 são `/produto/{id}`, `/categoria/{id}` e `/usuario/{id}`. A listagem permite filtrar nome, curso e alunos dos últimos 30 dias. Demonstre as quatro consultas Eloquent pelo terminal:

```powershell
php artisan alunos:consultar "Informática" "Ana"
php artisan route:list
```

## Verificação

```powershell
php artisan test
npm run build
```

Os testes usam SQLite em memória, separado do banco demonstrativo. Cobrem Breeze, CRUD, validações, filtros, seeders, relacionamentos, middleware, autorização por registro e proteção do papel admin. A recuperação de senha usa o mailer `log` padrão local: os e-mails aparecem em `storage/logs/laravel.log`.

## Entrega

Repositório configurado: https://github.com/Rh4yanna/AtivsBack-end. Para publicar apenas as 12 branches desta lista, execute na pasta do repositório:

```powershell
git push origin tema-01-rotas tema-02-controllers tema-03-views tema-04-blade tema-05-models-eloquent tema-06-seeders tema-07-crud tema-08-forms-requests tema-09-relacionamentos tema-10-autenticacao tema-11-middleware tema-12-policies
```

Depois, poste na plataforma da atividade o link do repositório e informe a branch `tema-12-policies` e a pasta `ListaDeAtividades-Laravel`. Para conferir os commits: `git log --oneline tema-12-policies -- ListaDeAtividades-Laravel`.

## Referências oficiais

- [Documentação Laravel 12](https://laravel.com/docs/12.x)
- [Código e compatibilidade do Breeze](https://github.com/laravel/breeze)
- [Instalação do Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)
