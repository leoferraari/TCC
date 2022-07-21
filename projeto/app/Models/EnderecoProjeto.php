<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoProjeto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['complemento', 'numero_endereco', 'bairro', 'cidade', 'cep', 'id_projeto'];

    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }
}
