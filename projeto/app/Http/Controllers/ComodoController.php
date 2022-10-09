<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Projeto;
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

    public function store(Request $request)
    {
        $oData = $request->all();
     
        if (isset($oData['id_projeto'])) {


                $iMaxIDComodoProjeto = $this->getMaxCodigo($request['id_projeto']);


                DB::table('comodo')->insert(
                    [
                        'id' =>$iMaxIDComodoProjeto ? $iMaxIDComodoProjeto +1 : 1,
                        'id_projeto' => $request['id_projeto'],
                        'nome' => $request['nome'],
                        'descricao' => $request['descricao']
                    ]
                );
            
        } else {
            return response()->json( 'Não foi possível realizar o cadastro do cômodo!');
        }

        return redirect()->route('usuario_atendimento.index');
    }

    private function getMaxCodigo($iIdProjeto) {
        return DB::table('comodo')->where([
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
}
