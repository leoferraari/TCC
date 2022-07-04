<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\{TokenExpiredException, TokenInvalidException};

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();         
        } catch (Exception $exception) {
            dd('caiu');
            if ($exception instanceof TokenInvalidException){
                return response()->json(['message' => 'Token is Invalid'], 401);
            }else if ($exception instanceof TokenExpiredException){
                return response()->json(['message' => 'Token is Expired'], 401);
            }else{
                return response()->json(['message' => $exception->getMessage()], 401);
            }
        }
        return $next($request);
    }
}
