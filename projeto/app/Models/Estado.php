<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function municipios(): HasMany {
        return $this->hasMany(Municipio::class);
    }


}
