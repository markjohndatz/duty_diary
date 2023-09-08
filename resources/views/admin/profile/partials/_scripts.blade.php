<script>
    $('#profilePic').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        },
        error: {
            'fileSize': 'File Size Exceeds Limit',
            'minWidth': 'Image Width is Too Small',
            'maxWidth': 'Image Width is Too Large',
            'minHeight': 'Image Height is Too Small',
            'maxHeight': 'Image Height is Too Large',
            'imageFormat': 'Invalid Image Format'
        },
    });
    $('#signature').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        },
        error: {
            'fileSize': 'File Size Exceeds Limit',
            'minWidth': 'Image Width is Too Small',
            'maxWidth': 'Image Width is Too Large',
            'minHeight': 'Image Height is Too Small',
            'maxHeight': 'Image Height is Too Large',
            'imageFormat': 'Invalid Image Format'
        },
    });
    $('#editProfilePic').click(function(){
        $('#edit-profile-pic').modal('show');
    })
    $('#editSignature').click(function(){
        $('#edit-signature').modal('show');
    })
    $('#save-profile-pic').click(function(event) {
            event.preventDefault(); 

            var form = $('#profile-pic-form');

            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.successMessage,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Request failed with status: ' + status);
                }
            });
    });
    $('#save-signature').click(function(event) {
            event.preventDefault(); 

            var form = $('#signature-form');

            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.successMessage,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Request failed with status: ' + status);
                }
            });
    });

    $('#editName').click(function(){
        $('#editName').addClass('d-none');
        $('#name-input').removeClass('d-none');
        $('#name-input').focus();
        $('#name-input').select();
    })

    $('#name-input').blur(function(){
        var form = $('#update-profile-name-form');

        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success',
                    text: response.successMessage,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            },
            error: function(xhr, status, error) {
                console.error('Request failed with status: ' + status);
            }
        });
    })

    $('#name-input').on('keypress',function(event){
        if(event.keyCode === 13){
            var form = $('#update-profile-name-form');

            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.successMessage,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Request failed with status: ' + status);
                }
            });
        }
    })

    $('#editPass').click(function(){
        $('#editPass').addClass('d-none');
        $('#password-input').removeClass('d-none');
        $('#password-input').focus();
        $('#password-input').select();
    })

    $('#password-input').blur(function(){
        var form = $('#update-password-form');

        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success',
                    text: response.successMessage,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            },
            error: function(xhr, status, error) {
                console.error('Request failed with status: ' + status);
            }
        });
    })

    $('#password-input').on('keypress',function(event){
        if(event.keyCode === 13){
            event.preventDefault();
            let id = $(this).attr('data-id');
            
            var form = $(this).closest('#update-password-form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Success',
                        text: response.successMessage,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {    
                            var redirectUrl = '{{ route("users.show", ["user" => ":id"]) }}';
                            redirectUrl = redirectUrl.replace(':id', id);
                            
                            window.location.href = redirectUrl;
                        }
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Request failed with status: ' + status);
                }
            });
        }
    })
</script>