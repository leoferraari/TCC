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

    public function check_lists() {
        return $this->belongsTo(CheckList::class, 'id_checklist', 'id');
    }

    public function projeto() {
        return $this->belongsTo(Projeto::class, 'id_projeto', 'id');
    }
}
