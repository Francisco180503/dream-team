<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Redirigir según el rol
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.index'); // Redirige a admin
            } elseif ($user->hasRole('auditor')) {
                return redirect()->route('auditor.index'); // Redirige a auditor
            } elseif ($user->hasRole('denunciante')) {
                return redirect()->route('denunciante.index'); // Redirige a denunciante
            }
        }

        return $next($request);
    }
}
