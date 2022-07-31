<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EnderecoUser;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    

        $validator = Validator::make($request->only(['email', 'password']), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

     
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
     
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        $token = $this->createNewToken($token);
        session(['jwt-token' => $token]);
        session(['id_user' => auth()->user()->id]);

      
        // return response()->json($token, 200);
        return redirect()->route('motivacao');
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|between:2,30',
            'sobrenome' => 'required|string|between:2,50',
            'apelido' => 'string|between:2,20',
            'email' => 'required|string|email|max:50|unique:users',
            'data_nasc' => 'required|date',
            'cpf' => 'required|between:2,11',
            'crea' => 'required|between:2,10',
            'celular' => 'required|between:0,11',
            'telefone_fixo' => 'required|between:0,11',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required ',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $this->insereEndereco($request, $user);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    private function insereEndereco(Request $request, $user) {
        EnderecoUser::create(   
            [
                'complemento' => $request->complemento,
                'numero_endereco' => $request->numero_endereco,
                'bairro' => $request->bairro,
                'cidade' => $request->municipio,
                'cep' => $request->cep,
                'id_usuario' => $user->id
            ]
        );
    }


    public function logoutSession() {
        auth()->logout(true);
        session(['jwt-token' => false]);
        session()->forget('jwt-token');
        return redirect()->route('login');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

//     public function update(Request $request){
// dd('oi');
//     }

}
