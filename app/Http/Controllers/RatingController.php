<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Kos;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Rating dan ulasan pada KOS',
        ];
        return view('admin.rating.index', $data);
    }
    public function getRatingDataTable()
    {
        $rating = Rating::with(['user','kos'])->orderByDesc('id');

        if(Auth::user()->role == 'Pemilik_kos'){
            $kos = Kos::where('id_user',Auth::id())->first();
            $rating = $rating->where('id_kos',$kos->id);
        }

        return DataTables::of($rating)
        ->addColumn('pengguna', function ($rating) {
            return '<strong>'.$rating->user->name.'</strong><br>'.$rating->user->email;
        })
        ->addColumn('rating', function ($rating) {
            $rat ='';
            for($i =1; $i<=$rating->rating; $i++){
                $rat .= '<i class="bx bx-star text-warning"></i>';
            }
            return $rat;
        })

        ->rawColumns(['pengguna','rating'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|string|max:255',
            'ulasan' => 'required|string|max:255',
            'id_kos' => 'required|string|max:255',
        ]);

        $ratingData = [
            'rating' => $request->input('rating'),
            'ulasan' => $request->input('ulasan'),
            'id_kos' => $request->input('id_kos'),
            'id_user' => Auth::id(),
        ];

        if ($request->filled('id')) {
            $rating = Rating::find($request->input('id'));
            if (!$rating) {
                return response()->json(['message' => 'rating not found'], 404);
            }

            $rating->update($ratingData);
            $message = 'rating updated successfully';
        } else {
            Rating::create($ratingData);
            session()->flash('success','Rating dan ulasan kemu berhasil di kirim');
            return redirect()->back();
        }

    }
}
