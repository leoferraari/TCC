<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodo extends Model
{
    use HasFactory;

    protected $primaryKey = ['id', 'id_projeto'];

    protected $fillable = ['id_projeto', 'nome', 'descricao'];
    
    public $timestamps = false;

    public $incrementing = false;

    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }
}
