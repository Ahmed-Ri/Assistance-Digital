<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Assurez-vous que l'utilisateur est connecté et que son statut est 'approved'
        if (Auth::check() && Auth::user()->status !== 'vérifié') {
            Auth::logout();
            // Redirigez les utilisateurs non approuvés vers la page d'accueil avec un message d'erreur
            return redirect('/login')->with('error', 'Votre compte n\'est pas encore vérifié.');
        }

        return $next($request);
    }
}
