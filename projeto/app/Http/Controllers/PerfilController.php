<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\EnderecoUser;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{

    public function perfil()
    {
        $oUsuario = User::find(session('id_user'));
        $oEndereco = $this->getEnderecoUsuario();     
        $oEstados = Estado::all();

        $oMunicipios = $this->getMunicipiosEstado($oEndereco->estado_usuario);
        return view('perfil.index', [
            'oUsuario' => $oUsuario,
            'oEndereco' => $oEndereco,
            'oEstados' => $oEstados,
            'oMunicipios' => $oMunicipios,
        ]);
    }

    private function getEnderecoUsuario() {
        return DB::select('
            select cep,
                   complemento,
                   numero_endereco,
                   bairro,
                   endereco_users.cidade,
                   estados.sigla,
                   estados.id as estado_usuario
            from endereco_users
            join municipios
                on endereco_users.cidade = municipios.id
            join estados
                on estados.id = municipios.estado_id
            where id_usuario = '. session('id_user').'
        ')[0];
    }

    private function getMunicipiosEstado($iEstado) {
        $oQuery = Municipio::query()->
        where('estado_id', '=', $iEstado);
        return $oQuery->get();
    }

    public function update(Request $request, $iCodigoUsuario){
        $oData = $request->all();
        $oUsuario = User::find($iCodigoUsuario);

        if (isset($oData['permite_projeto_terceirizado'])) {
            $oData['permite_projeto_terceirizado'] = 1;
        } else {
            $oData['permite_projeto_terceirizado'] = 0;
        }
        
        $oUsuario->update($oData);

        $this->updateEndereco($request, $iCodigoUsuario);

        return redirect()->route('perfil');
    }


    private function updateEndereco(Request $request, $iCodigoUsuario) {
        EnderecoUser::where('id_usuario', $iCodigoUsuario)->update([
            'complemento' => $request->complemento,
            'numero_endereco' => $request->numero_endereco,
            'bairro' => $request->bairro,
            'cidade' => $request->municipio,
            'cep' => $request->cep,
        ]);
    }
}
