<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;

    protected $primaryKey = ['id_medida', 'id_sequencia'];

    protected $fillable = ['id_projeto', 'id_comodo', 'tipo_unidade_medida', 'tipo_medida', 'tipo_ponto', 'descricao_medida', 'medicao', 'descricao_ponto', 'id_medida_pai'];
    
    public $timestamps = false;

    public $incrementing = false;

    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }

    public function medida() {
        return $this->belongsTo(Medida::class, 'id_medida_pai', 'id_medida');
    }

    public function comodos() {
        return $this->belongsTo(Comodo::class, 'id_comodo', 'id');
    }

}
