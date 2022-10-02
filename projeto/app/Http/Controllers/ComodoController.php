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
        // dd($iProjeto);
        return view('comodo.index', compact('oProjetos'));
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

    public function destroy($id_municipio)
    {
        //fazer
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', session('id_user')],
            ['id_municipio', '=', $id_municipio],
        ])->delete();

        return redirect()->route('checklistatividade.index');
    }

    private function getCheckListUsuario() {
        $oQuery = CheckList::query()->select(['check_lists.id', 'check_lists.nome'])->join('users', 'check_lists.id_usuario', '=', 'users.id')
                                            ->where('users.id', '=', session('id_user'));
        return $oQuery->get();
    }

    private function getMaxCodigo($iIdProjeto) {
        return DB::table('comodo')->where([
            ['id_projeto', '=',$iIdProjeto]
        ])->groupBy(['id_projeto'])->max('id');
    }
}
