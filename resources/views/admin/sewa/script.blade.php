@push('js')
    <script>
        $(function() {
            $('#datatable-sewa').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('sewa-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('.refresh').click(function() {
                $('#datatable-sewa').DataTable().ajax.reload();
            });

        });  

        function acceptAction(id) {
            $.ajax({
                type: 'GET',
                url: '/sewa/accept/' + id,
                success: function(response) {
                    $('#datatable-sewa').DataTable().ajax.reload();
                    alert(response);
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function rejectAction(id) {
            $.ajax({
                type: 'GET',
                url: '/sewa/reject/' + id,
                success: function(response) {
                    $('#datatable-sewa').DataTable().ajax.reload();
                    alert('Berhasil menolak');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function detailAction(id) {
            $.ajax({
                type: 'GET',
                url: '/sewa/detail/' + id,
                success: function(response) {
                    $('#namaPenyewa').text(response.nama_penyewa);
                    $('#tanggalPengajuan').text(response.tanggal_sewa);
                    $('#jangkaWaktu').text(response.jangka_waktu + ' Bulan');
                    $('#jumlahOrang').text(response.jumlah_orang + ' Orang');
                    $('#pembayaran').text(formatCurrency(response.kos.harga_kos * response.jangka_waktu));
                    $('#detailModal').modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function formatCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID');
            return formatter.format(value);
        }
    </script>
@endpush
