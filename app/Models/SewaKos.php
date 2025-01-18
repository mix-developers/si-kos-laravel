<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SewaKos extends Model
{
    use HasFactory;
    protected $table = 'sewa_kos';
    protected $guarded = [];

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public static function tersewa($id_kos)
    {
        // $now = date('Y-m-d');
        $tersewa = self::where('id_kos', $id_kos)
            ->where('is_verified', 1)
            ->count();

        return $tersewa;
    }
    public static function tersedia($id_kos)
    {
        $kos = Kos::where('id', $id_kos)->first()->jumlah_pintu;
        $kos_model = Kos::find($id_kos);
        $tersewa = self::tersewa($id_kos);
        if ($kos - $tersewa != 0) {
            $kos_model->status = 'Open';
            $kos_model->save();
        } else {
            $kos_model->status = 'Close';
            $kos_model->save();
        }

        return $kos - $tersewa;
    }
}