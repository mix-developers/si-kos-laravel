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
    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        Semua KOS
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{ url('/maps-kos') }}" class="btn btn-warning text-white py-3 px-4">Lihat Peta</a>
                        <a href="{{ url('/cari-kos') }}" class="btn btn-primary text-white py-3 px-4">Cari
                            KOS</a>
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">

                @foreach ($kos as $item)
                    <div class="col-lg-4 col-md-6">

                        <div class="property-item">
                            <a href="{{ url('/detail-kos', $item->slug) }}" class="img">
                                <img src="{{ Storage::url($item->foto_1) }}" alt="Image"
                                    style="width: 100%; height:350px; object-fit:cover;" />
                            </a>
                            <div class="property-content">
                                <div class="price mb-2"><span>Rp {{ number_format($item->harga_kos) }}</span>
                                    <samll style="color: rgb(65, 65, 65); font-size:14px;">/ Bulan
                                        <span
                                            class="badge bg-{{ App\Models\SewaKos::tersedia($item->id) != 0 ? 'success' : 'danger' }} mx-2">{{ App\Models\SewaKos::tersedia($item->id) != 0 ? 'Open' : 'Close' }}</span>
                                    </samll>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center">
                                        <strong class="px-2 border rounded text-success"
                                            style="font-size: 14px;">{{ $item->peruntukan }}</strong>
                                        <i class="icon-star mx-2 text-success"></i>
                                        <b>{{ App\Models\Rating::getRatingKos($item->id) }} </b> <small class="mx-1"> (
                                            {{ App\Models\Rating::where('id_kos', $item->id)->count() }} Ulasan )</small>
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
                                    <a href="{{ url('/detail-kos', $item->slug) }}" class="btn btn-primary py-2 px-3 "
                                        style="width: 100%">Lihat
                                        Kos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .item -->
                @endforeach
            </div>
        </div>
    </div>
@endsection
