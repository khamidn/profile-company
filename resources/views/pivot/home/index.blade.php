
@extends('layouts.pivot')
@section('title') Home @endsection

@section('content')

  {{-- HOME SLIDER --}}
  <section class="home-slider owl-carousel">

    @forelse($sliders as $slider)

    <div class="slider-item" style="background-image: url({{URL::asset('storage/'. $slider->image)}});">
      
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center text-center">
          <div class="col-md-7 col-sm-12 element-animate">
            <h1 class="mb-4"> {{$slider->name}}</h1>
            {{-- <p class="mb-0"><a href="#" target="_blank" class="btn btn-primary">Get Started</a></p> --}}
            
          </div>
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

    
  </section>

  {{-- DISPLAY PROJECTS --}}
  <section class="section border-t">
    <div class="container">
      <div class="row justify-content-center mb-3 element-animate">
        <div class="col-md-8 text-center">
          <h2 class="text-uppercase heading border-bottom mb-4">Recent Projects</h2>
        </div>
      </div>

      <div class="row no-gutters mb-5">
        @forelse($projects as $project)
          <div class="col-md-4 element-animate">
            <a href="works-single.html" class="link-thumbnail">
              <h3>{{$project->name}}</h3>
              <span class="ion-plus icon"></span>
              
              @if($project->image === 'gambar-project-default.jpg')
                <img src="{{asset('pivot/img/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
              @else
                <img src="{{asset('storage/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
              @endif
              
            </a>
          </div>
        @empty
            <div class="col-md-12 element-animate text-center">
              <div class="alert alert-success">
                Data Masih Kosong
              </div>
            </div>
        @endforelse
      </div>

      <div class="row justify-content-center element-animate"> 
        <div class="col-md-4"><p><a href="{{route('projects.index')}}" class="btn btn-primary btn-block">See All Projects</a></p></div>
      </div>
    </div>
  </section>

  {{-- DISPLAY SERVICES --}}
  <section class="section">
      <div class="container">

        <div class="row justify-content-center mb-3 element-animate">
          <div class="col-md-8 text-center">
            <h2 class="text-uppercase heading border-bottom mb-4">Services</h2>
          </div>
        </div>

        <div class="row mb-5">

          @forelse($services as $service)
            <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
              <div class="media d-block media-custom text-center">
                {{-- <span class="flaticon-blueprint icon"></span> --}}
                @if($service->image === 'gambar-service-default.jpg')
                  <img src="{{asset('pivot/img/'. $service->image)}}" class="img-fluid mb-3">
                @else
                  <img src="{{asset('storage/'. $service->image)}}" class="img-fluid mb-3">
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
        <!-- END row -->
        <div class="row justify-content-center element-animate"> 
          <div class="col-md-4"><p><a href="{{route('services.index')}}" class="btn btn-primary btn-block">View All Services</a></p></div>
        </div>
      </div>
    </section>

    {{-- DISPLAY TESTIMONIAL --}}
    <section class="section">
      <div class="container">
        <div class="row justify-content-center mb-3 element-animate">
          <div class="col-md-8 text-center">
            <h2 class="text-uppercase heading border-bottom mb-4">Testimonial</h2>
          </div>
        </div>

        <div class="row mb-5">
          @forelse($testimonials as $testimonial)
          <div class="col-md-6 element-animate">
            <div class="media d-block media-testimonial text-center">
              {{-- <img src="{{asset('storage/'. $testimonial->image)}}" alt="Image placeholder" class="img-fluid mb-3"> --}}
              @if($testimonial->image)
                @if($testimonial->image === 'avatar-testimoni-default.jpg')
                  <img src="{{asset('pivot/img/'. $testimonial->image)}}" class="img-fluid">
                @else
                  <img src="{{asset('storage/'.$testimonial->image)}}" class="img-fluid">
                @endif
              @else
                <img src="{{asset('pivot/img/avatar-testimoni-default.jpg')}}" class="img-fluid"><br>
              @endif
              <p>{{$testimonial->name}}, <a href="#">{{$testimonial->asal_kota_kabupaten}}</a></p>
              <div class="media-body">
                <blockquote>
                  <p>&ldquo;{{$testimonial->captions}}&rdquo;</p>  
                </blockquote>

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

        <div class="row justify-content-center element-animate"> 
          <div class="col-md-4"><p><a href="{{route('testimonials.index')}}" class="btn btn-primary btn-block">View All Testimonial</a></p></div>
        </div>

        
      </div>
    </section>



@endsection
