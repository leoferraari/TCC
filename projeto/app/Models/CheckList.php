<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CheckList;

use App\Http\Requests\Cities\CitiesStoreRequest;
use App\Http\Requests\Cities\CitiesUpdateRequest;

class CheckList extends Model
{
    use HasFactory;
    public $timestamps = false;
    

    protected $fillable = ['nome', 'descricao', 'id_usuario'];

    public function users() {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // public function addCheckList($request) {
        
    //     $oValores = $request->all();
    //     $checklist = new CheckList($oValores);
    //     $checklist->save();
    //     return $checklist;
    // }
}
