<?php

namespace App\Http\Controllers;

use App\Models\FasilitasTambahanKos;
use App\Models\FasilitasUmumKos;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class KosController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data KOS',
        ];
        return view('admin.kos.index', $data);
    }
    public function kos()
    {
        $data = [
            'title' => 'KOS Saya',
            'kos' => Kos::where('id_user', Auth::id())->latest()->first(),
        ];
        return view('admin.kos.kos', $data);
    }
    public function getKosDataTable()
    {
        $Kos = Kos::orderByDesc('id');

        return DataTables::of($Kos)
            ->addColumn('action', function ($Kos) {
                return view('admin.kos.components.actions', compact('Kos'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getFasilitasUmumDataTable($id_kos)
    {
        $FasilitasUmumKos = FasilitasUmumKos::with(['fasilitas'])->where('id_kos', $id_kos)->orderByDesc('id');

        return DataTables::of($FasilitasUmumKos)
            ->addColumn('action', function ($FasilitasUmumKos) {
                return view('admin.kos.components.actions_fasilitas_umum', compact('FasilitasUmumKos'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getFasilitasTambahanDataTable($id_kos)
    {
        $FasilitasTambahanKos = FasilitasTambahanKos::where('id_kos', $id_kos)->orderByDesc('id');

        return DataTables::of($FasilitasTambahanKos)
            ->addColumn('action', function ($FasilitasTambahanKos) {
                return view('admin.kos.components.actions_fasilitas_tambahan', compact('FasilitasTambahanKos'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'foto_1' => 'required|image|max:5248', // foto_1 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 2MB
            'foto_2' => 'required|image|max:5248', // foto_2 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 2MB
            'foto_3' => 'required|image|max:5248', // foto_3 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 2MB
            'nama_kos' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'jumlah_pintu' => 'required|integer', // jumlah_pintu harus berupa bilangan bulat
            'harga_kos' => 'required|numeric', // harga_kos harus berupa bilangan numerik
            'peruntukan' => 'required|string|max:255',
            'ketentuan_kos' => 'required|string|max:255',
            'keterangan_kos' => 'required|string|max:255',
            'alamat_kos' => 'required|string|max:255',
            'id_fasilitas.*' => 'required|exists:fasilitas_kos,id', // validasi untuk memastikan id_fasilitas ada di tabel fasilitas_kos
            'jumlah.*' => 'required|integer|min:0', // jumlah harus bilangan bulat tidak boleh negatif
            'milik.*' => 'required|in:Pribadi,Bersama', // kepemilikan harus Pribadi atau Bersama
            'ketersediaan.*' => 'nullable|in:Y,N', // ketersediaan bisa Y (Ya) atau N (Tidak), bisa kosong
        ]);

        //simpan foto wajib
        $fotoPaths = [];
        foreach (['foto_1', 'foto_2', 'foto_3'] as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $fotoPaths[$key] = $filePath;
            } else {
                return response()->json(['message' => 'Foto ' . $key . ' is required'], 422);
            }
        }


        //generate slug
        $slug = Str::slug($request->input('nama_kos'));

        $count = Kos::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . time();
        }
        $KosData = [
            'id_user' => Auth::id(),
            'nama_kos' => $request->input('nama_kos'),
            'nama_pemilik' => $request->input('nama_pemilik'),
            'jumlah_pintu' => $request->input('jumlah_pintu'),
            'harga_kos' => $request->input('harga_kos'),
            'peruntukan' => $request->input('peruntukan'),
            // 'latitude' => $request->input('latitude'),
            // 'longitude' => $request->input('longitude'),
            'ketentuan_kos' => $request->input('ketentuan_kos'),
            'keterangan_kos' => $request->input('keterangan_kos'),
            'alamat_kos' => $request->input('alamat_kos'),
            'latitude' => 0,
            'longitude' => 0,
            'foto_1' => $fotoPaths['foto_1'],
            'foto_2' => $fotoPaths['foto_2'],
            'foto_3' => $fotoPaths['foto_3'],
            'slug' => $slug,
            'status' => 'Open',
        ];
        //simpan foto opsional
        if ($request->hasFile('foto_4')) {
            $file = $request->file('foto_4');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $fotoPaths['foto_4'] = $filePath;
            $KosData['foto_4'] = $fotoPaths['foto_4'];
        }
        if ($request->hasFile('foto_5')) {
            $file = $request->file('foto_5');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $fotoPaths['foto_5'] = $filePath;
            $KosData['foto_5'] = $fotoPaths['foto_5'];
        }
        if ($request->hasFile('foto_6')) {
            $file = $request->file('foto_6');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $fotoPaths['foto_6'] = $filePath;
            $KosData['foto_6'] = $fotoPaths['foto_6'];
        }

        if ($request->filled('id_kos')) {
            $Kos = Kos::find($request->input('id_kos'));
            if (!$Kos) {
                return response()->json(['message' => 'Kos not found'], 404);
            }
            if ($request->hasFile('foto_1') == null) {
                $KosData['foto_1'] = $Kos->foto_1;
            }
            if ($request->hasFile('foto_2') == null) {
                $KosData['foto_2'] = $Kos->foto_2;
            }
            if ($request->hasFile('foto_3') == null) {
                $KosData['foto_3'] = $Kos->foto_3;
            }
            $Kos->update($KosData);

            session()->flash('success', 'Berhasil menyimpan perubahan kos');
            return back();
        } else {
            $kos = Kos::create($KosData);
            foreach ($request->input('id_fasilitas') as $index => $id_fasilitas) {
                $fasilitas_umum_kos = new FasilitasUmumKos();
                $fasilitas_umum_kos->id_kos = $kos->id;
                $fasilitas_umum_kos->id_fasilitas = $id_fasilitas;
                $fasilitas_umum_kos->jumlah = $request->input('jumlah')[$index];
                $fasilitas_umum_kos->milik = $request->input('milik')[$index];
                $fasilitas_umum_kos->ketersediaan = $request->has('ketersediaan.' . $index) ? 'Y' : 'N';
                $fasilitas_umum_kos->save();
            }
            foreach ($request->input('tambahan_nama_fasilitas') as $key => $nama_fasilitas) {
                $fasilitas_tambahan = new FasilitasTambahanKos();
                $fasilitas_tambahan->id_kos = $kos->id;
                $fasilitas_tambahan->nama_fasilitas = $nama_fasilitas;
                $fasilitas_tambahan->jumlah = $request->input('tambahan_jumlah_fasilitas')[$key];
                $fasilitas_tambahan->milik = $request->input('tambahan_milik')[$key];
                $fasilitas_tambahan->save();
            }
            session()->flash('success', 'Berhasil mendaftarkan kos');
            return back();
        }
    }
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'foto_1' => 'nullable|image|max:5248', // foto_1 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
            'foto_2' => 'nullable|image|max:5248', // foto_2 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
            'foto_3' => 'nullable|image|max:5248', // foto_3 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
            'nama_kos' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'jumlah_pintu' => 'required|integer', // jumlah_pintu harus berupa bilangan bulat
            'harga_kos' => 'required|numeric', // harga_kos harus berupa bilangan numerik
            'peruntukan' => 'required|string|max:255',
            'ketentuan_kos' => 'required|string|max:255',
            'keterangan_kos' => 'required|string|max:255',
            'alamat_kos' => 'required|string|max:255',
            'foto_4' => 'nullable|image|max:5248', // foto_4 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
            'foto_5' => 'nullable|image|max:5248', // foto_5 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
            'foto_6' => 'nullable|image|max:5248', // foto_6 harus berupa file gambar (jpeg, png, bmp, gif, atau svg) dengan ukuran maksimum 5MB
        ]);

        // Ambil data kos yang akan diupdate
        $kos = Kos::findOrFail($id);
        if (!$kos) {
            return response()->json(['message' => 'Kos not found'], 404);
        }

        // Simpan foto wajib jika ada perubahan
        $fotoPaths = [];
        foreach (['foto_1', 'foto_2', 'foto_3'] as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $fotoPaths[$key] = $filePath;
            }
        }

        // Simpan foto opsional jika ada perubahan
        foreach (['foto_4', 'foto_5', 'foto_6'] as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $fotoPaths[$key] = $filePath;
            }
        }

        // Generate slug
        $slug = Str::slug($request->input('nama_kos'));
        $count = Kos::where('slug', $slug)->where('id', '!=', $id)->count();
        if ($count > 0) {
            $slug = $slug . '-' . time();
        }

        // Update data kos
        $kos->id_user = Auth::id();
        $kos->nama_kos = $request->input('nama_kos');
        $kos->nama_pemilik = $request->input('nama_pemilik');
        $kos->jumlah_pintu = $request->input('jumlah_pintu');
        $kos->harga_kos = $request->input('harga_kos');
        $kos->peruntukan = $request->input('peruntukan');
        $kos->ketentuan_kos = $request->input('ketentuan_kos');
        $kos->keterangan_kos = $request->input('keterangan_kos');
        $kos->alamat_kos = $request->input('alamat_kos');
        $kos->latitude = 0; // Anda mungkin ingin mengganti ini dengan nilai yang sesuai
        $kos->longitude = 0; // Anda mungkin ingin mengganti ini dengan nilai yang sesuai
        $kos->slug = $slug;
        $kos->status = 'Open';

        // Simpan path foto ke model
        $kos->foto_1 = $fotoPaths['foto_1'] ?? $kos->foto_1;
        $kos->foto_2 = $fotoPaths['foto_2'] ?? $kos->foto_2;
        $kos->foto_3 = $fotoPaths['foto_3'] ?? $kos->foto_3;
        $kos->foto_4 = $fotoPaths['foto_4'] ?? $kos->foto_4;
        $kos->foto_5 = $fotoPaths['foto_5'] ?? $kos->foto_5;
        $kos->foto_6 = $fotoPaths['foto_6'] ?? $kos->foto_6;

        // Simpan perubahan
        $kos->save();

        // Flash message untuk memberitahu pengguna bahwa perubahan berhasil disimpan
        session()->flash('success', 'Berhasil menyimpan perubahan kos');
        return back();
    }
    public function update_fasilitas_umum(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255',
            'jumlah' => 'required|integer', // jumlah_pintu harus berupa bilangan bulat
            'milik' => 'required|string|max:255',

        ]);
        $fasilitas_umum_kos = FasilitasUmumKos::findOrFail($request->input('id'));
        $fasilitas_umum_kos->jumlah = $request->input('jumlah');
        $fasilitas_umum_kos->milik = $request->input('milik');
        $fasilitas_umum_kos->ketersediaan = $request->has('ketersediaan') ? 'Y' : 'N';
        $fasilitas_umum_kos->save();
        $message = 'Fasilitas umum updated successfully';
        return response()->json(['message' => $message]);
    }
    public function storeFasilitasTambahan(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'milik' => 'required|string|max:255',
            'id_kos' => 'required|string|max:255',
        ]);

        $fasilitasData = [
            'id_kos' => $request->input('id_kos'),
            'nama_fasilitas' => $request->input('nama_fasilitas'),
            'jumlah' => $request->input('jumlah'),
            'milik' => $request->input('milik'),
        ];

        if ($request->filled('id')) {
            $FasilitasKos = FasilitasTambahanKos::find($request->input('id'));
            if (!$FasilitasKos) {
                return response()->json(['message' => 'Fasilitas not found'], 404);
            }

            $FasilitasKos->update($fasilitasData);
            $message = 'Fasilitas updated successfully';
        } else {
            FasilitasTambahanKos::create($fasilitasData);
            $message = 'Fasilitas created successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $Kos = Kos::find($id);

        if (!$Kos) {
            return response()->json(['message' => 'Kos not found'], 404);
        }

        $Kos->delete();

        return response()->json(['message' => 'Kos deleted successfully']);
    }
    public function destroyFasilitasTambahan($id)
    {
        $fasilitas = FasilitasTambahanKos::find($id);

        if (!$fasilitas) {
            return response()->json(['message' => 'Fasilitas not found'], 404);
        }

        $fasilitas->delete();

        return response()->json(['message' => 'Fasilitas deleted successfully']);
    }
    public function edit($id)
    {
        $Kos = Kos::find($id);

        if (!$Kos) {
            return response()->json(['message' => 'Kos not found'], 404);
        }

        return response()->json($Kos);
    }
    public function edit_fasilitas_umum($id)
    {
        $FasilitasUmumKos = FasilitasUmumKos::with(['fasilitas'])->where('id', $id)->first();

        if (!$FasilitasUmumKos) {
            return response()->json(['message' => 'Fasilitas not found'], 404);
        }

        return response()->json($FasilitasUmumKos);
    }
}
