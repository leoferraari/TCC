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
        return view('usuario_atendimento.index', ['iUsuario' => session('id_user'), 'oUsuarioAtendimentos' => $oUsuariosAtendimentos]);
    }

    public function create()
    {
        return view('usuario_atendimento.create');
    }

    public function store(Request $request)
    {

        $oData = $request->all();
    
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

    // public function destroy($id_municipio, $id_usuario)
    // {
    //     $users = DB::table('usuario_atendimentos')->where([
    //         ['id_usuario', '=', $id_usuario],
    //         ['id_municipio', '=', $id_municipio],
    //     ])->delete();

    //     // return response()->json($users, 200)
    //     // ->header('Content-Type', 'application/json');
    // }

    
    public function delete($id_municipio, $id_usuario)
    {
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', $id_usuario],
            ['id_municipio', '=', $id_municipio],
        ])->delete();

        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    }

    public function delete_todos($id_usuario)
    {
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', $id_usuario],
        ])->delete();

        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    }



    private function getUsuarioAtendimento() {
        return DB::select('
                          select municipios.id as codigo_cidade,
                                 municipios.nome as nome_cidade,
                                 estados.nome as nome_estado,
                                 estados.sigla as sigla_estado
                            from usuario_atendimentos
                            join municipios 
                                on municipios.id = usuario_atendimentos.id_municipio
                            join estados 
                                on estados.id = municipios.estado_id
                            where id_usuario = '. session('id_user').'
                        ');
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
