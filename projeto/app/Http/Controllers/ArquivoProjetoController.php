<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\ArquivoProjeto;
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
class ArquivoProjetoController extends Controller
{

    public function index($iProjeto)
    {
        return view('arquivo_projeto.index', ['iProjeto' => $iProjeto, 'aArquivos' => $this->getArquivosFromProjeto($iProjeto)]);
    }

    public function addArquivo(Request $request)
    {     
        $id =  $this->getMaxCodigo($request['id_projeto'])+1;

        DB::table('arquivo_projeto')->insert(
            [
                'id' => $id,
                'id_projeto' => $request['id_projeto'],
                'endereco_url' => $request['endereco_url'],
                'descricao' => $request['descricao']
            ]
        );

        return $this->responseJsonSuccess([
            'message' => 'Endereço inserido com sucesso!',
            'data'    => $request
        ]);
    }

    public function destroy($iArquivo, $iProjeto)
    {
        DB::table('arquivo_projeto')->where('id', '=', $iArquivo)->where('id_projeto', '=', $iProjeto)->delete();        
        return $this->responseJsonSuccess([
            'message' => 'Endereço removido com sucesso!'
        ]);
    }

    private function getMaxCodigo($iIdProjeto) {
        return DB::table('arquivo_projeto')->where([
            ['id_projeto', '=',$iIdProjeto]
        ])->groupBy(['id_projeto'])->max('id');
    }


    private function getArquivosFromProjeto($iProjeto) {
        return DB::select(sprintf('select id,
                                          endereco_url,
                                          descricao
                                    from arquivo_projeto
                                   where id_projeto = %d
                            ', $iProjeto));
    }

    public function getArquivo($iArquivo, $iProjeto) {
        return DB::select(sprintf('select *
                                    from arquivo_projeto
                                   where id = %d
                                     and id_projeto = %d
                            ', $iArquivo, $iProjeto))[0];
    }

    public function update(Request $request) {

        $update = DB::table('arquivo_projeto')->where('id', $request->id)->where('id_projeto', $request->id_projeto)                
        ->update([
            'endereco_url' => $request->endereco_url,
            'descricao' => $request->descricao,
        ]);

        return $this->responseJsonSuccess([
            'message' => 'Endereço alterado com sucesso!',
            'data'    => $request
        ]);
    }
}
