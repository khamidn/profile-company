@extends('layouts.pivot')
@section('title') About @endsection

@section('content')
<section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('pivot/img/slider-2.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">About Us</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section">
      <div class="container">
        @forelse($abouts as $index => $about)

          @if($index % 2 == 0)
            <div class="row mb-5">
              <div class="col-md-6 order-lg-3 mb-5">
                
                @if($about->image)
                  @if($about->image === 'gambar-about-default.jpg')
                    <img src="{{asset('pivot/img/'. $about->image)}}" class="img-fluid">
                  @else
                    <img src="{{asset('storage/'. $about->image)}}" alt="Image placeholder" class="img-fluid">
                  @endif

                @else
                  <img src="{{asset('pivot/img/gambar-about-default.jpg')}}" class="img-fluid"><br>
                  <small class="text-muted">Gambar tidak ada</small>
                @endif
                
              </div>
              <div class="col-md-1 order-lg-2"></div>
              <div class="col-md-5 order-lg-1">
                <h2 class="text-uppercase heading mb-4">{{$about->title}}</h2>

                @php
                  $input = $about->description;
                  $pecah = explode("\r\n\r\n", $input);
                  $text = "";

                  for ($i=0; $i < count($pecah); $i++) { 
                    $part = str_replace($pecah[$i], "<p>". $pecah[$i]. "</p>", $pecah[$i]);
                    $text .= $part;
                  }

                  echo $text; 
                @endphp
              </div>
              
            </div>
          @else
            <div class="row mb-5">
              <div class="col-md-6 order-lg-1 mb-5">

                @if($about->image)
                  @if($about->image === 'gambar-about-default.jpg')
                    <img src="{{asset('pivot/img/'. $about->image)}}" class="img-fluid">
                  @else
                    <img src="{{asset('storage/'. $about->image)}}" alt="Image placeholder" class="img-fluid">
                  @endif

                @else
                  <img src="{{asset('pivot/img/gambar-about-default.jpg')}}" class="img-fluid"><br>
                  <small class="text-muted">Gambar tidak ada</small>
                @endif

              </div>
              <div class="col-md-1 order-lg-2"></div>
              <div class="col-md-5 order-lg-3">
                <h2 class="text-uppercase heading mb-4">{{$about->title}}</h2>
                @php
                  $input = $about->description;
                  $pecah = explode("\r\n\r\n", $input);
                  $text = "";

                  for ($i=0; $i < count($pecah); $i++) { 
                    $part = str_replace($pecah[$i], "<p>". $pecah[$i]. "</p>", $pecah[$i]);
                    $text .= $part;
                  }

                  echo $text; 
                  @endphp
              </div>
              
            </div>
          @endif
        @empty
          <div class="row mb-5">
             <div class="col-md-12 element-animate text-center">
                <div class="alert alert-success">
                  Data Masih Kosong
                </div>
              </div>
          </div>
        @endforelse
        
        
      </div>
    </section>

@endsection