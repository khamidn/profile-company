@extends('layouts.pivot')

@section('title') Project @endsection

@section('content')
	<section class="inner-page">
		
		<div class="container">
			<div class="row slider-text align-items-center justify-content-center text-center mb-5"> 
				<div class="col-md-7 col-sm-12 element-animate">
					<h1>{{$project->name}}</h1>
				</div>
			</div>

			<div class="row mb-5">
				<div class="col-md-6 order-lg-3 mb-3">
					
					@if($project->image)
	                  @if($project->image === 'gambar-project-default.jpg')
	                    <img src="{{asset('pivot/img/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
	                  @else
	                    <img src="{{asset('storage/'. $project->image)}}" alt="Image placeholder" class="img-fluid">
	                  @endif
	                @else
	                  <img src="{{asset('pivot/img/gambar-project-default.jpg')}}" class="img-fluid"><br>
	                  <small class="text-muted">Gambar tidak ada</small>
	                @endif

				</div>

				<div class="col-md-6 order-lg-1">
					@php
						$input = $project->description;
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
		</div>
	</section>
@endsection