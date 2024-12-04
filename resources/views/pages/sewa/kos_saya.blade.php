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
            {{-- <h2>{{ $title }}</h2> --}}
            {{-- {{ $sewa_active['kos'] }} --}}
            @if (count($sewa_active) < 0)
                <!-- If $sewa_active is empty, display the message for users who haven't rented a kos -->
                <div class="my-4">
                    <div class="p-3 border" style="border-radius: 20px;">
                        <h3>Kamu belum menyewa kos</h3>
                        Yuk, sewa kos di <strong>SI KOS</strong> dengan sangat mudah dan hemat waktu! Coba cara ngekos
                        modern
                        dengan memesan kos dengan hanya beberapa sentuhan saja..<br>
                        <a href="{{ url('/semua-kos') }}" class="btn btn-primary text-white py-2 px-4 mt-3">Mulai mencari
                            kos
                            sesuai
                            keinginan anda sekarang</a>
                    </div>
                </div>
            @else
                {{-- <pre>{{ json_encode($sewa_active, JSON_PRETTY_PRINT) }}</pre> --}}
                @foreach ($sewa_active as $active)
                    {{-- {{ $active->is_verified }} --}}
                    @if ($active->is_verified == 1)
                        <h3 class="mt-4 text-success">Kos di sewa</h3>
                        <div class="mt-4">
                            <div class="p-3 border" style="border-radius: 20px;">
                                <div class="row align-items-center">
                                    <!-- Gambar Kos -->
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($active['kos']['foto_1']) }}" alt="Image"
                                            style="width: 100%; height:200px; object-fit:cover; border-radius:10px;" />
                                    </div>
                                    <!-- Informasi Kos -->
                                    <div class="col-md-8">
                                        <h1 class="mb-3">{{ $active['kos']['nama_kos'] }}</h1>
                                        <div class="d-flex align-items-center mb-4">
                                            <strong class="p-2 border rounded text-success"
                                                style="font-size: 14px;">{{ $active['kos']['peruntukan'] }}</strong>
                                            <i class="icon-star mx-2 text-success"></i>
                                            <b>{{ App\Models\Rating::getRatingKos($active['kos']['id'] ?? 0) }}</b>
                                            <span class="mx-2"> | Pemilik : {{ $active['kos']['nama_pemilik'] }}</span>
                                            <span class="mx-2"> | Alamat : {{ $active['kos']['alamat_kos'] }}</span>
                                        </div>
                                        <!-- Tanggal Sewa -->
                                        <div class="d-flex align-items-center mb-4">
                                            Jangka Sewa :&nbsp; <strong class="text-success" style="font-size: 14px;">
                                                {{ $active['tanggal_sewa'] }}
                                            </strong> &nbsp;sampai&nbsp;
                                            <strong class="text-danger" style="font-size: 14px;">
                                                {{ date('Y-m-d', strtotime($active['tanggal_sewa'] . ' +' . $active['jangka_waktu'] . ' months')) }}
                                            </strong>
                                        </div>
                                        <!-- Harga dan Aksi -->
                                        <div class="d-flex justify-content-between align-items-end">
                                            <h4 class="fw-bold"><span class="icon-money"></span> Rp
                                                {{ number_format($active['kos']['harga_kos'] * $active['jangka_waktu']) }}
                                            </h4>
                                            <div class="p-2">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ url('/detail-kos', $active['kos']['slug']) }}">Lihat Kos</a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($active['kos']['harga_kos']) . ' kamu sudah bisa sewa di kos : ' . $active['kos']['nama_kos'] . ', yuk cek di sini : ' . url('/detail-kos', $active['kos']['slug'])) }}"
                                                    target="_blank">Bagikan KOS ini ke rekan anda di WhatsApp</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($active->is_verified == 0)
                        <h3 class="mt-4 text-success">Menunggu Persetujuan</h3>
                        <div class="mt-4">
                            <div class="p-3 border" style="border-radius: 20px;">
                                <div class="row align-items-center">
                                    <!-- Gambar Kos -->
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($active['kos']['foto_1']) }}" alt="Image"
                                            style="width: 100%; height:200px; object-fit:cover; border-radius:10px;" />
                                    </div>
                                    <!-- Informasi Kos -->
                                    <div class="col-md-8">
                                        <h1 class="mb-3">{{ $active['kos']['nama_kos'] }}</h1>
                                        <div class="d-flex align-items-center mb-4">
                                            <strong class="p-2 border rounded text-success"
                                                style="font-size: 14px;">{{ $active['kos']['peruntukan'] }}</strong>
                                            <i class="icon-star mx-2 text-success"></i>
                                            <b>{{ App\Models\Rating::getRatingKos($active['kos']['id'] ?? 0) }}</b>
                                            <span class="mx-2"> | Pemilik : {{ $active['kos']['nama_pemilik'] }}</span>
                                            <span class="mx-2"> | Alamat : {{ $active['kos']['alamat_kos'] }}</span>
                                        </div>
                                        <!-- Tanggal Sewa -->
                                        <div class="d-flex align-items-center mb-4">
                                            Jangka Sewa :&nbsp; <strong class="text-success" style="font-size: 14px;">
                                                {{ $active['tanggal_sewa'] }}
                                            </strong> &nbsp;sampai&nbsp;
                                            <strong class="text-danger" style="font-size: 14px;">
                                                {{ date('Y-m-d', strtotime($active['tanggal_sewa'] . ' +' . $active['jangka_waktu'] . ' months')) }}
                                            </strong>
                                        </div>
                                        <!-- Harga dan Aksi -->
                                        <div class="d-flex justify-content-between align-items-end">
                                            <h4 class="fw-bold"><span class="icon-money"></span> Rp
                                                {{ number_format($active['kos']['harga_kos'] * $active['jangka_waktu']) }}
                                            </h4>
                                            <div class="p-2">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ url('/detail-kos', $active['kos']['slug']) }}">Lihat Kos</a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($active['kos']['harga_kos']) . ' kamu sudah bisa sewa di kos : ' . $active['kos']['nama_kos'] . ', yuk cek di sini : ' . url('/detail-kos', $active['kos']['slug'])) }}"
                                                    target="_blank">Bagikan KOS ini ke rekan anda di WhatsApp</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h3 class="mt-4 text-success">Penyewaan ditolak</h3>
                        <div class="mt-4">
                            <div class="p-3 border" style="border-radius: 20px;">
                                <div class="row align-items-center">
                                    <!-- Gambar Kos -->
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($active['kos']['foto_1']) }}" alt="Image"
                                            style="width: 100%; height:200px; object-fit:cover; border-radius:10px;" />
                                    </div>
                                    <!-- Informasi Kos -->
                                    <div class="col-md-8">
                                        <h1 class="mb-3">{{ $active['kos']['nama_kos'] }}</h1>
                                        <div class="d-flex align-items-center mb-4">
                                            <strong class="p-2 border rounded text-success"
                                                style="font-size: 14px;">{{ $active['kos']['peruntukan'] }}</strong>
                                            <i class="icon-star mx-2 text-success"></i>
                                            <b>{{ App\Models\Rating::getRatingKos($active['kos']['id'] ?? 0) }}</b>
                                            <span class="mx-2"> | Pemilik : {{ $active['kos']['nama_pemilik'] }}</span>
                                            <span class="mx-2"> | Alamat : {{ $active['kos']['alamat_kos'] }}</span>
                                        </div>
                                        <!-- Tanggal Sewa -->
                                        <div class="d-flex align-items-center mb-4">
                                            Jangka Sewa :&nbsp; <strong class="text-success" style="font-size: 14px;">
                                                {{ $active['tanggal_sewa'] }}
                                            </strong> &nbsp;sampai&nbsp;
                                            <strong class="text-danger" style="font-size: 14px;">
                                                {{ date('Y-m-d', strtotime($active['tanggal_sewa'] . ' +' . $active['jangka_waktu'] . ' months')) }}
                                            </strong>
                                        </div>
                                        <!-- Harga dan Aksi -->
                                        <div class="d-flex justify-content-between align-items-end">
                                            <h4 class="fw-bold"><span class="icon-money"></span> Rp
                                                {{ number_format($active['kos']['harga_kos'] * $active['jangka_waktu']) }}
                                            </h4>
                                            <div class="p-2">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ url('/detail-kos', $active['kos']['slug']) }}">Lihat Kos</a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="https://api.whatsapp.com/send?text={{ urlencode('Dengan harga Rp ' . number_format($active['kos']['harga_kos']) . ' kamu sudah bisa sewa di kos : ' . $active['kos']['nama_kos'] . ', yuk cek di sini : ' . url('/detail-kos', $active['kos']['slug'])) }}"
                                                    target="_blank">Bagikan KOS ini ke rekan anda di WhatsApp</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="section">
        <div class="container">
            <h2>Riwayat Kos</h2>

            @if (count($sewa_no_active) > 0)
                @foreach ($sewa_no_active as $sewa)
                    @if ($sewa->is_verified == 1 || $sewa->is_verified == 3)
                        <div class="my-4">
                            <div class="p-3 border" style="border-radius: 20px;">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($sewa->kos->foto_1) }}" alt="Image"
                                            style="width: 100%; height:200px; object-fit:cover; border-radius:10px;" />
                                    </div>
                                    <div class="col-md-8">
                                        <h1 class="mb-3">{{ $sewa->kos->nama_kos }} </h1>
                                        <div class="d-flex align-items-center mb-4">
                                            <strong class="p-2 border rounded text-success"
                                                style="font-size: 14px;">{{ $sewa->kos->peruntukan }}</strong>
                                            <i class="icon-star mx-2 text-success"></i>
                                            <b>{{ App\Models\Rating::getRatingKos($sewa->id_kos) }}</b>
                                            <span class="mx-2"> | Pemilik : {{ $sewa->kos->nama_pemilik }}</span>
                                            <span class="mx-2"> | Alamat : {{ $sewa->kos->alamat_kos }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            Jangka Sewa :&nbsp; <strong class="text-success" style="font-size: 14px;">
                                                {{ $sewa->tanggal_sewa }} </strong> &nbsp;sampai&nbsp;
                                            <strong class="text-danger" style="font-size: 14px;">
                                                {{ date('Y-m-d', strtotime($sewa->tanggal_sewa . ' +' . $sewa->jangka_waktu . ' months')) }}
                                            </strong>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <h4 class="fw-bold"><span class="icon-money"></span> Rp
                                                {{ number_format($sewa->kos->harga_kos * $sewa->jangka_waktu) }}</h4>
                                            <div class="p-2">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ url('/detail-kos', $sewa->kos->slug) }}">Lihat Kos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p>Anda belum memiliki riwayat sewa kos.</p>
            @endif
        </div>
    </div>
    <div class="section">
        <div class="container">
            <hr>
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        Rekomendasi KOS
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{ url('/semua-kos') }}" class="btn btn-primary text-white py-3 px-4">Lihat
                            semua KOS</a>
                    </p>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="property-slider justify-content-center">
                            @foreach ($kos as $item)
                                <div class="property-item">
                                    <a href="{{ url('/detail-kos', $item->slug) }}" class="img">
                                        <img src="{{ Storage::url($item->foto_1) }}" alt="Image"
                                            style="width: 100%; height:350px; object-fit:cover;" />
                                    </a>

                                    <div class="property-content">
                                        <div class="price mb-2"><span>Rp {{ number_format($item->harga_kos) }}</span>
                                            <samll style="color: rgb(65, 65, 65); font-size:14px;">/ Bulan <span
                                                    class="badge bg-{{ App\Models\SewaKos::tersedia($item->id) != 0 ? 'success' : 'danger' }} mx-2">{{ App\Models\SewaKos::tersedia($item->id) != 0 ? 'Open' : 'Close' }}</span>
                                            </samll>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <strong class="px-2 border rounded text-success"
                                                    style="font-size: 14px;">{{ $item->peruntukan }}</strong>
                                                <i class="icon-star mx-2 text-success"></i>
                                                <b>{{ App\Models\Rating::getRatingKos($item->id) }}</b> <small
                                                    class="mx-1"> (
                                                    {{ App\Models\Rating::where('id_kos', $item->id)->count() }} Ulasan
                                                    )</small>
                                            </div>
                                            <span class="d-block mb-2 text-black-50">Pemilik : {{ $item->nama_pemilik }}
                                                <b>({{ $item->alamat_kos }})</b>
                                            </span>
                                            <span class="city d-block mb-3">{{ $item->nama_kos }}</span>
                                            <hr class="m-0 p-0">
                                            <div class="specs row mb-4 justify-content-center">
                                                @foreach (App\Models\FasilitasUmumKos::where('id_kos', $item->id)->where('ketersediaan', 1)->get() as $fasilitas)
                                                    <div class="col-md-6">
                                                        <strong
                                                            style="font-size: 16px; color: rgb(65, 65, 65); ">{{ $fasilitas->fasilitas->nama_fasilitas }}</strong>
                                                        <span class="d-block d-flex align-items-center me-3">
                                                            <span class="caption">{{ $fasilitas->jumlah }}
                                                                {{ $fasilitas->milik }}</span>
                                                        </span>
                                                    </div>
                                                @endforeach
                                                @foreach (App\Models\FasilitasTambahanKos::where('id_kos', $item->id)->get() as $fasilitas)
                                                    <div class="col-md-6">
                                                        <strong
                                                            style="font-size: 16px; color: rgb(65, 65, 65); ">{{ $fasilitas->nama_fasilitas }}</strong>
                                                        <span class="d-block d-flex align-items-center me-3">
                                                            <span class="caption">{{ $fasilitas->jumlah }}
                                                                {{ $fasilitas->milik }}</span>
                                                        </span>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <a href="{{ url('/detail-kos', $item->slug) }}"
                                                class="btn btn-primary py-2 px-3 " style="width: 100%;">Lihat Kos</a>

                                        </div>
                                    </div>
                                </div>
                                <!-- .item -->
                            @endforeach

                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property"
                                tabindex="-1">Prev</span>
                            <span class="next" data-controls="next" aria-controls="property"
                                tabindex="-1">Next</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
