<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FasilitasUmumKos extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_umum_kos';
    protected $guarded = [];

    public function fasilitas(): BelongsTo
    {
        return $this->belongsTo(FasilitasKos::class, 'id_fasilitas');
    }
}
