<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

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
    public function handle(Request $request, Closure $next, ...$guards)
    {

        if (session()->has('jwt-token')) {
            return $next($request);
        }

        if (count(User::all()) == 0) {
            User::create([
                'nome'     => 'Leonardo da Rocha Ferrari',
                'data_nasc'    => '1999-05-04',
                'password' => bcrypt('123456'),
                'email'    => 'leonardo.ferrari@unidavi.edu.br',
            ]);
        }
        return redirect()->route('login');
    }
}
