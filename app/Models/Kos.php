<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kos extends Model
{
    use HasFactory;
    protected $table = 'kos';
    protected $guarded = [];

    public function keluarahan(): BelongsTo
    {
        return $this->belongsTo(keluarahan::class, 'id_keluarahan');
    }
    public function jalan(): BelongsTo
    {
        return $this->belongsTo(Jalan::class, 'id_jalan');
    }
}
