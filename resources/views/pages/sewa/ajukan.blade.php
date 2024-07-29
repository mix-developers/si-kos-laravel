@extends('layouts.frontend.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('frontend_theme') }}/images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading aos-init aos-animate" data-aos="fade-up">{{ $title ?? 'judul' }}</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200" class="aos-init aos-animate">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ $title ?? 'judul' }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @elseif (Session::has('danger'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ Session::get('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            @foreach ($errors->all() as $item)
                <ul>
                    <li>{{ $item }}</li>
                </ul>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info">
                        <div class="address mt-2">
                            <h4 class="mb-2">Nama KOS:</h4>
                            <p>
                                {{ $kos->nama_kos }}
                            </p>
                        </div>
                        <div class="address mt-2">
                            <h4 class="mb-2">Pemilik KOS:</h4>
                            <p>
                                {{ $kos->nama_pemilik }}
                            </p>
                        </div>
                        <div class="address mt-2">
                            <h4 class="mb-2">Peruntukan KOS:</h4>
                            <p>
                                {{ $kos->peruntukan }}
                            </p>
                        </div>
                        <div class="address mt-2">
                            <h4 class="mb-2">Alamat KOS:</h4>
                            <p>
                                {{ $kos->alamat_kos }}
                            </p>
                        </div>
                        <div class="address mt-2">
                            <h4 class="mb-2">Ketentuan KOS:</h4>
                            <p>
                                {{ $kos->ketentuan_kos }}
                            </p>
                        </div>
                        <div class="address mt-2">
                            <h4 class="mb-2">Keterangan KOS:</h4>
                            <p>
                                {{ $kos->keterangan_kos }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('sewa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                            <div class="col-12 mb-4">
                                <h2 class="border p-3 text-white" style="border-radius: 20px; background-color:#005555;">
                                    Biaya : <span class=" fw-bold" id="biayaKos">Rp 0</span></h2>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control" placeholder="Nama Penyewa"
                                    value="{{ Auth::user()->name }}" name="nama_penyewa">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control" placeholder="jumalah Orang" required
                                    name="jumlah_orang">
                            </div>
                            <div class="col-12 mb-3">
                                <select name="jangka_waktu" class="form-select form-select-lg" required id="jangkaWaktu">
                                    <option value="">Pilih Jangka Waktu</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }} Bulan</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <input type="date" name="tanggal_sewa" value="{{ $tanggal }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="syarat">
                                    <label class="form-check-label" for="syarat">
                                        Saya telah menyetujui ketentuan penyewaan
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-primary" role="alert">
                                    Dengan mengajukan sewa berarti anda telah menyetujui semua kententuan dan aturan dalam
                                    penyewaan
                                    KOS dengan membayar sesuai dengan harga yang ditentukan menaati peraturan penyewaan KOS
                                    serta menjaga kos dengan tidak merusak fasilitas dalam KOS
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- Tambahkan ID pada tombol submit -->
                                <button type="submit" class="btn btn-primary" id="btnAjukan" disabled>Ajukan
                                    Sewa!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Ambil elemen checkbox dan tombol submit berdasarkan ID
        var checkbox = document.getElementById('syarat');
        var btnAjukan = document.getElementById('btnAjukan');

        // Tambahkan event listener untuk memeriksa perubahan pada checkbox
        checkbox.addEventListener('change', function() {
            // Jika checkbox dicentang
            if (checkbox.checked) {
                // Aktifkan tombol submit
                btnAjukan.disabled = false;
            } else {
                // Jika checkbox tidak dicentang, nonaktifkan tombol submit
                btnAjukan.disabled = true;
            }
        });
    </script>
    <script>
        var hargaAwal = '{{ $kos->harga_kos }}'; // Harga awal yang akan dikalikan

        // Ambil elemen select berdasarkan ID
        var selectJangkaWaktu = document.getElementById('jangkaWaktu');

        // Tambahkan event listener untuk memeriksa perubahan pada select
        selectJangkaWaktu.addEventListener('change', function() {
            // Ambil nilai yang dipilih dari select
            var jangkaWaktu = parseInt(selectJangkaWaktu.value);

            // Validasi bahwa jangkaWaktu adalah angka yang valid
            if (!isNaN(jangkaWaktu)) {
                // Hitung biaya total
                var biayaTotal = hargaAwal * jangkaWaktu;

                // Format biayaTotal ke format "Rp 000.0000"
                var formattedBiaya = 'Rp ' + biayaTotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Tampilkan biaya total di dalam span biayaKos
                document.getElementById('biayaKos').textContent = formattedBiaya;
            } else {
                jangkaWaktu = 0;
                var formattedBiaya = 'Rp ' + jangkaWaktu.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                document.getElementById('biayaKos').textContent = formattedBiaya;
            }
        });
    </script>
@endsection
