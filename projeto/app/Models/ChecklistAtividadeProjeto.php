<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistAtividadeProjeto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = ['id', 'id_checklist', 'id_projeto'];

    public $incrementing = false;
    
    protected $fillable = ['id_checklist', 'id_projeto', 'concluido'];


    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }

    public function check_list_atividades() {
        return $this->belongsTo(CheckListAtividade::class, 'id', 'id');
    }
}
