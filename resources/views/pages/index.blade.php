@extends('layouts.frontend.app')

@section('content')
    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay" style="background-image: url('{{ asset('frontend_theme') }}/images/hero_bg_3.jpg')">
            </div>
            <div class="img overlay" style="background-image: url('{{ asset('frontend_theme') }}/images/hero_bg_2.jpg')">
            </div>
            <div class="img overlay" style="background-image: url('{{ asset('frontend_theme') }}/images/hero_bg_1.jpg')">
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        Cari KOS yang anda inginkan dengan mudah dan akurat
                    </h1>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftarkan diri sekarang</a>
                    @else
                        <a href="" class="btn btn-primary">Cari Kos Sekarang</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        Rekomendasi KOS
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{ url('/maps-kos') }}" class="btn btn-warning text-white py-3 px-4">Lihat Peta</a>
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
                                    <a href="{{ url('/kos', $item->slug) }}" class="img">
                                        <img src="{{ Storage::url($item->foto_1) }}" alt="Image"
                                            style="width: 100%; height:350px; object-fit:cover;" />
                                    </a>

                                    <div class="property-content">
                                        <div class="price mb-2"><span>Rp {{ number_format($item->harga_kos) }}</span>
                                            <samll style="color: rgb(65, 65, 65); font-size:14px;">/ Bulan</samll>
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
                                            <a href="{{ url('/kos', $item->slug) }}" class="btn btn-primary py-2 px-3 "
                                                style="width: 100%">Lihat Kos</a>

                                        </div>
                                    </div>
                                </div>
                                <!-- .item -->
                            @endforeach

                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section bg-success text-white">
        <div class="container ">
            <div class="row section-counter mt-5 text-center">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span
                                class="countup text-white">{{ App\Models\User::where('role', 'Pemilik_kos')->count() }}</span></span>
                        <span class="caption text-white-50"># Pemilik KOS</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-white">{{ App\Models\Kos::count() }}</span></span>
                        <span class="caption text-white-50"># KOS Terdaftar</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span
                                class="countup text-white">{{ App\Models\User::where('role', 'User')->count() }}</span></span>
                        <span class="caption text-white-50"># Pencari KOS</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span
                                class="countup text-white">{{ App\Models\SewaKos::where('is_verified', 1)->count() }}</span></span>
                        <span class="caption text-white-50"># Penyewaan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
