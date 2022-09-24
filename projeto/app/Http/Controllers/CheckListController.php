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

    public function destroy($iCodigoCheckList)
    {
        $users = DB::table('check_lists')->where([
            ['id_usuario', '=', session('id_user')],
            ['id', '=', $iCodigoCheckList],
        ])->delete();

        return redirect()->route('check_list');
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
}
