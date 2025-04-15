<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                // Redirect based on user role
                switch ($user->role) {
                    case 'mahasiswa':
                        return redirect()->route('mahasiswa.dashboard');
                    case 'ketua':
                        return redirect()->route('ketua.dashboard');
                    case 'tatausaha':
                        return redirect()->route('tatausaha.dashboard');
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}