<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Http\Requests\StateStoreRequest;
use App\Http\Controllers\StatesController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $aInfoProjetos = $this->getInformacoesProjetoDashboard();
        $bPermiteTerceirizacao = (bool)$this->permiteTerceirizacao()->permite_projeto_terceirizado;
  
        return view('body', ['bPermiteTerceirizacao' => $bPermiteTerceirizacao, 'aInfoProjetos' => $aInfoProjetos]);
    }


    private function getInformacoesProjetoDashboard() {
        return DB::select(sprintf('
                                    with situacoes as (
                                        select unnest(ARRAY[1,2,3,4,5,6,7]) as situacao
                                    )
                                    
                                    select *,
                                        coalesce((select count(*)
                                        from projeto
                                            where id_usuario = %d	
                                                and situacao = situacoes.situacao
                                            group by situacao
                                        ), 0) as numero_projetos
                                    from situacoes 
                        ', session('id_user')));
    }

    private function permiteTerceirizacao() {
        return DB::select(sprintf('select permite_projeto_terceirizado 
                                      from users
                                     where id = %d
        ', session('id_user')))[0];
    }
}
