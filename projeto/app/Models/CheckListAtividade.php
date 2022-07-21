<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListAtividade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = ['id', 'id_checklist'];

    public $incrementing = false;
    
    protected $fillable = ['descricao', 'id_checklist'];

    public function check_lists() {
        return $this->belongsTo(CheckList::class);
    }
}
