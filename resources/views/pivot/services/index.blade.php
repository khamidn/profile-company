@extends('layouts.pivot')

@section('title') Services @endsection

@section('content')
    <section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('pivot/img/slider-2.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Our Services</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section bg-light">
      <div class="container">
        <div class="row">

          @forelse($services as $service)
            <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
              <div class="media d-block media-custom text-center">
                
               @if($service->image)
                  @if($service->image === 'gambar-service-default.jpg')
                    <img src="{{asset('pivot/img/'. $service->image)}}" class="img-fluid">
                  @else
                    <img src="{{asset('storage/'. $service->image)}}" class="img-fluid">
                  
                  @endif
                @else
                  <img src="{{asset('pivot/img/gambar-service-default.jpg')}}" class="img-fluid"><br>
                  <small class="text-muted">Gambar tidak ada</small>
                @endif

                <div class="media-body">
                  <h3 class="mt-0 text-black">{{$service->title}}</h3>
                  <p>{{$service->subtitle}}</p>
                  <p><a href="{{route('services.slug', $service->slug)}}" class="btn btn-outline-primary btn-sm">Learn More</a></p>
                </div>
              </div>
            </div>
          @empty
            <div class="col-md-12 element-animate text-center">
              <div class="alert alert-success">
                Data Masih Kosong
              </div>
            </div>
          @endforelse

        </div>

        <div class="row justify-content-center">
          {{$services->appends(Request::all())->links()}}
        </div>

      </div>
    </section>


    <!-- END section -->
@endsection