<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UsuarioAtendimento extends Model
{
    use HasFactory;


     
    protected $primaryKey = ['id_usuario', 'id_municipio'];

    protected $fillable = ['id_usuario', 'id_municipio'];
    
    public $timestamps = false;

    public function municipios() {
        return $this->belongsTo(Municipio::class, 'id_municipio', 'id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
