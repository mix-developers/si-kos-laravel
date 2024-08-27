<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorit(Request $request)
    {
        $userId = Auth::id();
        $itemId = $request->input('id_kos');

        // Ensure the user is authenticated
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $favorit = Favorite::where('id_user', $userId)
            ->where('id_kos', $itemId)
            ->first();

        if ($favorit) {
            // If favorite exists, delete it
            $favorit->delete();
            return response()->json(['status' => 'dihapus']);
        } else {
            // If favorite does not exist, create it
            Favorite::create([
                'id_user' => $userId,
                'id_kos' => $itemId
            ]);
            return response()->json(['status' => 'Ditambahkan']);
        }
    }
    public function destroy($id)
    {
        $favorit = Favorite::find($id);
        $favorit->delete();
        return back()->with('success', 'Berhasil menghapus dari daftar');
    }
}
