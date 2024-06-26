<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firmware</title>

    {{-- Bootstrap CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/c8ae339e7b.js" crossorigin="anonymous"></script>
</head>
<body>

    {{-- Navbar --}}
    <div class="fixed-top py-2 px-3 bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="fs-5 text-white">Firmware</span>
                </div>

                <div class="col-md-6 text-end">
                    @if (auth()->check())
                        <a href="{{ route('firmware.index') }}" class="text-white text-decoration-none fs-6">Dashboard</a>
                    @else
                        <a href="{{ route('auth.login') }}" class="text-white text-decoration-none fs-6">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End of Navbar --}}

    {{-- Search --}}
    <div class="container pt-5">
        <form action="" method="get">
            @csrf
            
            <div class="input-group mb-3 mt-3">

                <input type="text" name="search" id="search" class="form-control" placeholder="Search">

                <select name="brand" id="brand" class="form-select">
                    <option value="0">Select Brand</option>
                </select>

                <select name="category" id="category" class="form-select">
                    <option value="0">Select Category</option>
                </select>

                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    {{-- End of Search --}}

    {{-- Content --}}
    <div class="container">
        <table class="table table-stripped">
            <thead>
                <th>#</th>
                <th>Series</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">No entries!</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- End of Content --}}

    {{-- Bootstrap CDN JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
