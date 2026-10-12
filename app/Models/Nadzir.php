<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nadzir extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function tanahs()
    { 
        return $this->hasMany(Tanah::class);
    }
}
