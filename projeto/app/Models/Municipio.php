<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function estado(): BelongsTo {
        return $this->belongsTo(Estado::class);
    }
}
