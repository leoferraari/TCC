<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Comodo;
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
class ComodoController extends Controller
{

    public function index($iProjeto)
    {
        return view('comodo.index', ['iProjeto' => $iProjeto, 'aComodos' => $this->getComodosFromProjeto($iProjeto)]);
    }

    public function create($iProjeto)
    {
        return view('comodo.create', ['iProjeto' => $iProjeto]);
    }

    public function addComodo(Request $request)
    {     
        $id =  $this->getMaxCodigo($request['id_projeto'])+1;
        DB::table('comodos')->insert(
            [
                'id' => $id,
                'id_projeto' => $request['id_projeto'],
                'nome' => $request['nome'],
                'descricao' => $request['descricao']
            ]
        );

        return $this->responseJsonSuccess([
            'message' => 'Cômodo inserido com sucesso!',
            'data'    => $request
        ]);
    }

    public function destroy($iComodo, $iProjeto)
    {
        $users = DB::table('comodos')->where('id', '=', $iComodo)->where('id_projeto', '=', $iProjeto)->delete();        
        return response()->json($iProjeto, 200)->header('Content-Type', 'application/json');
    }

    private function getMaxCodigo($iIdProjeto) {
        return DB::table('comodos')->where([
            ['id_projeto', '=',$iIdProjeto]
        ])->groupBy(['id_projeto'])->max('id');
    }


    private function getComodosFromProjeto($iProjeto) {
        return DB::select(sprintf('select id,
                                          nome,
                                          descricao
                                    from comodos
                                   where id_projeto = %d
                            ', $iProjeto));
    }

    public function getComodo($iComodo, $iProjeto) {
        return DB::select(sprintf('select *
                                    from comodos
                                   where id = %d
                                     and id_projeto = %d
                            ', $iComodo, $iProjeto))[0];
    }

    public function update(Request $request) {

        $update = Comodo::where('id', $request->id)->where('id_projeto', $request->id_projeto)                
        ->update([
            'nome'     => $request->nome,
            'descricao' => $request->descricao,
        ]);

        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    }
}
