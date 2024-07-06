<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKos;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FasilitasKosController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Fasilitas Umum KOS',
        ];
        return view('admin.fasilitas.index', $data);
    }
    public function getFasilitasDataTable()
    {
        $FasilitasKos = FasilitasKos::orderByDesc('id');

        return DataTables::of($FasilitasKos)
            ->addColumn('action', function ($FasilitasKos) {
                return view('admin.fasilitas.components.actions', compact('FasilitasKos'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        $fasilitasData = [
            'nama_fasilitas' => $request->input('nama_fasilitas'),
        ];

        if ($request->filled('id')) {
            $FasilitasKos = FasilitasKos::find($request->input('id'));
            if (!$FasilitasKos) {
                return response()->json(['message' => 'Fasilitas not found'], 404);
            }

            $FasilitasKos->update($fasilitasData);
            $message = 'Fasilitas updated successfully';
        } else {
            FasilitasKos::create($fasilitasData);
            $message = 'Fasilitas created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $FasilitasKos = FasilitasKos::find($id);

        if (!$FasilitasKos) {
            return response()->json(['message' => 'Fasilitas not found'], 404);
        }

        $FasilitasKos->delete();

        return response()->json(['message' => 'Fasilitas deleted successfully']);
    }
    public function edit($id)
    {
        $FasilitasKos = FasilitasKos::find($id);

        if (!$FasilitasKos) {
            return response()->json(['message' => 'Fasilitas not found'], 404);
        }

        return response()->json($FasilitasKos);
    }
}
