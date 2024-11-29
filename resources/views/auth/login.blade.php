<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistema de Controle de Denuncias</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('assets/images/logotipoico2.png')}}" />
  <style>
    .btn-github {
    background-color: #333;
    color: white;
    font-size: 16px;
    padding: 10px;
    text-align: center;
}

.btn-github:hover {
    background-color: #444;
}

  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                {{-- <center><h2>Sistema de Manuntenção e Helpdesk Da Unisave</h2></center> --}}
              <div class="brand-logo">
              <center>  <img width="" src="{{asset('assets/images/12.png')}}" alt="logo"></center>
              </div>

              {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
              <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                    @if(session('error'))
                    <div class="text-danger ">{{session('error')}}</div>
                    @endif

                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                 <label for="password">Password</label>
                    @error('email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                    @if(session('error'))
                    <div class="text-danger ">{{session('error')}}</div>
                    @endif

                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <div class="mt-3">
                  <a href="{{ url('login/github') }}" class="btn btn-block btn-github">
                      <i class="fab fa-github"></i> Login with GitHub
                  </a>
              </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>

                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/js/template.js')}}"></script>
  <script src="{{asset('assets/js/settings.js')}}"></script>
  <script src="{{asset('assets/js/todolist.js')}}"></script>
  
  <!-- endinject -->
</body>

</html>
