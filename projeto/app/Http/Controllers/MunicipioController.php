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

class MunicipioController extends Controller
{


    public function cidades($iCodigoEstado) {
        $aMunicipios = DB::select('
            select municipios.id,
                   municipios.nome 
              from municipios
             where estado_id = '.$iCodigoEstado);

        return response()->json($aMunicipios, 200)
            ->header('Content-Type', 'application/json');
    }
}
