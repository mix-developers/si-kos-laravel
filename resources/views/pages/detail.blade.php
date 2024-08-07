@extends('layouts.frontend.app')

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
        <div class="container">
            <div class="row">
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
                            href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($kos->harga_kos) . ' kamu sudah bisa sewa di kos : ' . $kos->nama_kos . ', yuk cek di sini : ' . url('/kos', $kos->slug)) }}"
                            target="_blank">Bagikan KOS ini ke rekan anda di
                            WhatsApp</a>
                    </div>
                    <hr>
                    <h3 class="fw-bold">KOS ini menyediakan</h3>
                    <div class="mb-3 border p-3">
                        <span class="h1">{{ $kos->jumlah_pintu }}</span> <span class="text-black"
                            style="font-size:16px;">Pintu/KOS </span><br>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong>Status KOS : </strong> <span
                                class="badge bg-{{ $kos->status == 'Open' ? 'success' : 'danger' }} mx-2">{{ $kos->status }}</span>
                        </div>
                        <div class="d-flex align-items-center h6 text-black">
                            <strong> Pintu/KOS Tersedia : </strong> <span
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
                </div>
                <div class="col-lg-4 col-md-6">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'User')
                            @php
                                $cek_sewa = App\Models\SewaKos::where('id_user', Auth::user()->id)
                                    ->where('id_kos', $kos->id)
                                    ->count();
                                if ($cek_sewa != 0) {
                                    $tanggal_sewa = App\Models\SewaKos::where('id_user', Auth::user()->id)
                                        ->where('id_kos', $kos->id)
                                        ->latest()
                                        ->first()->tanggal_sewa;

                                    $tanggal_sewa_timestamp = strtotime($tanggal_sewa);

                                    $tanggal_akhir_timestamp = strtotime('+1 month', $tanggal_sewa_timestamp);

                                    $tanggal_akhir = date('Y-m-d', $tanggal_akhir_timestamp);

                                    $check_kos_aktif = App\Models\SewaKos::where('id_user', Auth::user()->id)
                                        ->where('tanggal_sewa', '<=', $tanggal_akhir)
                                        ->where('id_kos', $kos->id)
                                        ->count();
                                }
                                $check_rating = App\Models\Rating::where('id_kos', $kos->id)
                                    ->where('id_user', Auth::id())
                                    ->count();
                                if ($check_rating != 0) {
                                    $ulasan = App\Models\Rating::where('id_kos', $kos->id)
                                        ->where('id_user', Auth::id())
                                        ->first();
                                }
                            @endphp
                            @if ($check_kos_aktif == 0)
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
                                            <a href="https://wa.me/" class="btn  btn-warning" style="display: block;"><i
                                                    class="icon-phone"></i>
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
                            @else
                                <div class="p-3 shadow-lg text-center">
                                    <h5>Anda telah menyewa KOS ini hingga <br><b>{{ $tanggal_akhir }}</b></h5>
                                </div>
                                {{-- rating dan ulasan pengguna --}}
                                @if ($check_rating == 0)
                                    <div class="mt-4">
                                        <div class="p-3 border bg-white shadow">
                                            <h6 class="text-primary mb-3">Bantu pemilik KOS untuk meningkatkan pelayanan
                                                KOS dengan menulis ulasan dan rating dari kamu</h6>
                                            <form action="{{ route('rating.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_kos" value="{{ $kos->id }}">
                                                <div class="mb-3">
                                                    <label>Rating</label>
                                                    <input type="number" name="rating" class="form-control"
                                                        max="5" min="1" required>
                                                    <small>Berikan rating kamu dari 1 sampai 5 berdasarkan pengalaman
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
                                @else
                                    <div class="mt-4">
                                        <div class="p-3 border bg-white shadow">
                                            <h6 class="text-primary mb-3">Terimakasih anda telah membantu pemilik KOS ini
                                                dengan memberikan rating dan ulasan kamu..</h6>
                                            <div class="border p-2">
                                                @for ($i = 1; $i <= $ulasan->rating; $i++)
                                                    <i class="icon-star text-success"></i>
                                                @endfor
                                                <b class="mx-2 text-success">({{ $ulasan->rating }} Rating)</b>
                                                <br>
                                                <p>Ulasan : {{ $ulasan->ulasan }}</p>
                                            </div>
                                        </div>
                                    </div>
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
                                        <a href="https://wa.me/" class="btn  btn-warning" style="display: block;"><i
                                                class="icon-phone"></i>
                                            Tanya
                                            Pemilik KOS</a>
                                        <!-- </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                style="display: block; width:100%;">Ajukan
                                                Sewa</button>
                                        </div> -->
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
                                    <a href="https://wa.me/" class="btn  btn-warning" style="display: block;"><i
                                            class="icon-phone"></i>
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
