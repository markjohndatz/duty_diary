<script>
    $(document).ready( function () {
        $('#users-table').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<a href="{{ route("users.create") }}" class="btn btn-sm btn-primary ml-3">New User</a>');
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
                    data: 'name',
                    name: 'name',
                    orderable: false
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
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