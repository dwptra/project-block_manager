<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Block Generation</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login.auth') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                            required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Block Manager 2023
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/dist/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/dist/js/custom.js') }}"></script>
</body>

</html>
