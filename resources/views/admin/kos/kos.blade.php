@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <form action="{{ route('kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        {{ $title }}
                    </div>
                    <div class="card-body">
                        {{-- //carousel --}}
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
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
                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 1 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_1">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 2 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_2">
                            </div>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label>Foto 3 <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto_3">
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
                            <input type="text" class="form-control" name="nama_kos" placeholder="Nama KOS" required
                                value="{{ $kos->nama_kos }}">
                        </div>
                        <div class="mb-3">
                            <label>Nama Pemilik <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik"
                                value="{{ $kos->nama_pemilik }}" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Jumlah Pintu <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="jumlah_pintu"
                                    value="{{ $kos->jumlah_pintu }}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Harga Sewa <i class="text-warning">(per-bulan)</i>
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="harga_kos"
                                    value="{{ $kos->harga_kos }}" required>
                            </div>
                            <div class="col-md-5">
                                <label>Peruntukan<span class="text-danger">*</span></label>
                                <select class="form-select" name="peruntukan" required>
                                    <option value="Campuran" @if ($kos->peruntukan == 'Campuran') selected @endif>Campuran
                                    </option>
                                    <option value="Putra" @if ($kos->peruntukan == 'Putra') selected @endif>Putra</option>
                                    <option value="Putri" @if ($kos->peruntukan == 'Putri') selected @endif>Putri</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ketentuan_kos">Ketentuan Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="ketentuan_kos" required>{{ $kos->ketentuan_kos }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_kos">Keterangan Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan_kos" required>{{ $kos->keterangan_kos }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_kos">Alamat Kos <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat_kos" required>{{ $kos->alamat_kos }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Pilih Nama Jalan</label>
                            <select name="id_jalan" class="form-select">
                                @foreach (App\Models\Jalan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->jalan }}</option>
                                @endforeach
                            </select>
                        </div>

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
                                    placeholder="Latitude" required value="{{ $kos->latitude }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="longitude" id="longitude"
                                    placeholder="Longitude" required value="{{ $kos->longitude }}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class=" col-lg-6">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="card mb-3">
                        <div class="card-header flex-column flex-md-row">
                            <div class="head-label ">
                                Fasilitas Umum
                            </div>
                            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                                <div class=" btn-group " role="group">
                                    <button class="btn btn-secondary refresh-umum btn-default" type="button">
                                        <span>
                                            <i class="bx bx-sync me-sm-1"> </i>
                                            <span class="d-none d-sm-inline-block">Refresh Data</span>
                                        </span>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <table class="table table-hover table-sm" id="datatable-fasilitas-umum">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Tersedia</th>
                                    <th>Jumlah</th>
                                    <th>Milik</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card mb-3">
                        <div class="card-header flex-column flex-md-row">
                            <div class="head-label ">
                                Fasilitas Tambahan
                            </div>
                            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                                <div class=" btn-group " role="group">
                                    <button class="btn btn-secondary refresh-tambahan btn-default" type="button">
                                        <span>
                                            <i class="bx bx-sync me-sm-1"> </i>
                                            <span class="d-none d-sm-inline-block"></span>
                                        </span>
                                    </button>
                                    <button class="btn btn-primary create-fasilitas-tambahan btn-default" type="button">
                                        <span>
                                            <i class="bx bx-plus me-sm-1"> </i>
                                            <span class="d-none d-sm-inline-block">Tambah</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover table-sm" id="datatable-fasilitas-tambahan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Jumlah</th>
                                    <th>Milik</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.kos.components.modal')
@endsection
@push('js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil nilai latitude dan longitude dari data
            var latitude = {{ $kos->latitude ?? '0' }};
            var longitude = {{ $kos->longitude ?? '0' }};

            // Tentukan nilai default untuk latitude dan longitude
            var defaultLatitude = -8.504556;
            var defaultLongitude = 140.402424;

            // Atur nilai posisi peta berdasarkan data
            var mapCenter = [latitude != 0 ? latitude : defaultLatitude,
                longitude != 0 ? longitude : defaultLongitude
            ];

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
            var marker = L.marker([{{ $kos->latitude ?? '51.505' }}, {{ $kos->longitude ?? '-0.09' }}]).addTo(
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

    <script>
        $(function() {
            $('#datatable-fasilitas-umum').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('fasilitas-umum-datatable', $kos->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'fasilitas.nama_fasilitas',
                        name: 'fasilitas.nama_fasilitas'
                    },

                    {
                        data: 'ketersediaan',
                        name: 'ketersediaan',
                        render: function(data) {
                            return data === 'Y' ?
                                '<span class="badge bg-label-success">Tersedia</span>' :
                                '<span class="badge bg-label-danger">Tidak</span>';
                        }
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'milik',
                        name: 'milik',
                        render: function(data) {
                            return data === 'Pribadi' ?
                                '<span class="badge bg-label-primary">Pribadi</span>' :
                                '<span class="badge bg-label-warning">Bersama</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $('.refresh-umum').click(function() {
                $('#datatable-fasilitas-umum').DataTable().ajax.reload();
            });
            $('#datatable-fasilitas-tambahan').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('fasilitas-tambahan-datatable', $kos->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'nama_fasilitas',
                        name: 'nama_fasilitas'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'milik',
                        name: 'milik',
                        render: function(data) {
                            return data === 'Pribadi' ?
                                '<span class="badge bg-label-primary">Pribadi</span>' :
                                '<span class="badge bg-label-warning">Bersama</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $('.refresh-tambahan').click(function() {
                $('#datatable-fasilitas-tambahan').DataTable().ajax.reload();
            });
            $('.create-fasilitas-tambahan').click(function() {
                $('#create-fasilitas-tambahan').modal('show');
            });
            window.editFasilitasUmum = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/kos/edit-fasilitas-umum/' + id,
                    success: function(response) {
                        $('#namaFasilitasUmum').text(response.fasilitas.nama_fasilitas);
                        $('#idFasilitasUmum').val(response.id);
                        if (response.ketersediaan === 'Y') {
                            $('#ketersediaanFasilitasUmum').prop('checked', true).val('Y');
                        } else {
                            $('#ketersediaanFasilitasUmum').prop('checked', false).val('N');
                        }
                        $('#jumlahFasilitasUmum').val(response.jumlah);
                        $('#milikFasilitasUmums').val(response.milik);
                        $('#editFasiliasUmumModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#updateFasilitasUmumBtn').click(function() {
                var formData = $('#updateFasilitasUmumForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kos/update-fasilitas-umum',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-fasilitas-umum').DataTable().ajax.reload();
                        $('#editFasiliasUmumModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createFasilitasTambahanBtn').click(function() {
                var formData = $('#createFasilitasTambahanForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kos/store-fasilitas-tambahan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-fasilitas-tambahan').DataTable().ajax.reload();
                        $('#create-fasilitas-tambahan').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteFasilitasTambahan = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/kos/destroy-fasilitas-tambahan/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-fasilitas-tambahan').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
        })
    </script>
@endpush
