<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    // Retorna 403 (acesso negado) se o papel não estiver na lista da rota.
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        abort_unless($request->user() && in_array($request->user()->role, $roles, true), 403, 'Você não tem permissão para acessar esta área.');

        return $next($request);
    }
}
