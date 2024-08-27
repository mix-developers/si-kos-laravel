<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function sewa()
    {
        $data = [
            'title' => 'Laporan Penyewaan Kos'
        ];
        return view('admin.laporan.sewa', $data);
    }
    public function kos()
    {
        $data = [
            'title' => 'Laporan Kos'
        ];
        return view('admin.laporan.kos', $data);
    }
}
