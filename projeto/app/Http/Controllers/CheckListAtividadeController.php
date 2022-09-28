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
            'oAtividades' => $oAtividades
        ]);
    }

    public function create($iCodigoCheckList)
    {
        $oCheckListUsuario = $this->getCheckListUsuario($iCodigoCheckList);
        return view('checklistatividade.create', compact('oCheckListUsuario'));
    }

    public function store(Request $request)
    {
        $oData = $request->all();
     
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


        return redirect()->route('check_list');
    }

    private function getCheckListUsuario($iCodigoCheckList) {
        return DB::select(sprintf('select *
                                     from check_lists
                                    where id = %d
                            ', $iCodigoCheckList));
    }

    private function getMaxCodigo($iIdCheckList) {
        return DB::table('check_list_atividades')->where([
            ['id_checklist', '=',$iIdCheckList]
        ])->groupBy(['id_checklist'])->max('id');
    }

    private function getAtividadesFromCheckList($iCodigoCheckList) {
        return DB::select(sprintf('select *
                                     from check_list_atividades
                                    where id_checklist = %d
                                    order by id
                            ', $iCodigoCheckList));
    }

    public function addAtividadeCheckList(Request $request) {
        foreach ($request->atividades as $value) {

            DB::table('check_list_atividades')->insert(
                [
                    'id' => $this->getMaxCodigo($request->id_checklist)+1,
                    'id_checklist' => $request->id_checklist,
                    'descricao' => $value,
                ]
            );

        }

        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    }

    public function getAtividadeCheckList($iCheckList, $iAtividade) {
        return DB::select(sprintf('select *
                                    from check_list_atividades
                                where id = %d
                                    and id_checklist = %d 
                            ', $iAtividade, $iCheckList))[0];
    }

    public function update(Request $request) {
        $update = CheckListAtividade::where('id', $request->atividade)->where('id_checklist', $request->id_checklist)
                        
        ->update([
            'descricao' => $request->descricao,
        ]);

        return response()->json('Alterado com sucesso!', 200)->header('Content-Type', 'application/json');
    }

    public function destroy($iCodigoCheckList, $iAtividade) {


        $users = DB::table('check_list_atividades')->where([
            ['id_checklist', '=', $iCodigoCheckList],
            ['id', '=', $iAtividade],
           
        ])->delete();


        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    
    }
}
