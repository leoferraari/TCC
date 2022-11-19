<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
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
class AreaAtuacaoController extends Controller
{

    public function area_atuacao()
    {
        $aAreas = $this->getAreasAtuacao();
        return view('area_atuacao.index', ['aAreas' => $aAreas]);
    }

    public function area_atuacao_loc($iMunicipio, $sNomeArquiteto) {
        $aAreas = $this->getAreasAtuacaoFiltro($iMunicipio, $sNomeArquiteto);
        return view('area_atuacao.index', ['aAreas' => $aAreas]);
    }



    public function getAreasAtuacao() {
        $iCodigoUsuario = session('id_user');
        return DB::select(sprintf('select users.id as codigo_usuario,
                                  users.nome || \' \' || users.sobrenome as nome,
                                  celular,
                                  email,
                                  municipios.nome as municipio,
                                  estados.nome as estado_nome,
                                  estados.sigla as estado_sigla
                             from usuario_atendimentos 
                             join users
                               on users.id = usuario_atendimentos.id_usuario
                             join municipios 
                               on municipios.id = usuario_atendimentos.id_municipio
                             join estados
                               on estados.id = municipios.estado_id 
                            where users.id <> %d', $iCodigoUsuario)
                           );
    }

    public function getAreasAtuacaoFiltro($iMunicipio, $sNomeArquiteto) {
        $bAplicouFiltro = false;
        $sSql = 'select users.id as codigo_usuario,
                    users.nome || \' \' || users.sobrenome as nome,
                    celular,
                    email,
                    municipios.nome as municipio,
                    estados.nome as estado_nome,
                    estados.sigla as estado_sigla
            from usuario_atendimentos 
            join users
                on users.id = usuario_atendimentos.id_usuario
            join municipios 
                on municipios.id = usuario_atendimentos.id_municipio
            join estados
                on estados.id = municipios.estado_id';

        if ($iMunicipio != 'null') {
            $bAplicouFiltro = true;
            $sSql.= sprintf(' where municipios.id = %d', $iMunicipio);
        }
        
        if ($sNomeArquiteto != 'null') {
            $sSql.=  $bAplicouFiltro ? ' and' : ' where ';
            $sSql.= ' (users.nome || \' \' || users.sobrenome) ilike '. '\'%'.$sNomeArquiteto.'%\'';
        }

        $sSql.= sprintf(' and users.id <> %d', $iCodigoUsuario);
        
        return DB::select($sSql);
    }
}
