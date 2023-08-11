<script>
    $(document).ready( function () {
        $('#diaries-table').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<a href="{{ route("diaries.create") }}" class="btn btn-sm btn-primary ml-3">New Diary</a>');
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'index'
                },
                {
                    data: 'title',
                    name: 'title',
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            "order": [[ 3, 'asc']]
        });
    } );

    
    </script>