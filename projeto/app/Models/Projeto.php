<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projeto';
     
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome', 
        'descricao', 
        'nome_cliente', 
        'email_cliente', 
        'numero_tel_cliente', 
        'situacao', 
        'data_criacao', 
        'data_atendimento', 
        'hora_atendimento', 
        'prazo_final',
        'data_conclusao',
        'id_usuario',
        'id_terceirizado',
        'id_checklist'
    ];

    public function users1() {
        return $this->hasOne(Projeto::class, 'id_usuario');
    }

    public function users2() {
        return $this->hasOne(Projeto::class, 'id_terceirizado');
    }

    public function check_lists() {
        return $this->hasOne(Projeto::class, 'id_checklist');
    }
}
