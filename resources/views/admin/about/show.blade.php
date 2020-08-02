@extends('layouts.polished')

@section('title') Details Service @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<th scope="row" width="15%"><b>Title<b/></th>
						<td>{{strtoupper($about->title)}}</td>
					</tr>
					<tr>
						<th scope="row" width="15%"><b>Slug<b/></th>
						<td>{{$about->slug}}</td>
					</tr>
					<tr>
						<th scope="row" width="15%"><b>Image<b/></th>
						<td>
							@if($about->image)
			                  @if($about->image === 'gambar-about-default.jpg')
			                    <img src="{{asset('pivot/img/'. $about->image)}}" width="96px">
			                  @else
			                    <img src="{{asset('storage/'. $about->image)}}" width="96px">
			                  @endif
			                @else
			                  <img src="{{asset('pivot/img/gambar-about-default.jpg')}}" width="96px"><br>
			                  <small class="text-muted">Gambar tidak ada</small>
			                @endif
						</td>
					</tr>
					<tr>
								<th scope="row" width="15%"><b>Status<b/></th>
								<td>
									@if($about->status == 'DRAFT')
										<span class="badge badge-dark text-white">{{$about->status}}</span>
									@else
										<span class="badge badge-success">{{$about->status}}</span>
									@endif
								</td>
							</tr>

							<tr>
								<th scope="row" width="15%"><b>Description<b/></th>
								<td>{{$about->description}}</td>
							</tr>
				</tbody>
			</table>
		</div>
	</div>

@endsection