@extends('layouts.pivot')

@section('title') Testimonials @endsection

@section('content')
	<section class="slider-item py-5" style="background-image: url('pivot/img/slider-1.jpg')">
		<div class="container">
			<div class="row slider-text align-items-center justify-content-center text-center">
				<div class="col-md-7 col-sm-12 element-animate">
					<h1 class="text-white">Our Testimonials</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="section bg-light">
		<div class="container">
			<div class="row">
				@forelse($testimonials as $testimonial)
					<div class="col-md-6 element-animate">
						<div class="media d-block media-testimonial text-center">
							
							@if($testimonial->image)
								@if($testimonial->image === 'avatar-testimoni-default.jpg')
									<img src="{{asset('pivot/img/'. $testimonial->image)}}" class="img-fluid">
								@else
									<img src="{{asset('storage/'. $testimonial->image)}}" class="img-fluid">
								@endif
							@else
								<img src="{{asset('pivot/img/avatar-testimoni-default.jpg')}}" class="img-fluid"><br>
								<small class="text-muted">Gambar tidak ada</small>
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

			<div class="row justify-content-center">
				{{$testimonials->appends(Request::all())->links()}}
			</div>
		</div>
	</section>
	
@endsection