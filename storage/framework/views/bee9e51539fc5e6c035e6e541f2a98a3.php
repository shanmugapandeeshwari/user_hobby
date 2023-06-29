<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <h2>User List</h2>
        <div class="mb-3">
            <input type="text" id="name" placeholder="Search by Name">
        </div>
        <table class="table" id="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo e(route("users.search")); ?>',
                    data: function (d) {
                        d.name = $('#name').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'first_name' },
                    { data: 'email', name: 'last_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#name').on('keyup', function() {
                table.draw();
            });
        });
    </script>
</body>
</html>
<?php /**PATH G:\laravel\user_hobby\resources\views/show.blade.php ENDPATH**/ ?>