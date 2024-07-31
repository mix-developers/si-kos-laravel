@push('js')
    <script>
        $(function() {
            $('#datatable-kelurahan').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: '{{ url('kelurahan-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'kelurahan',
                        name: 'kelurahan'
                    },
                   
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $('#datatable-jalan').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: '{{ url('jalan-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'kelurahan.kelurahan',
                        name: 'kelurahan.kelurahan'
                    },
                    {
                        data: 'jalan',
                        name: 'jalan'
                    },
                   
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('.refresh').click(function() {
                $('#datatable-jalan').DataTable().ajax.reload();
                $('#datatable-kelurahan').DataTable().ajax.reload();
            });
            $('.create-kelurahan').click(function() {
                $('#createKelurahan').modal('show');
            });
            $('.create-jalan').click(function() {
                $('#createJalan').modal('show');
            });
            $('#createKelurahanBtn').click(function() {
                var formData = $('#kelurahanForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/lokasi/store_kelurahan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-kelurahan').DataTable().ajax.reload();
                        $('#createKelurahan').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });

        });

       
    </script>
@endpush
