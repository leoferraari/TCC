<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoUser extends Model
{
    use HasFactory;

    protected $fillable = ['complemento', 'numero_endereco', 'bairro', 'cidade', 'cep', 'id_usuario'];

    public function users() {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
