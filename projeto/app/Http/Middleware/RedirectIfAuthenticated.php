<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthController;

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
                'name'     => 'Leonardo da Rocha Ferrari',
                'birth'    => '1999-05-04',
                'password' => Hash::make('123456'),
                'email'    => 'leonardo.ferrari@unidavi.edu.br',
            ]);
        }
        return redirect()->route('login');
    }
}
