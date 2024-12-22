<x-layouts.header title="Register" />

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">REGISTER</h1>
              </div>

              @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
              @endif

              <form class="user" action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input
                    type="email"
                    name="email"
                    class="form-control form-control-user"
                    id="email"
                    aria-describedby="emailHelp"
                    placeholder="Enter Email Address..."
                    required />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    name="password"
                    class="form-control form-control-user"
                    id="password"
                    placeholder="Password"
                    required />
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register
                </button>
                <div class="text-center">
                  <a class="small" href="{{ url('/login') }}">Sudah punya akun?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-layouts.footer />