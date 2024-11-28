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
    <div class="container">
        <div class="my-3">
            <div id="map" style="height: 500px;"></div>
        </div>
    </div>
@endsection
@push('js')
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
            @foreach (App\Models\Kos::with(['jalan'])->get() as $k)
                L.marker([{{ $k->latitude }}, {{ $k->longitude }}])
                    .addTo(map)
                    .bindPopup(
                        '<b>{{ $k->nama_kos }}</b><br>Rp {{ number_format($k->harga_kos) }}<br>{{ $k->id_jalan != null ? $k->jalan->jalan : '' }}<hr><a href="{{ url('/detail-kos', $k->slug) }}" class="btn btn-sm btn-primary py-1 px-2">Lihat Kos</a><a href="https://www.google.com/maps/dir/?api=1&destination={{ $k->latitude }},{{ $k->longitude }}" target="__blank" class="btn btn-sm btn-warning py-1 px-2 mx-1">Rute</a>'
                    );
            @endforeach
        });
    </script>
@endpush
