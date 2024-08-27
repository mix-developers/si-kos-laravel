@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label ">
                        <h5 class="card-title mb-0">{{ $title ?? 'Title' }}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class=" btn-group " role="group">
                            <button class="btn btn-secondary refresh btn-default" type="button">
                                <span>
                                    <i class="bx bx-sync me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Refresh Data</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="m-2">
                    <label>Filter Laporan :</label>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <select class="form-select " name="id_kelurahan" id="selectKelurahan">
                                <option value="">Pilih Keluarahan</option>
                                @foreach (App\Models\Kelurahan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->kelurahan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="id_jalan" id="selectJalan">
                                <option value="">Pilih Jalan</option>
                                @foreach (App\Models\Jalan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->jalan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="peruntukan" id="selectPeruntukan">
                                <option value="">Pilih Peruntukan</option>
                                <option value="Campuran">Campuran</option>
                                <option value="Putri">Putri</option>
                                <option value="Putra">Putra</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" id="filter"><i class="bx bx-filter"></i>
                                Filter</button>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-datatable table-responsive">
                    <table id="datatable-kos" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama KOS</th>
                                <th>Pemilik</th>
                                <th>Pintu</th>
                                <th>Harga</th>
                                <th>Peruntukan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama KOS</th>
                                <th>Pemilik</th>
                                <th>Pintu</th>
                                <th>Harga</th>
                                <th>Peruntukan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            table = $('#datatable-kos').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: {
                    url: '{{ url('kos-datatable') }}',
                    data: function(d) {
                        d.selectJalan = $('#selectJalan').val();
                        d.selectKelurahan = $('#selectKelurahan').val();
                        d.selectPeruntukan = $('#selectPeruntukan').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'nama_kos',
                        name: 'nama_kos'
                    },
                    {
                        data: 'nama_pemilik',
                        name: 'nama_pemilik'
                    },
                    {
                        data: 'jumlah_pintu',
                        name: 'jumlah_pintu'
                    },
                    {
                        data: 'harga_kos',
                        name: 'harga_kos'
                    },
                    {
                        data: 'peruntukan',
                        name: 'peruntukan'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                ],
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf"></i> PDF',
                        className: 'btn-danger mx-3',
                        orientation: 'landscape',
                        title: '{{ $title }}',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 8;
                            doc.styles.tableHeader.fillColor = '#2a6908';


                        },
                        header: true
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="bx bxs-file-export"></i> Excel',
                        className: 'btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $('.refresh').click(function() {
                table.ajax.reload();
            });

            $('#filter').click(function() {
                table.ajax.url('{{ url('kos-datatable') }}?' + $.param({
                    id_jalan: $('#selectJalan').val(),
                    id_kelurahan: $('#selectKelurahan').val(),
                    peruntukan: $('#selectPeruntukan').val(),
                })).load();
            });
        });
    </script>

    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
