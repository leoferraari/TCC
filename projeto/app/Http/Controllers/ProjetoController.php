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
use App\Models\Estado;
use App\Models\Municipio;
use App\Http\Requests\States\StatesStoreRequest;
use App\Http\Requests\States\StatesUpdateRequest;


use Illuminate\Http\Request;


use Exception;

/**
 * @package namespace App\Http\Controllers;
 */
class ProjetoController extends Controller
{
    const PENDENTE_AGUARDANDO_ACEITACAO_TERCEIRO = 7,
          PENDENTE_AGUARDANDO_MINHA_ACEITACAO = 8,
          EM_ANDAMENTO = 1,
          EM_ALTERACAO = 2,
          CANCELADO = 3,
          CONCLUIDO = 4,
          RECUSADO = 5,
          AGUARDANDO_ACEITACAO = 6;

    public function index($iCodigoSituacao)
    {
 
        $oProjetos = $this->getProjetosUsuario($iCodigoSituacao);
        return view('projeto.index', ['iSituacao' => $iCodigoSituacao, 'oProjetos' => $oProjetos, 'bPossuiProjeto' => $oProjetos ? true : false]);
    }

    public function alterar($iCodigoProjeto) {

        $oProjeto = Projeto::find($iCodigoProjeto);
        $oEndereco = $this->getEnderecoProjeto($iCodigoProjeto);     
        $oEstados = Estado::all();
        $oCheckListUsuario = $this->getCheckListUsuario($oProjeto->id_usuario);

        $oMunicipios = $this->getMunicipiosEstado($oEndereco->estado_usuario);
        return view('projeto.alteracao', [
            'oProjeto' => $oProjeto,
            'oEndereco' => $oEndereco,
            'oEstados' => $oEstados,
            'oMunicipios' => $oMunicipios,
            'oCheckListUsuario' => $oCheckListUsuario,
            'iUsuario' => $oProjeto->id_usuario
        ]);
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
            'id' => $this->getMaxCodigo() +1,
            'nome' => $request['nome'],
            'descricao' => $request['descricao'],
            'nome_cliente' => $request['nome_cliente'],
            'email_cliente' => $request['email_cliente'],
            'numero_tel_cliente' => $request['numero_tel_cliente'],
            'situacao'=> $request['id_terceirizado'] ? 6 : 1,
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

    private function getCheckListUsuario($iCodigoUsuario = null) {
        $oQuery = CheckList::query()->select(['check_lists.id', 'check_lists.nome'])->join('users', 'check_lists.id_usuario', '=', 'users.id')
                                            ->where('users.id', '=', session('id_user') ?: $iCodigoUsuario);
        return $oQuery->get();
    }

    private function getProjetosUsuario($iCodigoSituacao) {
        return DB::select(sprintf(' select id,
                                           nome,
                                           nome_cliente,
                                           numero_tel_cliente,
                                           to_char(data_hora_atendimento, \'DD/MM/YYYY\') as data_hora_atendimento,
                                           to_char(prazo_final, \'DD/MM/YYYY\')  as prazo_final,
                                           (id_usuario = %2$d) as permite_alterar,
                                           id_checklist,
                                           id_usuario,
                                           case when (coalesce(id_terceirizado, id_usuario) = %2$d) then 1 else 0 end as permite_concluir_atividade
                                        from projeto
                                        where
                                          case when (%1$d = 7) then 
                                        (situacao = 6 and id_terceirizado <> id_usuario and id_terceirizado is not null and id_usuario = %2$d)
                                        when (%1$d = 8) then 
                                        (situacao = 6 and id_terceirizado = %2$d)
                                        else 
                                            (situacao = %1$d and (id_usuario = %2$d or id_terceirizado = %2$d)) 
                                        end
                                    order by data_hora_atendimento desc

                            ', $iCodigoSituacao, session('id_user')));
    }

    private function getMaxCodigo() {
        return DB::table('projeto')->max('id');
    }

    private function getEnderecoProjeto($iCodigoProjeto) {
        return DB::select('
            select cep,
                   complemento,
                   numero_endereco,
                   bairro,
                   endereco_projetos.cidade,
                   estados.sigla,
                   estados.id as estado_usuario
            from endereco_projetos
            join municipios
                on endereco_projetos.cidade = municipios.id
            join estados
                on estados.id = municipios.estado_id
            where id_projeto = '. $iCodigoProjeto.'
        ')[0];
    }

    private function getMunicipiosEstado($iEstado) {
        $oQuery = Municipio::query()->
        where('estado_id', '=', $iEstado);
        return $oQuery->get();
    }

    public function update(Request $request, $iProjeto) {

        $oData = $request->all();
        // dd($oData);

        $oProjeto = Projeto::find($iProjeto);
        $oProjeto->update($oData);

        
        return redirect()->route('dashboard');

        // return redirect()->route('body.blade');
    }

    public function cancelar(Request $request) {
        $update = Projeto::where('id', $request->id_projeto)->update([
            'situacao' => 3,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Projeto Cancelado!',
            'data'    => $request
        ]);
    }

    public function aceitar(Request $request) {
        $update = Projeto::where('id', $request->id_projeto)->update([
            'situacao' => 1,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Projeto Aceito!',
            'data'    => $request
        ]);
    }

    public function recusar(Request $request) {
        $update = Projeto::where('id', $request->id_projeto)->update([
            'situacao' => 5,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Projeto Recusado!',
            'data'    => $request
        ]);
    }

    public function concluir(Request $request) {
        $update = Projeto::where('id', $request->id_projeto)->update([
            'situacao' => 4,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Projeto Concluído!',
            'data'    => $request
        ]);
    }

    public function delete(Request $request) {
        $update = Projeto::where('id', $request->id_projeto)->delete();

        return $this->responseJsonSuccess([
            'message' => 'Projeto removido!',
            'data'    => $request
        ]);
    }

    public function getDescricaoProjeto($iProjeto) {
        return DB::select('
                select nome
                  from projeto
                 where id = '. $iProjeto.'
            ')[0];
    }
}
