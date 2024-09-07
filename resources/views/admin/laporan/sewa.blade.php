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
                            <div class="input-group">
                                <input type="number" class="form-control" value="0" id="inputJangkaWaktu">
                                <span class="input-group-text">Bulan</span>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" id="filter"><i class="bx bx-filter"></i>
                                Filter</button>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-datatable table-responsive">
                    <table id="datatable-sewa" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kos</th>
                                <th>Alamat Kos</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal masuk</th>
                                <th>jangka waktu</th>
                                <th>jumlah orang</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kos</th>
                                <th>Alamat Kos</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal masuk</th>
                                <th>jangka waktu</th>
                                <th>jumlah orang</th>
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
            table = $('#datatable-sewa').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: {
                    url: '{{ url('sewa-datatable') }}',
                    data: function(d) {
                        d.inputJangkaWaktu = $('#inputJangkaWaktu').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'kos.nama_kos',
                        name: 'kos.nama_kos'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'nama_penyewa',
                        name: 'nama_penyewa'
                    },
                    {
                        data: 'tanggal_sewa',
                        name: 'tanggal_sewa'
                    },
                    {
                        data: 'jangka_waktu',
                        name: 'jangka_waktu',
                        render: function(data, type, row) {
                            return data + ' Bulan';
                        }
                    },
                    {
                        data: 'jumlah_orang',
                        name: 'jumlah_orang',
                        render: function(data, type, row) {
                            return data + ' Orang';
                        }
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
                table.ajax.url('{{ url('sewa-datatable') }}?' + $.param({
                    jangka_waktu: $('#inputJangkaWaktu').val()
                })).load();
            });

        });


        function formatCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID');
            return formatter.format(value);
        }
    </script>


    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
