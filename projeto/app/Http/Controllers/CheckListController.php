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

    public function index()
        //VER
    {
        $oCheckLists = $this->getCheckListsByUsuario();

        return view('checklist.index', compact('oCheckLists'));
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

        // return redirect()->route('usuario_atendimento.index');
    }

    public function destroy($id_municipio)
    {
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', session('id_user')],
            ['id_municipio', '=', $id_municipio],
        ])->delete();

        return redirect()->route('usuario_atendimento.index');
    }

    private function getCheckListsByUsuario() {
        return CheckList::query()->where('id_usuario', '=', session('id_user'))->get();
    }
}
