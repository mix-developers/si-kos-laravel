@push('js')
    <script>
        $(function() {
            $('#datatable-rating').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: '{{ url('rating-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'pengguna',
                        name: 'pengguna'
                    },
                   
                    {
                        data: 'rating',
                        name: 'rating'
                    },
                    {
                        data: 'ulasan',
                        name: 'ulasan'
                    },
                ]
            });
            

            $('.refresh').click(function() {
                $('#datatable-rating').DataTable().ajax.reload();
            });
           
        });

       
    </script>
@endpush
