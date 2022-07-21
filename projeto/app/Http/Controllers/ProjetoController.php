<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\UsuarioAtendimento;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Models\Projeto;
use App\Models\EnderecoProjeto;
use Illuminate\Support\Facades\DB;
use App\Models\CheckList;
use App\Http\Requests\States\StatesStoreRequest;
use App\Http\Requests\States\StatesUpdateRequest;


use Illuminate\Http\Request;


use Exception;

/**
 * @package namespace App\Http\Controllers;
 */
class ProjetoController extends Controller
{
  

    public function index()
    {
        $oUsuariosAtendimentos = $this->getUsuarioAtendimento();
        return view('projeto.index', compact('oUsuariosAtendimentos'));
    }

    public function create()
    {
        $oCheckListUsuario = $this->getCheckListUsuario();
        $iUsuario = session('id_user');
        return view('projeto.create', ['oCheckListUsuario' => $oCheckListUsuario, 'iUsuario' => $iUsuario]);
    }

    public function store(Request $request)
    {

        $oData = $request->all();

        $aInsert = [
            'nome' => $request['nome'],
            'descricao' => $request['descricao'],
            'nome_cliente' => $request['nome_cliente'],
            'email_cliente' => $request['email_cliente'],
            'numero_tel_cliente' => $request['numero_tel_cliente'],
            'situacao'=> $request['situacao'],
            'data_hora_atendimento'=> $request['data_hora_atendimento'],
            'prazo_final' => $request['prazo_final'],
            'data_conclusao' => $request['data_conclusao'],
            'id_usuario' => session('id_user'),
            'id_terceirizado' => $request['id_terceirizado'] ?: null,
            'id_checklist' => $request['id_checklist'] == 0 ? null : $request['id_checklist']
        ];

        $projeto = Projeto::create($aInsert);

        $this->insereEndereco($request, $projeto);

        return redirect()->route('usuario_atendimento.index');
    }

    private function insereEndereco(Request $request, $projeto) {
        EnderecoProjeto::create(   
            [
                'complemento' => $request->complemento,
                'numero_endereco' => $request->numero_endereco,
                'bairro' => $request->bairro,
                'cidade' => $request->municipio,
                'cep' => $request->cep,
                'id_projeto' => $projeto->id
            ]
        );
    }

    public function destroy($id_municipio)
    {
        $users = DB::table('usuario_atendimentos')->where([
            ['id_usuario', '=', $this->getUsuario()],
            ['id_municipio', '=', $id_municipio],
        ])->delete();

        return redirect()->route('usuario_atendimento.index');
    }

    private function getUsuarioAtendimento() {
        $oQuery = UsuarioAtendimento::query()->join('users', 'usuario_atendimentos.id_usuario', '=', 'users.id')
                                            ->where('users.id', '=', session('id_user'));
        return $oQuery->get();
    }

    private function getCheckListUsuario() {
        $oQuery = CheckList::query()->select(['check_lists.id', 'check_lists.nome'])->join('users', 'check_lists.id_usuario', '=', 'users.id')
                                            ->where('users.id', '=', session('id_user'));
        return $oQuery->get();
    }
}
