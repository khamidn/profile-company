@extends('layouts.polished')
@section('title') Details Service @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			{{-- <div class="card">
				<div class="card-body"> --}}
					<table class="table table-borderless">
						<tbody>
							<tr>
								<th scope="row" width="15%"><b>Title<b/></th>
								<td>{{strtoupper($service->title)}}</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Slug<b/></th>
								<td>{{$service->slug}}</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Subtitle<b/></th>
								<td>{{$service->subtitle}}</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Image<b/></th>
								<td>
									@if($service->image)
										@if($service->image === 'gambar-service-default.jpg')
											<img src="{{asset('pivot/img/'. $service->image)}}" width="96px">
										@else
											<img src="{{asset('storage/'. $service->image)}}" width="96px">
										
										@endif
									@else
										<img src="{{asset('pivot/img/gambar-service-default.jpg')}}" width="96px"><br>
										<small class="text-muted">Gambar tidak ada</small>
									@endif
									
								</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Status<b/></th>
								<td>
									@if($service->status == 'DRAFT')
										<span class="badge badge-dark text-white">{{$service->status}}</span>
									@else
										<span class="badge badge-success">{{$service->status}}</span>
									@endif
								</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Description<b/></th>
								<td>{{$service->description}}</td>
							</tr>
						</tbody>
					</table>


				{{-- </div>
			</div> --}}
		</div>
	</div>
@endsection