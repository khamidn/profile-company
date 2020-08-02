@extends('layouts.polished')

@section('title') Details Testimonial @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<th scope="row" width="15%"><b>Name<b/></th>
						<td>{{$testimonial->name}}</td>
					</tr>
					<tr>
						<th scope="row" width="15%"><b>Image<b/></th>
						<td>
							@if($testimonial->image)
								@if($testimonial->image === 'avatar-testimoni-default.jpg')
									<img src="{{asset('pivot/img/'. $testimonial->image)}}" width="96px">
								@else
									<img src="{{asset('storage/'.$testimonial->image)}}" width="96px">
								@endif
							@else
								<img src="{{asset('pivot/img/avatar-testimoni-default.jpg')}}" width="96px"><br>
								<small class="text-muted">Gambar tidak ada</small>
							@endif
						</td>
					</tr>
					<tr>
						<th scope="row" width="15%"><b>Status<b/></th>
						<td>
							@if($testimonial->status == 'DRAFT')
								<span class="badge badge-dark text-white">{{$testimonial->status}}</span>
							@else
								<span class="badge badge-success">{{$testimonial->status}}</span>
							@endif
						</td>
					</tr>
					<tr>
						<th scope="row" width="15%"><b>Caption<b/></th>
						<td>{{$testimonial->captions}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection