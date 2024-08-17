<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jalan extends Model
{
    use HasFactory;
    protected $table = 'jalan';
    protected $guarded = [];

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
}