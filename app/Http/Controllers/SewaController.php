<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penyewaan KOS',
        ];
        return view('admin.sewa.index', $data);
    }
}
