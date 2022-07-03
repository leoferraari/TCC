<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\States\StatesStoreRequest;
use App\Http\Requests\States\StatesUpdateRequest;


use Illuminate\Http\Request;


use Exception;

/**
 * Class StatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StatesController extends Controller
{

    /**
     * StatesController constructor.
     *
     */
    public function __construct()
    {
        //
    }


    public function index(Request $request)
    {
        try {
            return view('states.index');
        } catch (Exception $error) {
            return Handler::returnError([
                'message' => 'Houve um erro ao requisitar o Index de Estados.'
            ], $error);
        }
    }

    public function datatable(Request $request)
    {
        try {
            $states_list = State::orderBy('id')->get();

            return $this->getDataTable($states_list, 'states', $request->type);
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro ao requisitar o DataTable de Estados.'
            ], $error);
        }
    }

    public function list(Request $request)
    {
        try {
            [$data, $message] = $this->listDataAndMessage(State::class, $request->state_id, [
                'Estado', 'Estados'
            ]);

            return $this->responseJsonSuccess([
                'message' => $message,
                'data'    => $data
            ]);
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro no processo de listagem!'
            ], $error);
        }
    }

    public function create()
    {
        return view('states.maintenance')->with('route', 'create');
    }

    public function store(StatesStoreRequest $request)
    {
        try {
            $state = State::create([
                'name'     => $request->name,
                'initials' => $request->initials,
            ]);

            return $this->responseJsonSuccess([
                'message' => 'Estado inserido com sucesso!',
                'data'    => $state
            ]);
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro ao realizar ao realizar o seu cadastro!'
            ], $error);
        }
    }

    public function show(int $id)
    {
        try {
            return view('states.maintenance')->with('route', 'show');
        } catch (Exception $error) {
            return Handler::returnError([
                'message' => 'Houve um erro ao retornar o registro para a visualização!'
            ], $error);
        }
    }

    public function edit(int $id)
    {
        try {
            $this->saveIdToVerify($id);
            return view('states.maintenance')->with('route', 'edit');
        } catch (Exception $error) {
            return Handler::returnError([
                'message' => 'Houve um erro ao retornar o registro para a edição!'
            ], $error);
        }
    }

    public function update(StatesUpdateRequest $request)
    {
        try {
            if ($this->verifyId($request->id)) {

                $state = State::where('id', $request->id)->update([
                    'name'     => $request->name,
                    'initials' => $request->initials,
                ]);


                return $this->responseJsonSuccess([
                    'message' => 'Estado atualizado com sucesso!',
                    'data'    => $state
                ]);
            } else {
                throw new Exception(self::ERROR_VERIFY_ID);
            }
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro ao atualizar o registro!'
            ], $error);
        }
    }

    public function delete(Request $request)
    {
        try {
            $state = State::where('id', $request->id)->delete();

            return $this->responseJsonSuccess([
                'message' => 'Estado removido com sucesso!',
                'data'    => $state
            ]);
        } catch (Exception $error) {
            return $this->responseJsonFailed([
                'message' => 'Houve um erro ao remover o registro!'
            ], $error);
        }
    }
}
