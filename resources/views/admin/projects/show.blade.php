@extends('layouts.polished')

@section('title') Details Project @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<th scope="row" width="15%"><b>Name</b></th>
						<td>{{$project->name}}</td>
					</tr>

					<tr>
						<th scope="row" width="15%"><b>Slug</b></th>
						<td>{{$project->slug}}</td>
					</tr>

					<tr>
						<th scope="row" width="15%"><b>Image</b></th>
						<td>
							@if($project->image)
			                  @if($project->image === 'gambar-project-default.jpg')
			                    <img src="{{asset('pivot/img/'. $project->image)}}" width="96px">
			                  @else
			                    <img src="{{asset('storage/'. $project->image)}}" width="96px">
			                  @endif
			                @else
			                  <img src="{{asset('pivot/img/gambar-project-default.jpg')}}" width="96px"><br>
			                  <small class="text-muted">Gambar tidak ada</small>
			                @endif
						</td>
					</tr>

					<tr>
						<th scope="row" width="15%"><b>Status</b></th>
						<td>
							@if($project->status == 'DRAFT')
								<span class="badge badge-dark text-white">{{$project->status}}</span>
							@else
								<span class="badge badge-success">{{$project->status}}</span>
							@endif
						</td>
					</tr>

					<tr>
						<th scope="row" width="15%"><b>Description</b></th>
						<td>{{$project->description}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection