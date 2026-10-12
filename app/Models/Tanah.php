<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tanah extends Model
{
    protected $guarded = [];
    public function jenis()    
    { 
        return $this->belongsTo(Jenis::class);
    }
    public function desa()     
    { 
        return $this->belongsTo(Desa::class); 
    }
    public function nadzir()   
    { 
        return $this->belongsTo(Nadzir::class);
    }
    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }
}

