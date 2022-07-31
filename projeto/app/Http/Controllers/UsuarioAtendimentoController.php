<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\UsuarioAtendimento;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\States\StatesStoreRequest;
use App\Http\Requests\States\StatesUpdateRequest;


use Illuminate\Http\Request;


use Exception;

/**
 * @package namespace App\Http\Controllers;
 */
class UsuarioAtendimentoController extends Controller
{

    public function index()
        //VER
    {
        $oUsuariosAtendimentos = $this->getUsuarioAtendimento();
        return view('usuario_atendimento.index', compact('oUsuariosAtendimentos'));
    }

    public function create()
    {
        return view('usuario_atendimento.create');
    }

    public function store(Request $request)
    {

        $oData = $request->all();
    
        // dd($oData);
        if (isset($oData['municipios'])) {
            foreach ($oData['municipios'] as $iCidade) {

                DB::table('usuario_atendimentos')->insert(
                    [
                        'id_usuario' => session('id_user'),
                        'id_municipio' => $iCidade,
                    ]
                );
            }
        } else {
            return response()->json( 'Nenhuma cidade foi selecionada!');
        }

        return redirect()->route('usuario_atendimento.create');
    }

    public function destroy($id_municipio)
    {
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', session('id_user')],
            ['id_municipio', '=', $id_municipio],
        ])->delete();

        return redirect()->route('check_list');
    }

    private function getUsuarioAtendimento() {
        $oQuery = UsuarioAtendimento::query()->join('users', 'usuario_atendimentos.id_usuario', '=', 'users.id')
                                            ->where('users.id', '=', session('id_user'));
        return $oQuery->get();
    }

    public function cid_atendimento($iCidCodigo, $iUsuario) {
        $oQuery = UsuarioAtendimento::query()->where([
            ['id_municipio', '=', $iCidCodigo],
            ['id_usuario', '<>', session('id_user')]
        ]);

        $usuarios_atendimento = DB::select('
            select users.id,
                   users.nome 
              from usuario_atendimentos
              join users
                on users.id = usuario_atendimentos.id_usuario
             where id_municipio = '.$iCidCodigo.'
               and id_usuario <> '.$iUsuario.'
        ');

        return response()->json($usuarios_atendimento, 200)
            ->header('Content-Type', 'application/json');
    }
}
