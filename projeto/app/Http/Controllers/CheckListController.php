<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
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
class CheckListController extends Controller
{

     /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    private $checklist = null;

    public function __construct(CheckList $checklist) {
        $this->checklist = $checklist;
    }

    public function index()
        //VER
    {
        $oCheckLists = $this->getCheckListsByUsuario();

        return view('checklist.index', ['oCheckLists' => $oCheckLists, 'id_usuario' => session('id_user')]);
    }

    public function create()
    {
        return view('checklist.create');
    }

    public function store(Request $request)
    {

        $oData = $request->all();
        $oData['id_usuario'] = session('id_user');

        CheckList::create($oData);

        return redirect()->route('check_list');
    }

    public function destroy($iCodigoCheckList, $iCodigoUsuario)
    {
        $users = DB::table('check_lists')->where('id', '=', $iCodigoCheckList)->where('id_usuario', '=', $iCodigoUsuario)->delete();        
        return response()->json($iCodigoCheckList, 200)->header('Content-Type', 'application/json');
    }

    private function getCheckListsByUsuario() {
        return CheckList::query()->orderBy('id')->where('id_usuario', '=', session('id_user'))->get();
    }
    
    public function addCheckList(Request $request) {

        try {
            $this->checklist->addCheckList($request);
            return $this->responseJsonSuccess([
                'message' => 'CheckList inserido com sucesso!',
                'data'    => $request
            ]);
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro ao realizar ao realizar o seu cadastro!'
            ], $error);
        }

        // response()->json($this->checklist->addCheckList($request), 201)->header('Content-Type', 'application/json');
    }

    public function getCheckList($iCheckList, $iUsuario) {
        return DB::select(sprintf('select *
                                    from check_lists
                                   where id = %d
                                     and id_usuario = %d 
                            ', $iCheckList, $iUsuario))[0];
    }

    public function update(Request $request) {

        $update = CheckList::where('id', $request->id)->where('id_usuario', $request->id_usuario)
                        
        ->update([
            'nome'     => $request->nome,
            'descricao' => $request->descricao,
        ]);

        return response()->json('Removido com sucesso!', 200)->header('Content-Type', 'application/json');
    }

    public function getAtividadesCheckList($iCheckList, $iUsuario) {
        return DB::select(sprintf('select check_list_atividades.descricao
                                     from check_lists
                                     join check_list_atividades
                                       on check_lists.id = check_list_atividades.id_checklist
                                    where id_usuario = %d
                                      and check_lists.id = %d
                            ', $iUsuario, $iCheckList));
    }
}
