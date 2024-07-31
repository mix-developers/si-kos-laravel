<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;
use App\Models\Jalan;
use Yajra\DataTables\Facades\DataTables;

class LokasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelurahan Dan Jalan',
        ];
        return view('admin.lokasi.index', $data);
    }
    public function getKelurahanDataTable()
    {
        $kelurahan = Kelurahan::orderByDesc('id');

        return DataTables::of($kelurahan)
            ->addColumn('action', function ($kelurahan) {
                return view('admin.lokasi.components.actions_kelurahan', compact('kelurahan'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getJalanDataTable()
    {
        $jalan = Jalan::orderByDesc('id');

        return DataTables::of($jalan)
            ->addColumn('action', function ($jalan) {
                return view('admin.lokasi.components.actions_jalan', compact('jalan'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
     public function store_kelurahan(Request $request)
    {
        $request->validate([
            'kelurahan' => 'required|string|max:255',
        ]);

        $customerData = [
            'kelurahan' => $request->input('kelurahan'),
        ];

        if ($request->filled('id')) {
            $customer = Kelurahan::find($request->input('id'));
            if (!$customer) {
                return response()->json(['message' => 'kelurahan not found'], 404);
            }

            $customer->update($customerData);
            $message = 'kelurahan updated successfully';
        } else {
            Kelurahan::create($customerData);
            $message = 'kelurahan created successfully';
        }

        return response()->json(['message' => $message]);
    }
     public function store_jalan(Request $request)
    {
        $request->validate([
            'id_kelurahan' => 'required|string|max:255',
            'jalan' => 'required|string|max:255',
        ]);

        $customerData = [
            'id_kelurahan' => $request->input('id_kelurahan'),
            'jalan' => $request->input('jalan'),
        ];

        if ($request->filled('id')) {
            $customer = Jalan::find($request->input('id'));
            if (!$customer) {
                return response()->json(['message' => 'jalan not found'], 404);
            }

            $customer->update($customerData);
            $message = 'jalan updated successfully';
        } else {
            Jalan::create($customerData);
            $message = 'jalan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy_kelurahan($id)
    {
        $customers = Kelurahan::find($id);

        if (!$customers) {
            return response()->json(['message' => 'kelurahan not found'], 404);
        }

        $customers->delete();

        return response()->json(['message' => 'Kelurahan deleted successfully']);
    }
    public function destroy_jalan($id)
    {
        $customers = Jalan::find($id);

        if (!$customers) {
            return response()->json(['message' => 'jalan not found'], 404);
        }

        $customers->delete();

        return response()->json(['message' => 'jalan deleted successfully']);
    }
}
