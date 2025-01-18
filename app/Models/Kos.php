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

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
    public function jalan(): BelongsTo
    {
        return $this->belongsTo(Jalan::class, 'id_jalan');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasKos::class, 'fasilitas_umum_kos', 'id_kos', 'id_fasilitas')
            ->withPivot('jumlah'); // Kolom 'jumlah' pada tabel pivot
    }
}
