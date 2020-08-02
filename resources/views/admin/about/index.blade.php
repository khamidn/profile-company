@extends('layouts.polished')
@section('title') Manage About @endsection

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
			<form action="{{route('manage-about.index')}}">
				<div>
					<div class="input-group">
						<input 
							type="text" 
							name="keyword"
							class="form-control"
							placeholder="Filter berdasarkan title">
							<div>
								<input type="submit" value="Filter" class="btn btn-primary">
							</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
			<ul class="nav nav-pills card-header-pills">
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == NULL & Request::path() == 'admin/manage-about' ? 'active' : ''}}"
						href="{{route('manage-about.index')}}">
						All
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}"
						href="{{route('manage-about.index', ['status' => 'publish'])}}">
						Publish	
					</a>
				</li>
				<li class="nav-item"> 
					<a 
						class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}"
						href="{{route('manage-about.index', ['status' => 'draft'])}}">
						Draft	
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{set_active('manage-about.trash')}}"
						href="{{route('manage-about.trash')}}">
						Trash	
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a href="{{route('manage-about.create')}}" class="btn btn-primary">Create About</a>
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
						<th><b>Actions</b></th>
					</tr>
				</thead>
				<tbody>
					@forelse($abouts as $about)
					<tr>
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
						<td>{{$about->title}}</td>
						<td>
							@if($about->status == 'DRAFT')
								<span class="badge badge-dark text-white">{{$status->status}}</span>
							@else
								<span class="badge badge-success">{{$about->status}}</span>
							@endif
						</td>
						<td>
							<a 
								href="{{route('manage-about.edit', $about->id)}}"
								class="btn btn-info btn-sm">
								Edit
							</a>
							<a 
								href="{{route('manage-about.show', $about->id)}}"
								class="btn btn-primary btn-sm">
								Show
							</a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#trash-{{$about->id}}">
								Trash
							</button>


							{{-- Modal Trash --}}
							<div
								class="modal fade"
								id="trash-{{$about->id}}"
								tabindex="-1"
								role="dialig"
								aria-labelledby="exampleModalCenterTitle"
								aria-hidden="true">

								<div 
									class="modal-dialog modal-dialog-centered"
									role="document">

									<div class="modal-content">
										
										<form method="POST" action="{{route('manage-about.destroy', $about->id)}}">

											@csrf

											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Peringatan!</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												About dipindahkan ke trash?
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
							{{$abouts->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection