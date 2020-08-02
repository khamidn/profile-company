<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=K2D:400,700|Niramit:300,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('pivot/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('pivot/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('pivot/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('pivot/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('pivot/css/jquery.timepicker.css')}}">

    <link rel="stylesheet" href="{{asset('pivot/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('pivot/fonts/fontawesome/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('pivot/fonts/flaticon/font/flaticon.css')}}">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{asset('pivot/css/style.css')}}">



  </head>
  <body>
    
    <header role="banner">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand position-absolute" href="index.html">Profile Company</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse position-relative" id="navbarsExample05">
            <ul class="navbar-nav mx-auto pl-lg-5 pl-0 d-flex align-items-center">
              <li class="nav-item">
                <a class="nav-link {{set_active('home.index')}}" href="{{route('home.index')}}">Home</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link {{set_active(['services.index', 'services.slug'])}}" href="{{route('services.index')}}">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{set_active(['projects.index', 'projects.slug'])}}" href="{{route('projects.index')}}">Projects</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link {{set_active('about.index')}}" href="{{route('about.index')}}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{set_active('contact.index')}}" href="{{route('contact.index')}}">Contact</a>
              </li>
              @if(Auth::check())
              <li class="nav-item cta-btn2">
                <a class="nav-link" href="{{route('home')}}">
                  <span class="d-inline-block px-4 py-2 border">Go to Admin</span>
                </a>
              </li>
              @endif
              
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->

    @yield('content')

    <section class="container cta-overlap">
      <div class="text d-flex">
        <h2 class="h3">Contact Us For Projects or Need a Quotations</h2>
        <div class="ml-auto btn-wrap">
          <a href="get-quote.html" class="btn-cta btn btn-outline-white">Get A Quote</a>
        </div>
      </div>
    </section>
    <!-- END section -->

    <footer class="site-footer bg-dark" role="contentinfo">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          <div class="col-md-3">
            <ul class="list-unstyled footer-link">
              <li><span class="mr-3 d-block">Address:</span><span class="text-white">{{$footerContact->alamat}}, {{$footerContact->kota_kabupaten}}, {{$footerContact->provinsi}}</span></li>
              @if($footerContact->phone)
                <li><span class="mr-3 d-block">Phone:</span><span class="text-white">(+62) {{$footerContact->phone}}</span></li>
              @endif
              @if($footerContact->fax)
                <li><span class="mr-3 d-block">Fax:</span><span class="text-white">(+62) {{$footerContact->fax}}</span></li>
              @endif
              @if($footerContact->email1)
                <li><span class="mr-3 d-block">E-mail:</span><span class="text-white">{{$footerContact->email1}}</span></li>
              @endif
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="text-white">Quick Links</h3>
            <ul class="list-unstyled footer-link">
              <li><a href="{{route('about.index')}}">About</a></li>
              <li><a href="{{route('services.index')}}">Services</a></li>
              <li><a href="{{route('projects.index')}}">Projects</a></li>
              <li><a href="{{route('contact.index')}}">Contact</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="text-white">Social</h3>
            
              <ul class="list-unstyled footer-link d-flex footer-social">
                @forelse($footerSosmeds as $footerSosmed)
                <li>
                  <a 
                    href="{{$footerSosmed->profile_url}}" 
                    class="p-2">
                    <span class="fa fa-{{strtolower($footerSosmed->sosmed_name)}}"></span>
                  </a>
                </li>
                @empty
                  <div class="btn btn-outline-primary">
                    Sosial Media Belum Diisi
                  </div>
                @endforelse
              </ul>
            
          </div>
        </div>
      </div>
    </footer>
    <!-- END footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="{{asset('pivot/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('pivot/js/popper.min.js')}}"></script>
    <script src="{{asset('pivot/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('pivot/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('pivot/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('pivot/js/main.js')}}"></script>
  </body>
</html>