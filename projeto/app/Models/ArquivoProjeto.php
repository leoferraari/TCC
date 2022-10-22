<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoProjeto extends Model
{
    use HasFactory;

    protected $primaryKey = ['id', 'id_projeto'];

    protected $fillable = ['endereco', 'descricao'];
    
    public $timestamps = false;

    public $incrementing = true;

    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }
}
