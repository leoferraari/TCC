<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Medida;
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
class MedidaController extends Controller
{

    public function areas_medicoes($iProjeto, $iComodo)
    {
        return view('areas_medicoes.index', ['iProjeto' => $iProjeto, 
                                             'iComodo'  => $iComodo,
                                             'aAreasMedicoes' => $this->getAreasMedicoesFromProjetoComodo($iProjeto, $iComodo)]);
    }

    public function create($iProjeto)
    {
        return view('comodo.create', ['iProjeto' => $iProjeto]);
    }

    public function addAreaMedicao(Request $request)
    {     
        $id =  $this->getMaxCodigo($request['id_projeto'], $request['id_comodo'])+1;

        DB::table('medidas')->insert(
            [
                'id_medida' => $id,
                'id_projeto' => $request['id_projeto'],
                'id_comodo' => $request['id_comodo'],
                'descricao_medida' => $request['descricao_medida'],
            ]
        );

        return $this->responseJsonSuccess([
            'message' => 'Área inserida com sucesso!',
            'data'    => $request
        ]);
    }

    public function addMedida(Request $request) {
        $id =  $this->getMaxCodigo($request['id_projeto'], $request['id_comodo'])+1;


        DB::table('medidas')->insert(
            [
                'id_medida' => $id,
                'id_projeto' => $request['id_projeto'],
                'id_comodo' => $request['id_comodo'],
                'tipo_unidade_medida' => $request['tipo_unidade_medida'],
                'tipo_medida' => $request['tipo_medida'],
                'descricao_medida' => $request['descricao_medida'],
                'medicao' => $request['medicao'],
                'tipo_ponto' => $request['tipo_ponto'],
                'id_medida_pai' => $request['id_medida_pai'],
            ]
        );

        return $this->responseJsonSuccess([
            'message' => 'Medida inserida com sucesso!',
            'data'    => $request
        ]);
    }

    public function destroy($iProjeto, $iComodo, $iMedida)
    {
        $users = DB::table('medidas')->where('id_medida', '=', $iMedida)->where('id_projeto', '=', $iProjeto)->where('id_comodo', '=', $iComodo)->delete();        
        return response()->json($iProjeto, 200)->header('Content-Type', 'application/json');
    }

    private function getMaxCodigo($iProjeto, $iComodo) {
        return DB::table('medidas')->where([
            ['id_projeto', '=',$iProjeto],
            ['id_comodo', '=',$iComodo]
        ])->groupBy(['id_projeto', 'id_comodo'])->max('id_medida');
    }


    private function getAreasMedicoesFromProjetoComodo($iProjeto, $iComodo) {
        return DB::select(sprintf('select id_medida,
                                        descricao_medida
                                    from medidas
                                   where id_projeto = %d
                                     and id_comodo = %d
                                     and id_medida_pai is null
                            ', $iProjeto, $iComodo));
    }


    public function getDescricaoMedida($iProjeto, $iComodo, $iMedida) {
        return DB::select(sprintf('select descricao_medida
                                        from medidas
                                    where id_projeto = %d
                                        and id_comodo = %d
                                        and id_medida = %d', $iProjeto, $iComodo, $iMedida))[0];
    }

    public function update_area_medicao(Request $request) {

        $update = Medida::where('id_medida', $request->id_medida)->where('id_projeto', $request->id_projeto)->where('id_comodo', $request->id_comodo)               
        ->update([
            'descricao_medida'=> $request->descricao_medida,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Área alterada com sucesso!',
            'data'    => $request
        ]);
    }
}
