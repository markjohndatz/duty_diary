    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

        <!-- Fontawesome scripts-->

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>

        <!-- Sweetalert scripts-->

    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        function clickDelete(id) {
            let userId = id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload(); 
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to delete user.',
                                icon: 'error'
                            });
                        }
                    }).catch(error => {
                        console.error('Error deleting user:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while deleting the user.',
                            icon: 'error'
                        });
                    });
                }
            });
        }
        

           

    </script>
        

</body>
</html>