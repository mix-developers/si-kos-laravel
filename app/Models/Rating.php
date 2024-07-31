<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
    static function getRatingKos($id_kos) {
        // Calculate the sum of ratings for the specified id_kos
        $sumRating = self::where('id_kos', $id_kos)->sum('rating');
        
        // Count the number of ratings for the specified id_kos
        $countRating = self::where('id_kos', $id_kos)->count('rating');
        
        // Calculate the average rating
        $average = $countRating > 0 ? ($sumRating / $countRating) : 0;
        
        // Optionally, you might want to return the average rounded to a specific number of decimal places
        return round($average, 1);
    }
    
}
