<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $loginService;

    public function __construct(LoginService $loginService) {
        $this->loginService = $loginService;
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $auth = $this->loginService->execute($credentials);

        try {
            return response()->json(['status' => true, 200]);
        } catch(\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }
}
