@extends('layouts.polished')
@section('title') Manage Testimonials @endsection

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
			<form action="{{route('manage-testimonials.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword"
						class="form-control"
						placeholder="Filter berdarkan nama">
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
						class="nav-link {{Request::get('status') == NULL & Request::path() == 'admin/manage-testimonials' ? 'active' : ''}}"
						href="{{route('manage-testimonials.index')}}">All</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}"
						href="{{route('manage-testimonials.index', ['status' => 'publish'])}}">Publish</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}"
						href="{{route('manage-testimonials.index', ['status' => 'draft'])}}">Draft</a>
				</li>
				<li class="nav-item">
				 	<a 
				 		class="nav-link {{set_active('manage-testimonials.trash')}}"
				 		href="{{route('manage-testimonials.trash')}}">Trash</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a href="{{route('manage-testimonials.create')}}" class="btn btn-primary">Create New Testimonial</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><b>Image</b></th>
						<th><b>Name</b></th>
						<th><b>Asal Kota</b></th>
						<th><b>Status</b></th>
						<th><b>Actions</b></th>
					</tr>
				</thead>
				<body>
					@forelse($testimonials as $testimoni)
					<tr>
						<td>
							@if($testimoni->image)
								@if($testimoni->image === 'avatar-testimoni-default.jpg')
									<img src="{{asset('pivot/img/'. $testimoni->image)}}" width="96px">
								@else
									<img src="{{asset('storage/'.$testimoni->image)}}" width="96px">
								@endif
							@else
								<img src="{{asset('pivot/img/avatar-testimoni-default.jpg')}}" width="96px"><br>
								<small class="text-muted">Gambar tidak ada</small>
							@endif
						</td>
						<td>{{$testimoni->name}}</td>
						<td>{{$testimoni->asal_kota_kabupaten}}</td>
						<td>
							@if($testimoni->status == "DRAFT")
								<span class="badge badge-dark text-white">{{$testimoni->status}}</span>
							@else
								<span class="badge badge-success">{{$testimoni->status}}</span>
							@endif
						</td>
						<td>
							<a 
								href="{{route('manage-testimonials.edit', $testimoni->id)}}"
								class="btn btn-info btn-sm">
								Edit
							</a>
							<a 
								href="{{route('manage-testimonials.show', $testimoni->id)}}"
								class="btn btn-info btn-sm">
								Details
							</a>
							<button 
								type="button" 
								class="btn btn-danger" 
								data-toggle="modal" 
								data-target="#trash-{{$testimoni->id}}">
								Trash
							</button>

							{{-- Modal Trash --}}
							<div 
								class="modal fade" 
								id="trash-{{$testimoni->id}}" 
								tabindex="-1" 
								role="dialog" 
								aria-labelledby="exampleModalCenterTitle" 
								aria-hidden="true">

								<div 
									class="modal-dialog modal-dialog-centered" 
									role="document">

								    <div class="modal-content">

									   	<form method="POST" action="{{route('manage-testimonials.destroy', $testimoni->id)}}">
									   		@csrf
								   			<div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLongTitle">Peringatan!</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
									      	</div>

									      	<div class="modal-body">
											    Gambar slider dipindah ke trash?
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
							<p>Tidak ada ada</p>
						</td>
					</tr>
					@endforelse
				</body>
				<tfoot>
					<tr>
						<td>
							{{$testimonials->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
@endsection