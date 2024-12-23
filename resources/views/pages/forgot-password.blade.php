<x-layouts.header title="Forgot Password" />

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">FORGOT PASSWORD</h1>
                            </div>
                            <!-- show error message -->
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('forgot-password.auth') }}" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="email" placeholder="Masukkan Alamat Email..." required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Kirim Link Reset Password </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<x-layouts.footer />