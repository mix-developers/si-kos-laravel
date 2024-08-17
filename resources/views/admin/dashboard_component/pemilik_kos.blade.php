@php
    $cek_kos = App\Models\Kos::where('id_user', Auth::id())->latest()->first();
@endphp
<div class="container mb-3">
    <div class="jumbotron text-center">
        <h1>Selamat Datang kembali <span class="text-primary">{{ Auth::user()->name }}</span></h1>
        <p>Silahkan cek pada menu <strong>Penyewaan</strong> untuk melihat siapa yang tertarik untuk menyewa KOS anda
        </p>
    </div>
    <hr>
</div>
@if ($cek_kos)
    @php
        $kos = App\Models\Kos::where('id_user', Auth::id())->latest()->first();
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner shadow-lg" style="border-radius: 20px;">
                        @if ($kos->foto_1 != null)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_1) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 1</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_2 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_2) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 2</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_2 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_2) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 3</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_3 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_3) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 4</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_4 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_4) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 5</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_5 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_5) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 1</h3>
                                </div>
                            </div>
                        @endif
                        @if ($kos->foto_6 != null)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ Storage::url($kos->foto_6) }}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Foto 1</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="card card-border-shadow-primary h-100 mb-3">
                            <div class="card-body ">
                                <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bxs-home"></i></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{ App\Models\SewaKos::tersewa($kos->id) }}</h4>
                                </div>
                                <p class="mb-1">Tersewa</p>
                                <p class="mb-0">
                                    <small class="text-muted">Kos yang tersewa</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-border-shadow-warning h-100 mb-3">
                            <div class="card-body ">
                                <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                        <span class="avatar-initial rounded bg-label-warning"><i
                                                class="bx bxs-home"></i></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{ App\Models\SewaKos::tersedia($kos->id) }}</h4>
                                </div>
                                <p class="mb-1">Tersedia</p>
                                <p class="mb-0">
                                    <small class="text-muted">Kos yang belum tersewa</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <h4 class="text-primary">Informasi KOS</h4>
                        <hr>
                        <strong>Nama KOS : </strong>{{ $kos->nama_kos }}<br>
                        <strong>Nama Pemilik : </strong>{{ $kos->nama_pemilik }}<br>
                        <strong>Jumlah Pintu : </strong>{{ $kos->jumlah_pintu }}<br>
                        <strong>Peruntukan : </strong>{{ $kos->peruntukan }}<br>
                        <strong>Alamat : </strong>{{ $kos->alamat_kos }}<br>
                        <strong>Status :
                        </strong>{!! $kos->status == 'Open'
                            ? '<span class="badge bg-success">Open</span>'
                            : '<span class="badge bg-danger">Close</span>' !!}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('kos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header bg-primary mb-2">
                        <h4 class="text-white">Form Pendaftaran KOS</h4>
                        <small class="text-light">*harap mengisi data dengan benar dan teliti</small>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <strong>note : ( <span class="text-danger">*</span> ) menandakan wajib untuk diisi.</strong>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 1 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_1" required>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 2 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_2" required>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 3 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_3" required>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 4 </label>
                                <input type="file" class="form-control" name="foto_4">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 5</label>
                                <input type="file" class="form-control" name="foto_5">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 6</label>
                                <input type="file" class="form-control" name="foto_6">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label>Nama KOS <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_kos" placeholder="Nama KOS"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Pemilik <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pemilik"
                                placeholder="Nama Pemilik" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label>Jumlah Pintu <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="jumlah_pintu" value="2"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label>Harga Sewa <i class="text-warning">(per-bulan)</i>
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga_kos" value="0" required>
                            </div>
                            <div class="col-md-6">
                                <label>Peruntukan<span class="text-danger">*</span></label>
                                <select class="form-select" name="peruntukan" required>
                                    <option value="Campuran">Campuran</option>
                                    <option value="Putra">Putra</option>
                                    <option value="Putri">Putri</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ketentuan_kos">Ketentuan Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="ketentuan_kos" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_kos">Keterangan Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan_kos" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_kos">Alamat Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat_kos" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Pilih Nama Jalan</label>
                            <select name="id_jalan" class="form-select">
                                @foreach (App\Models\Jalan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->jalan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-3 p-2 border border-primary shadow-sm" style="border-radius: 10px;">
                            <strong>Fasilitas KOS </strong>
                            <hr>
                            <div class="row">
                                @foreach (App\Models\FasilitasKos::all() as $item)
                                    <div class="col-12 mb-3">
                                        <strong>{{ $loop->iteration }}. {{ $item->nama_fasilitas }} <span
                                                class="text-danger">*</span></strong>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="">Ketersediaan</label>
                                        <div class="form-check form-switch mb-2">

                                            <input class="form-check-input" name="ketersediaan" type="checkbox"
                                                id="flexSwitchCheckChecked" checked value="Y">

                                            <label class="form-check-label text-primary"
                                                for="flexSwitchCheckChecked">Tersedia</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_fasilitas[]" value="{{ $item->id }}">
                                    <div class="col-md-5 mb-3">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah[]" value="0">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label>Kepemilikan</label>
                                        <select name="milik[]" class="form-select">
                                            <option value="Pribadi">Pribadi</option>
                                            <option value="Bersama">Bersama</option>
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="my-3 p-2 border border-success shadow-sm" style="border-radius: 10px;">
                            <strong>Fasilitas Tambahan</strong>
                            <hr>
                            <div class="" id="dynamicForms">
                                <div class="row  align-items-end">
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Nama Fasilitas</label>
                                        <input type="text" name="tambahan_nama_fasilitas[]" class="form-control"
                                            placeholder="Nama Fasilitas">
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="">Jumlah Fasilitas</label>
                                        <input type="number" name="tambahan_jumlah_fasilitas[]" class="form-control"
                                            value="1">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="">Kepemilikan Fasilitas</label>
                                        <select name="tambahan_milik[]" class="form-select">
                                            <option value="Pribadi">Pribadi</option>
                                            <option value="Bersama">Bersama</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 mb-3">
                                        <button type="button" class="btn btn-sm btn-success" id="btnAdd">
                                            <i class="bx bx-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Tambahkan div untuk peta -->
                        <div class="mb-3">
                            <label>Lokasi Kos</label>
                            <div id="map" style="height: 400px;"></div>
                        </div>

                        <!-- Input untuk Latitude dan Longitude -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="latitude" id="latitude"
                                    placeholder="Latitude" required readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="longitude" id="longitude"
                                    placeholder="Longitude" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#btnAdd").click(function() {
                    var html = '<div class="row align-items-end">' +
                        '<div class="col-lg-4 mb-3">' +
                        '<label for="">Nama Fasilitas</label>' +
                        '<input type="text" name="tambahan_nama_fasilitas[]" class="form-control" placeholder="Nama Fasilitas" >' +
                        '</div>' +
                        '<div class="col-lg-3 mb-3">' +
                        '<label for="">Jumlah Fasilitas</label>' +
                        '<input type="number" name="tambahan_jumlah_fasilitas[]" class="form-control" value="1">' +
                        '</div>' +
                        '<div class="col-lg-4 mb-3">' +
                        '<label for="">Kepemilikan Fasilitas</label>' +
                        '<select name="tambahan_milik[]" class="form-select">' +
                        '<option value="Pribadi">Pribadi</option>' +
                        '<option value="Bersama">Bersama</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-lg-1 mb-3">' +
                        '<button type="button" class="btn btn-sm btn-danger btnRemove">' +
                        '<i class="bx bx-minus"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>';

                    $("#dynamicForms").append(html);
                });

                // Remove dynamic form
                $(document).on("click", ".btnRemove", function() {
                    $(this).closest(".row").remove();
                });
            });
        </script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.css" />

        <script>
            document.addEventListener('DOMContentLoaded', function() {


                // Tentukan nilai default untuk latitude dan longitude
                var defaultLatitude = -8.504556;
                var defaultLongitude = 140.402424;

                // Atur nilai posisi peta berdasarkan data
                var mapCenter = [defaultLatitude, defaultLongitude];

                // Inisialisasi peta
                var map = L.map('map').setView(mapCenter, 13);

                // Menambahkan layer peta jalan (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Menambahkan layer peta satelit (Esri)
                var Esri_WorldImagery = L.tileLayer(
                    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                        attribution: '&copy; <a href="https://www.esri.com/en-us/home">Esri</a>'
                    });

                // Menambahkan kontrol layer untuk memilih antara jalan dan satelit
                var baseLayers = {
                    "Streets": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
                    "Satellite": Esri_WorldImagery
                };
                L.control.layers(baseLayers).addTo(map);

                // Menambahkan kontrol zoom dan fullscreen
                L.control.zoom({
                    position: 'topright'
                }).addTo(map);
                L.control.fullscreen().addTo(map);

                // Marker
                var marker = L.marker([-8.504556, 140.402424]).addTo(
                    map);

                // Fungsi untuk memperbarui input latitude dan longitude
                function updateLatLng(e) {
                    document.getElementById('latitude').value = e.latlng.lat;
                    document.getElementById('longitude').value = e.latlng.lng;
                }

                // Menambahkan event listener pada map untuk mengupdate marker dan input saat peta diklik
                map.on('click', function(e) {
                    marker.setLatLng(e.latlng).bindPopup("Latitude: " + e.latlng.lat + "<br>Longitude: " + e
                        .latlng.lng).openPopup();
                    updateLatLng(e);
                });
            });
        </script>
    @endpush
@endif
