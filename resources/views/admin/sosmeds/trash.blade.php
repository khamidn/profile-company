@extends('layouts.polished')

@section('title') Manage Sosial Media @endsection

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
			<form action="{{route('manage-sosmeds.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword"
						class="form-control"
						placeholder="Filter berdasarkan nama">
					<div class="input-group-append">
						<input type="submit" name="Filter" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a 
						class="nav-link {{set_active('manage-sosmeds.index')}}" 
						href="{{route('manage-sosmeds.index')}}">
						All		
					</a>
				</li>
				<li class="nav-item">
				 	<a 
				 		class="nav-link {{set_active('manage-sosmeds.trash')}}"
				 		href="{{route('manage-sosmeds.trash')}}">Trash</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a href="{{route('manage-sosmeds.create')}}" class="btn btn-primary">Create New</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="20%"><b>Name Sosial Media</b></th>
						<th><b>Profile URL</b></th>
						<th width="20%"><b>Actions</b></th>
					</tr>
				</thead>
				<tbody>
					@forelse($sosmeds as $sosmed)
					<tr>
						<td>{{$sosmed->sosmed_name}}</td>
						<td>{{$sosmed->profile_url}}</td>
						<td>
							<form 
								action="{{route('manage-sosmeds.restore', $sosmed->id)}}"
								method="POST"
								class="d-inline">

								@csrf

								<input type="submit" value="Restore" class="btn btn-success">
								
							</form>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#trash-{{$sosmed->id}}">Trash</button>

							<div 
								class="modal fade" 
								id="trash-{{$sosmed->id}}" 
								tabindex="-1" 
								role="dialog" 
								aria-labelledby="exampleModalCenterTitle" 
								aria-hidden="true">

								<div 
									class="modal-dialog modal-dialog-centered" 
									role="document">

								    <div class="modal-content">

									   	<form method="POST" action="{{route('manage-sosmeds.delete-permanent', $sosmed->id)}}">
									   		@csrf
								   			<div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLongTitle">Peringatan!</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
									      	</div>

									      	<div class="modal-body">
											    Sosial Media dihapus permanen?
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
							<td colspan="3" class="text-center">
								<p>Tidak ada data</p>
							</td>
						</tr>
					@endforelse
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{$sosmeds->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
@endsection