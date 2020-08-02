@extends('layouts.pivot')
@section('title') Projects @endsection

@section('content')
<section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('pivot/img/slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">List Projects</h1>
            </div>
          </div>
        </div>

      </div>


    </section>
    <!-- END slider -->
    
    <section class="section">
      <div class="container">
        <div class="row no-gutters mb-5">
          
          @forelse($projects as $project)
            <div class="col-md-4 element-animate">
              <a href="{{route('projects.slug', $project->slug)}}" class="link-thumbnail">
                <h3>{{$project->name}}</h3>
                <span class="ion-plus icon"></span>
                
                @if($project->image)
                  @if($project->image === 'gambar-project-default.jpg')
                    <img src="{{asset('pivot/img/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
                  @else
                    <img src="{{asset('storage/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
                  @endif
                @else
                  <img src="{{asset('pivot/img/gambar-project-default.jpg')}}" class="img-fluid"><br>
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
        <div class="row justify-content-center">
          {{$projects->appends(Request::all())->links()}}
        </div>
      </div>
    </section>

@endsection