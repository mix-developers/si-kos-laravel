<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\SewaKos;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SewaKosNotification;
use App\Models\User;

class SewaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penyewaan KOS',
        ];
        return view('admin.sewa.index', $data);
    }
    public function kos_user()
    {
        // Dapatkan semua sewa user
        $sewa_user = SewaKos::with(['kos'])->where('id_user', Auth::id())->get();

        // Pisahkan sewa aktif dan riwayat
        $sewa_aktif = [];
        $sewa_riwayat = [];
        // dd($sewa_user);
        foreach ($sewa_user as $sewa) {
            if ($sewa->kos) {
                $tanggalSewa = strtotime($sewa->tanggal_sewa);
                $tanggalAkhir = date('Y-m-d', strtotime("+{$sewa->jangka_waktu} month", $tanggalSewa));

                // Periksa apakah sewa masih aktif
                if (strtotime($tanggalAkhir) >= strtotime(now())) {
                    $sewa_aktif[] = $sewa;
                } else {
                    $sewa_riwayat[] = $sewa;
                }
            }
        }

        // Kirim data ke view
        $data = [
            'title' => 'Kos Saya',
            'kos' => Kos::latest()->limit(3)->get(),
            'sewa_active' => $sewa_aktif,
            'sewa_no_active' => $sewa_riwayat,
        ];

        return view('pages.sewa.kos_saya', $data);
    }
    public function ajukan(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->to('/login');
        }
        $tanggal = $request->input('tanggal');
        $kos = Kos::find($request->id_kos);
        $data = [
            'title' => 'Ajukan Sewa : ' . $kos->nama_kos,
            'tanggal' => $tanggal,
            'kos' => $kos
        ];
        return view('pages.sewa.ajukan', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_kos' => 'required|string|max:255',
            'nama_penyewa' => 'required|string|max:20',
            'jumlah_orang' => 'required|string',
            'jangka_waktu' => 'required|string',
            'tanggal_sewa' => 'required|string',
        ]);

        $sewaData = [
            'id_kos' => $request->input('id_kos'),
            'nama_penyewa' => $request->input('nama_penyewa'),
            'jumlah_orang' => $request->input('jumlah_orang'),
            'jangka_waktu' => $request->input('jangka_waktu'),
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'id_user' => Auth::id(),
        ];
        $kos =  Kos::find($request->input('id_kos'));

        $sewa = SewaKos::create($sewaData);
        if ($sewa) {
            session()->flash('success', 'Berhasil mengajukan sewa, periksa status pengajuan secara berkala untuk melihat verifikasi oleh pemilik.');
            $ownerEmail = User::find($kos->id_user)->email;
            Mail::to($ownerEmail)->send(new SewaKosNotification($sewa, $kos));

            return redirect()->to('detail-kos/' . $kos->slug);
        } else {
            session()->flash('error', 'Gagal mengajukan sewa. Silakan coba lagi.');
            return redirect()->back();
        }
    }
    public function getSewaDataTable(Request $request)
    {
        $sewa = SewaKos::with(['kos'])->orderByDesc('id');
        if (Auth::user()->role == 'Pemilik_kos') {
            $kos = Kos::where('id_user', Auth::user()->id)->first();
            $sewa = $sewa->where('id_kos', $kos->id);
        }
        if ($request->input('jangka_waktu') != 0 && $request->input('jangka_waktu') != '') {
            $sewa->where('jangka_waktu', $request->input('jangka_waktu'));
        }
        return datatables()::of($sewa)
            ->addColumn('action', function ($sewa) {
                $accept = '<button type="button" onclick="acceptAction(' . $sewa->id . ')" class="btn btn-sm btn-success mx-1">Terima</button>';
                $reject = '<button type="button"  onclick="rejectAction(' . $sewa->id . ')"  class="btn btn-sm btn-danger mx-1">Tolak</button>';
                $detail = '<button type="button" onclick="detailAction(' . $sewa->id . ')" class="btn btn-sm btn-primary mx-1">Detail</button>';
                if (Auth::user()->role == 'Pemilik_kos') {
                    $button = $sewa->is_verified == 0 ? $detail . $accept . $reject : $detail;
                } else {
                    $button = $detail;
                }
                return $button;
            })
            ->addColumn('status', function ($sewa) {
                $diterima = '<span class="badge bg-success">diterima</span>';
                $tolak = '<span class="badge bg-danger">ditolak</span>';
                $menunggu = '<span class="badge bg-secondary">pengajuan</span>';
                if ($sewa->is_verified == 0) {
                    return $menunggu;
                } elseif ($sewa->is_verified == 1) {
                    return $diterima;
                } else {
                    return $tolak;
                }
            })
            ->addColumn('alamat', function ($sewa) {
                return 'Jalan : ' . $sewa->kos->jalan->jalan . '<br>Kelurahan : ' . $sewa->kos->kelurahan->kelurahan;
            })
            ->rawColumns(['action', 'status', 'alamat'])
            ->make(true);
    }
    public function detail($id)
    {
        $sewa = SewaKos::with(['user', 'kos'])->where('id', $id)->first();
        return response()->json($sewa);
    }
    public function accept($id)
    {
        $message = '';
        $sewa = SewaKos::find($id);
        $cek_pintu = SewaKos::tersedia($sewa->id_kos);
        if ($cek_pintu != 0) {
            $sewa->is_verified = 1;
            if ($sewa->save()) {
                $cek_pintu2 = SewaKos::tersedia($sewa->id_kos);
                if ($cek_pintu2 == 0) {
                    $kos = Kos::find($sewa->id_kos);
                    $kos->status = 'Close';
                    $kos->save();
                }
                $message = 'Berhasil menerima';
            } else {
                $message = 'Kos telah penuh';
            }
        } else {
            $message = 'Kos telah penuh';
        }
        return response()->json($message);
    }
    public function reject($id)
    {
        $sewa = SewaKos::find($id);
        $sewa->is_verified = 2;
        $sewa->save();
        return response()->json([$sewa]);
    }
}
