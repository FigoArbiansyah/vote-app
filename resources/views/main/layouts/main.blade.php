<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilihaken!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    @include('main.components.navbar')
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tambahkan input untuk choice baru
            $('#add_choice').click(function() {
                var choice = $(
                    '<div class="input-group mb-3"><input type="text" class="form-control choice" name="choices[]" required><div class="input-group-append"><button class="btn btn-outline-danger remove-choice" type="button">&times;</button></div></div>'
                );
                $('#choices_wrapper').append(choice);
            });

            // Hapus input choice
            $('#choices_wrapper').on('click', '.remove-choice', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
</body>

</html>
