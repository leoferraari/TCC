<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CheckList extends Model
{
    use HasFactory;
    public $timestamps = false;
    

    protected $fillable = ['nome', 'descricao', 'id_usuario'];

    public function users() {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
