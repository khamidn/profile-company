@extends('layouts.polished')
@section('title') Manage Projects @endsection

@section('content')

	@if(session('status'))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			</div>
		</div>
	@endif

	<div class="row">
		<div class="col-md-6">
			<form action="{{route('manage-projects.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword"
						class="form-control"
						placeholder="Filter berdasarkan nama project">

						<div class="input-group-append">
							<input 
								type="submit" 
								value="Filter"
								class="btn btn-primary">
						</div>
				</div>
			</form>
		</div>

		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == NULL &  Request::path() == 'admin/manage-projects' ? 'active': ''}}"
						href="{{route('manage-projects.index')}}">
						All		
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}"
						href="{{route('manage-projects.index', ['status' => 'publish'])}}">
						Publish		
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}"
						href="{{route('manage-projects.index', ['status' => 'draft'])}}">
						Draft		
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{set_active('manage-projects.trash')}}"
						href="{{route('manage-projects.trash')}}">
						Trash		
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a href="{{route('manage-projects.create')}}" class="btn btn-primary">Create Poject</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><b>Image</b></th>
						<th><b>Name</b></th>
						<th><b>Status</b></th>
						<th><b>Actions</b></th>
					</tr>
				</thead>
				<tbody>

					@forelse($projects as $project)
					<tr>
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
						<td>{{$project->name}}</td>
						<td>
							@if($project->status == 'DRAFT')
								<span class="badge badge-dark text-white">{{$project->status}}</span>
							@else
								<span class="badge badge-success">{{$project->status}}</span>
							@endif
						</td>
						<td>
							<a 
								href="{{route('manage-projects.edit', $project->id)}}"
								class="btn btn-info btn-sm">
								Edit
							</a>
							<a 
								href="{{route('manage-projects.show', $project->id)}}"
								class="btn btn-primary btn-sm">
								Details	
							</a>
							<button 
								type="button" 
								class="btn btn-danger" 
								data-toggle="modal" 
								data-target="#trash-{{$project->id}}">
								Trash
							</button>

							{{--Modal Trash--}}
							<div
								class="modal fade"
								id="trash-{{$project->id}}"
								tabindex="-1"
								role="dialog"
								aria-labelledby="exampleModalCenterTitle"
								aria-hidden="true">

								<div
									class="modal-dialog modal-dialog-centered"
									role="document">

									<div class="modal-content">
										<form method="POST" action="{{route('manage-projects.destroy', $project->id)}}">
											
											@csrf

											<div class="modal-header">
												<h5>Peringatan!</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">  
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												Project dipindah ke trash?
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
												<input type="hidden" name="_method" value="DELETE">
												<input type="submit" value="Ya" class="btn btn-danger btn-sm">
											</div>
										</form>
									</div>
									
								</div>
								
							</div>
						</td>

					</tr>
					@empty
					<tr>
						<td colspan="4" class="text-center">
							<p>Tidak ada data</p>
						</td>
					</tr>
					@endforelse
					
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{$projects->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection