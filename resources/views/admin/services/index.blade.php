@extends('layouts.polished')
@section('title') Manage Services @endsection

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
			<form action="{{route('manage-services.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword"
						value="{{Request::get('keyword')}}"
						class="form-control"
						placeholder="Filter by title service">
						<div class="input-group-append">
							<input type="submit" value="Filter" class="btn btn-primary">
						</div>
				</div>
			</form>
		</div>

		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == NULL & Request::path() == 'admin/manage-services' ? 'active' : ''}}" href="{{route('manage-services.index')}}">
						All
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}" 
						href="{{route('manage-services.index', ['status' => 'publish'])}}">
						Publish
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}" 
						href="{{route('manage-services.index', ['status' => 'draft'])}}">
						Draft
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{set_active('manage-services.trash')}}" 
						href="{{route('manage-services.trash')}}">
						Trash
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a 
				href="{{route('manage-services.create')}}"
				class="btn btn-primary">
				Create services
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><b>Image</b></th>
						<th><b>Title</b></th>
						<th><b>Status</b></th>
						<th><b>Action</b></th>

					</tr>
				</thead>
				<tbody>
					@forelse($services as $service)
						<tr>
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
							<td>{{$service->title}}</td>
							<td>
								@if($service->status == 'DRAFT')
									<span class="badge badge-dark text-white">{{$service->status}}</span>
								@else
									<span class="badge badge-success">{{$service->status}}</span>
								@endif
							</td>
							<td>
								<a 
									href="{{route('manage-services.edit', $service->id)}}"
									class="btn btn-info btn-sm">
									Edit
								</a>
								<a 
									href="{{route('manage-services.show', $service->id)}}"
									class="btn btn-primary btn-sm">
									Details
								</a>

								<button 
									type="button" 
									class="btn btn-danger" 
									data-toggle="modal" 
									data-target="#trash-{{$service->id}}">
									Trash
								</button>

								{{-- Modal Trash --}}
							<div 
								class="modal fade" 
								id="trash-{{$service->id}}" 
								tabindex="-1" 
								role="dialog" 
								aria-labelledby="exampleModalCenterTitle" 
								aria-hidden="true">

								<div 
									class="modal-dialog modal-dialog-centered" 
									role="document">

								    <div class="modal-content">

								   	<form method="POST" action="{{route('manage-services.destroy', $service->id)}}">
								   		@csrf
							   			<div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLongTitle">Peringatan!</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
								      	</div>

								      	<div class="modal-body">
										    Service dipindah ke trash?
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
							<td colspan="5" class="text-center">
								<p>Tidak ada data</p>
							</td>
							
						</tr>
					@endforelse
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{$services->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection