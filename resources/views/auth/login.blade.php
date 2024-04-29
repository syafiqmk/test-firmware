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

    {{-- Content --}}
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-5">

                <h4>Login</h4>

                <div class="my-2">
                    @include('component.alerts')
                </div>

                <form action="{{ route('auth.login') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email@mail.com" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                            <a href="{{ route('home') }}" class="btn btn-success"><i class="fa-solid fa-xmark"></i> Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{-- End of Content --}}

    {{-- Bootstrap CDN JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
