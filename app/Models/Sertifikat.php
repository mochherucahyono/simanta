<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertifikat extends Model
{
    protected $guarded = [];

    public function tanah()
    {
        return $this->belongsTo(Tanah::class);
    }
}
