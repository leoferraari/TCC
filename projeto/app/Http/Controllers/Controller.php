<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\Handler;
use Exception;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function responseJsonSuccess(array $data)
    {
        return response()->json((
            array_merge(['success' => true], $data)
        ), 201)->header('Content-Type', 'application/json');
    }

    public static function responseJsonFailed(array $data, Exception $error)
    {
        return response()->json((
            Handler::returnError($data, $error)
        ), Handler::getStatusCode($error));
    }
}
