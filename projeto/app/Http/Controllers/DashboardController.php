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
  
        return view('body', compact('aInfoProjetos'));
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
}
