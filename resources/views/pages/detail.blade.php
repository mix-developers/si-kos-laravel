@extends('layouts.frontend.app')
@push('css')
    <!-- Tambahkan di dalam <head> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.css" />

    <!-- Tambahkan di bagian bawah <body> sebelum penutup </body> -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
@endpush
@section('content')
    <div class="hero">
        <div class="hero-slide">
            @if ($kos->foto_1 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_1) }}')">
                </div>
            @endif
            @if ($kos->foto_2 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_2) }}')">
                </div>
            @endif
            @if ($kos->foto_3 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_3) }}')">
                </div>
            @endif
            @if ($kos->foto_4 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_4) }}')">
                </div>
            @endif
            @if ($kos->foto_5 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_5) }}')">
                </div>
            @endif
            @if ($kos->foto_6 != null)
                <div class="img overlay" style="background-image: url('{{ Storage::url($kos->foto_6) }}')">
                </div>
            @endif
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        {{ $title }}
                    </h1>
                    <h5 class="text-white" data-aos="fade-up">Selamat datang di <mark>{{ $kos->nama_kos }}</mark>
                        <br>Pemilik :
                        {{ $kos->nama_pemilik }}
                        <br>Alamat :
                        {{ $kos->alamat_kos }}
                    </h5>

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
        <div class="container text-center">
            <div class="row ">
                @if ($kos->foto_1 != null)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                        <img src="{{ Storage::url($kos->foto_1) }}" alt="Image" class="img-fluid">
                    </div>
                @endif
                @if ($kos->foto_2 != null)
                    <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ Storage::url($kos->foto_2) }}" alt="Image" class="img-fluid">
                    </div>
                @endif
                @if ($kos->foto_3 != null)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ Storage::url($kos->foto_3) }}" alt="Image" class="img-fluid">
                    </div>
                @endif

            </div>

        </div>
    </div>
    <section class="section">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <h1 class="mb-3">{{ $kos->nama_kos }} </h1>
                    <div class="d-flex align-items-center mb-4">
                        <strong class="p-2 border rounded text-success"
                            style="font-size: 14px;">{{ $kos->peruntukan }}</strong>
                        <i class="icon-star mx-2 text-success"></i> <b>{{ App\Models\Rating::getRatingKos($kos->id) }}</b>
                        <span class="mx-2"> | Pemilik : {{ $kos->nama_pemilik }}</span>
                        <span class="mx-2"> | Alamat : {{ $kos->alamat_kos }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <h4><span class="icon-home2"></span> Banyak pilihan kamar untukmu</h4>
                        <a class="btn btn-primary btn-sm"
                            href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($kos->harga_kos) . ' kamu sudah bisa sewa di kos : ' . $kos->nama_kos . ', yuk cek di sini : ' . url('/detail-kos', $kos->slug)) }}"
                            target="_blank">Bagikan KOS ini ke rekan anda di
                            WhatsApp</a>
                        @if (Auth::check())
                            <a href="javascript:void(0);" class="btn favorit-btn" data-item-id="{{ $kos->id }}">
                                <i class="fa fa-heart {{ $isFavorited ? 'text-danger' : 'text-muted' }}"
                                    style="font-size: 30px;"></i>
                            </a>
                        @endif
                    </div>
                    <hr>
                    <h3 class="fw-bold">KOS ini menyediakan</h3>
                    <div class="mb-3 border p-3">
                        <span class="h1">{{ $kos->jumlah_pintu }}</span> <span class="text-black"
                            style="font-size:16px;">Pintu/detail-KOS </span><br>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong>Status KOS : </strong> <span
                                class="badge bg-{{ App\Models\SewaKos::tersedia($kos->id) != 0 ? 'success' : 'danger' }} mx-2">{{ App\Models\SewaKos::tersedia($kos->id) != 0 ? 'Open' : 'Close' }}</span>
                        </div>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong> Pintu/detail-KOS Tersedia : </strong> <span
                                class="badge bg-{{ App\Models\SewaKos::tersedia($kos->id) != 0 ? 'success' : 'danger' }} mx-2">{{ App\Models\SewaKos::tersedia($kos->id) }}</span>
                        </div>
                    </div>
                    <h3 class="fw-bold">Yang Kamu dapatkan di KOS ini</h3>
                    <div class="row my-3">
                        @foreach (App\Models\FasilitasUmumKos::with(['fasilitas'])->where('id_kos', $kos->id)->where('ketersediaan', 1)->get() as $item)
                            <div class="col-md-6">
                                <div class="box-feature border mb-4 p-3">
                                    <span class="flaticon-house-2 mb-4 d-block-3"></span>
                                    <h3 class="text-black mb-3 fw-bold">{{ $item->fasilitas->nama_fasilitas }}
                                    </h3>
                                    <p>Jumlah : {{ $item->jumlah }} ({{ $item->milik }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="fw-bold">Fasilitas Tambahan</h3>
                    <div class="row my-3">
                        @foreach (App\Models\FasilitasTambahanKos::where('id_kos', $kos->id)->get() as $item)
                            <div class="col-md-6">
                                <div class="box-feature border mb-4 p-3">
                                    <span class="flaticon-house-2 mb-4 d-block-3"></span>
                                    <h3 class="text-black mb-3 fw-bold">{{ $item->nama_fasilitas }}
                                    </h3>
                                    <p>Jumlah : {{ $item->jumlah }} ({{ $item->milik }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="fw-bold">Ketentuan KOS</h3>
                    <p class="p-3 border">
                        {{ $kos->ketentuan_kos }}
                    </p>
                    <h3 class="fw-bold">Keterangan KOS</h3>
                    <p class="p-3 border">
                        {{ $kos->keterangan_kos }}
                    </p>
                    <h3 class="fw-bold">Peta Kos</h3>
                    <div class="p-3 border">
                        @if ($kos->latitude == 0)
                            <p>Pemilik belum menyertakan lokasi pada peta</p>
                        @else
                            <div id="map" style="height: 500px;"></div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'User')
                            @php
                                // Cek status sewa pengguna untuk kos ini
                                $sewaKos = App\Models\SewaKos::where('id_user', Auth::id())
                                    ->where('id_kos', $kos->id)
                                    ->latest()
                                    ->first();

                                $isSewaAktif = false;
                                $tanggalAkhir = null;

                                if ($sewaKos) {
                                    $tanggalSewa = strtotime($sewaKos->tanggal_sewa);
                                    $tanggalAkhir = date('Y-m-d', strtotime('+1 month', $tanggalSewa));

                                    // Jika sekarang masih dalam periode aktif
                                    $isSewaAktif = strtotime(now()) <= strtotime($tanggalAkhir);
                                }

                                // Cek apakah pengguna sudah memberikan rating
                                $ulasan = App\Models\Rating::where('id_kos', $kos->id)
                                    ->where('id_user', Auth::id())
                                    ->first();
                            @endphp

                            {{-- Jika pengguna belum pernah menyewa kos ini --}}
                            @if (!$sewaKos)
                                <form action="{{ route('sewa.ajukan') }}" method="GET">
                                    <div class="p-3 shadow-lg">
                                        <div class="d-flex align-items-center mb-3">
                                            <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                                            (per-bulan)
                                        </div>
                                        <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                        <div class="mb-3">
                                            <label>Tanggal masuk</label>
                                            <input type="date" class="form-control form-lg" name="tanggal" required>
                                        </div>
                                        <div class="mb-3">
                                            <a href="https://wa.me/{{ $kos->user->no_hp }}" class="btn btn-warning"
                                                style="display: block;">
                                                <i class="icon-phone"></i> Tanya Pemilik KOS
                                            </a>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                style="width: 100%;">Ajukan Sewa</button>
                                        </div>

                                    </div>
                                </form>
                            @else
                                {{-- Jika sewa masih aktif --}}
                                @if ($isSewaAktif)
                                    @if ($sewaKos->is_verified == 0)
                                        <div class="p-3 shadow-lg text-center text-warning">
                                            <h5 class="text-danger">Silahkan menunggu pemilik kos menerima pengajuan
                                                anda</b>
                                            </h5>
                                        </div>
                                    @elseif($sewaKos->is_verified != 2 && $sewaKos->is_verified == 1)
                                        <div class="p-3 shadow-lg text-center">
                                            <h5>Anda telah menyewa KOS ini hingga <br><b>{{ $tanggalAkhir }}</b></h5>
                                        </div>
                                    @else
                                        <form action="{{ route('sewa.ajukan') }}" method="GET">
                                            <div class="p-3 shadow-lg">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                                                    (per-bulan)
                                                </div>
                                                <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                                <div class="mb-3">
                                                    <label>Tanggal masuk</label>
                                                    <input type="date" class="form-control form-lg" name="tanggal"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <a href="https://wa.me/{{ $kos->user->no_hp }}"
                                                        class="btn btn-warning" style="display: block;">
                                                        <i class="icon-phone"></i> Tanya Pemilik KOS
                                                    </a>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary btn-block"
                                                        style="width: 100%;">Ajukan Sewa</button>
                                                </div>

                                            </div>
                                        </form>
                                    @endif
                                    {{-- Jika pengguna belum memberikan rating --}}
                                    @if (!$ulasan)
                                        @if ($sewaKos->is_verified == 1)
                                            <div class="mt-4">
                                                <div class="p-3 border bg-white shadow">
                                                    <h6 class="text-primary mb-3">Bantu pemilik KOS untuk meningkatkan
                                                        pelayanan dengan menulis ulasan dan rating</h6>
                                                    <form action="{{ route('rating.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id_kos"
                                                            value="{{ $kos->id }}">
                                                        <div class="mb-3">
                                                            <label>Rating</label>
                                                            <input type="number" name="rating" class="form-control"
                                                                max="5" min="1" required>
                                                            <small>Berikan rating kamu dari 1 sampai 5 berdasarkan
                                                                pengalaman
                                                                kamu</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Ulasan Anda</label>
                                                            <textarea class="form-control" name="ulasan" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        {{-- Jika pengguna sudah memberikan rating --}}
                                        <div class="mt-4">
                                            <div class="p-3 border bg-white shadow">
                                                <h6 class="text-primary mb-3">Terima kasih telah memberikan rating dan
                                                    ulasan!</h6>
                                                <div class="border p-2">
                                                    @for ($i = 1; $i <= $ulasan->rating; $i++)
                                                        <i class="icon-star text-success"></i>
                                                    @endfor
                                                    <b class="mx-2 text-success">({{ $ulasan->rating }} Rating)</b>
                                                    <br>
                                                    <p>Ulasan: {{ $ulasan->ulasan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="my-3">
                                        <a href="https://wa.me/{{ $kos->user->no_hp }}" class="btn btn-warning"
                                            style="display: block;">
                                            <i class="icon-phone"></i> Tanya Pemilik KOS
                                        </a>
                                    </div>
                                @else
                                    {{-- Jika sewa telah berakhir --}}
                                    <form action="{{ route('sewa.ajukan') }}" method="GET">
                                        <div class="p-3 shadow-lg">
                                            <div class="d-flex align-items-center mb-3">
                                                <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                                                (per-bulan)
                                            </div>
                                            <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                            <div class="mb-3">
                                                <label>Tanggal masuk</label>
                                                <input type="date" class="form-control form-lg" name="tanggal"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <a href="https://wa.me/{{ $kos->user->no_hp }}" class="btn btn-warning"
                                                    style="display: block;">
                                                    <i class="icon-phone"></i> Tanya Pemilik KOS
                                                </a>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary btn-block"
                                                    style="width: 100%;">Ajukan Sewa</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        @else
                            <form action="{{ route('sewa.ajukan') }}" method="GET">
                                <div class="p-3 shadow-lg">
                                    <div class="d-flex align-items-center mb-3">
                                        <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                                        (per-bulan)
                                    </div>
                                    <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                    <div class="mb-3">
                                        <label>Tanggal masuk</label>
                                        <input type="date" class="form-control form-lg" name="tanggal" required>
                                    </div>
                                    <div class="mb-3">
                                        <a href="https://wa.me/{{ $kos->user->no_hp }}" class="btn  btn-warning"
                                            style="display: block;"><i class="icon-phone"></i>
                                            Tanya
                                            Pemilik KOS</a>
                                    </div>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('sewa.ajukan') }}" method="GET">
                            <div class="p-3 shadow-lg">
                                <div class="d-flex align-items-center mb-3">
                                    <h2 class="mx-2 fw-bold">Rp {{ number_format($kos->harga_kos) }}</h2>
                                    (per-bulan)
                                </div>
                                <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                <div class="mb-3">
                                    <label>Tanggal masuk</label>
                                    <input type="date" class="form-control form-lg" name="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <a href="https://wa.me/{{ $kos->user->no_hp }}" class="btn  btn-warning"
                                        style="display: block;"><i class="icon-phone"></i>
                                        Tanya
                                        Pemilik KOS</a>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-block"
                                        style="display: block; width:100%;">Ajukan
                                        Sewa</button>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="text-primary">Rating dan Ulasan pengguna </b>
                                <small class="mx-1"> ({{ App\Models\Rating::where('id_kos', $kos->id)->count() }} Ulasan
                                    )</small>
                        </div>
                        @foreach (App\Models\Rating::with(['user'])->where('id_kos', $kos->id)->latest()->limit(5)->get() as $item)
                            <div class="p-2 border">
                                @for ($i = 1; $i <= $item->rating; $i++)
                                    <i class="icon-star text-success"></i>
                                @endfor
                                <b class="mx-2 text-success">({{ $item->rating }} Rating)</b>
                                <br>
                                <strong>{{ $item->user->name }} : </strong>
                                <br>
                                <p class="mb-1">" {{ $item->ulasan }} "</p>
                                <small>{{ $item->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch CSRF token from the meta tag in the HTML head
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            document.querySelectorAll('.favorit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const icon = this.querySelector('i');

                    // Perform an AJAX request to toggle favorite status
                    fetch(`/toggle-favorite`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                id_kos: itemId
                            }) // Include the itemId in the request body
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'Ditambahkan') {
                                icon.classList.remove('text-muted');
                                icon.classList.add('text-danger');
                            } else if (data.status === 'dihapus') {
                                icon.classList.remove('text-danger');
                                icon.classList.add('text-muted');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Membuat peta dan menentukan pusat awal serta zoom level
            var map = L.map('map').setView([-8.504556, 140.402424], 13);

            // Menambahkan layer peta jalan (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Menambahkan layer peta satelit (Esri)
            var Esri_WorldImagery = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: '&copy; <a href="https://www.esri.com/en-us/home">Esri</a>'
                });

            // Layer control untuk memilih antara jalan dan satelit
            var baseLayers = {
                "Streets": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
                "Satellite": Esri_WorldImagery
            };
            L.control.layers(baseLayers).addTo(map);

            // Menambahkan kontrol zoom dan fullscreen

            L.control.fullscreen().addTo(map);

            // Mengambil data marker dari server
            L.marker([{{ $kos->latitude != 0 ? $kos->latitude : '' }},
                    {{ $kos->longitude != 0 ? $kos->longitude : '' }}
                ])
                .addTo(map)
                .bindPopup(
                    '<b>{{ $kos->nama_kos }}</b><br>Rp {{ number_format($kos->harga_kos) }}<br>{{ $kos->id_jalan != null ? $kos->jalan->jalan : '' }}<hr><a href="https://www.google.com/maps/dir/?api=1&destination={{ $kos->latitude }},{{ $kos->longitude }}" target="__blank" class="btn btn-sm btn-warning py-1 px-2 mx-1">Rute Menuju Kos</a>'
                );
        });
    </script>
@endpush
