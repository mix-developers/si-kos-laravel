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
            $('#createJalanBtn').click(function() {
                var formData = $('#jalanForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/lokasi/store_jalan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-jalan').DataTable().ajax.reload();
                        $('#createJalan').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteJalan = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus jalan ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/lokasi/delete_jalan/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-jalan').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            window.deleteKelurahan = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus kelurahan ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/lokasi/delete_kelurahan/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-kelurahan').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            window.editJalan = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/lokasi/edit_jalan/' + id,
                    success: function(response) {
                        $('#formJalanId').val(response.id);
                        $('#formUpdateIdKelurahan').val(response.id_kelurahan);
                        $('#formUpdateJalan').val(response.jalan);
                        $('#updateJalanModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#updateJalanBtn').click(function() {
                var formData = $('#jalanFormUpdate').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/lokasi/store_jalan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-jalan').DataTable().ajax.reload();
                        $('#updateJalanModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.editKelurahan = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/lokasi/edit_kelurahan/' + id,
                    success: function(response) {
                        $('#formKelurahanId').val(response.id);
                        $('#formUpdateKelurahan').val(response.kelurahan);
                        $('#updateKelurahanModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#updateKelurahanBtn').click(function() {
                var formData = $('#kelurahanFormUpdate').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/lokasi/store_kelurahan',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-kelurahan').DataTable().ajax.reload();
                        $('#updateKelurahanModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });

        });
    </script>
@endpush
