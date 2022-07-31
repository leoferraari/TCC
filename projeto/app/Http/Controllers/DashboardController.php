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

    public function motivacao()
    {
        return view('teste');
    }
}
