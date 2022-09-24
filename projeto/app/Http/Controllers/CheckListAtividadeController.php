<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\CheckListAtividade;
use App\Models\CheckList;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;


use Exception;

/**
 * @package namespace App\Http\Controllers;
 */
class CheckListAtividadeController extends Controller
{

    public function index($iCodigoCheckList)
    {
        $oAtividades = $this->getAtividadesFromCheckList($iCodigoCheckList);
        return view('checklistatividade.index', [
            'iCodigoCheckList' => $iCodigoCheckList,
            'oAtividades' => compact('oAtividades')
        ]);
    }

    public function create($iCodigoCheckList)
    {
        $oCheckListUsuario = $this->getCheckListUsuario();
        return view('checklistatividade.create', compact('oCheckListUsuario'));
    }

    public function store(Request $request)
    {
        $oData = $request->all();

        dd('oi');
     
        if (isset($oData['descricao'])) {

            foreach ($oData['descricao'] as $iChave => $sAtividade) {
                $iMaxCodigo = $this->getMaxCodigo($request['id_checklist']);
                DB::table('check_list_atividades')->insert(
                    [
                        'id' =>$iMaxCodigo ? $iMaxCodigo +1 : 1,
                        'descricao' => $sAtividade,
                        'id_checklist' => $request['id_checklist']
                    ]
                );
            }
        } else {
            return response()->json( 'Nenhuma atividade foi informada!');
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

    private function getMaxCodigo($iIdCheckList) {
        return DB::table('check_list_atividades')->where([
            ['id_checklist', '=',$iIdCheckList]
        ])->groupBy(['id_checklist'])->max('id');
    }

    private function getAtividadesFromCheckList($iCodigoCheckList) {
        return CheckListAtividade::query()->where('id_checklist', '=', $iCodigoCheckList)->get();
    }
}
