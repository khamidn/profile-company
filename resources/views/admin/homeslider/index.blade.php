@extends('layouts.polished')
@section('title') Manage Home Slider @endsection

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
			<form action="{{route('manage-home-slider.index')}}">
				<div class="input-group">
					<input 
						type="text" 
						name="keyword"
						class="form-control"
						placeholder="Filter berdasarkan nama">
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
						class="nav-link {{Request::get('status') == NULL & Request::path() == 'admin/manage-home-slider' ? 'active' : ''}}" 
						href="{{route('manage-home-slider.index')}}">
						All		
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}"
						href="{{route('manage-home-slider.index', ['status' => 'publish'])}}">
						Publish
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}"
						href="{{route('manage-home-slider.index', ['status' => 'draft'])}}">
						Draft
					</a>
				</li>
				<li class="nav-item">
					<a 
						class="nav-link {{Request::path() == 'admin/manage-home-slider/trash' ? 'active' : ''}}" 
						href="{{route('manage-home-slider.trash')}}">
						Trash
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-12 text-right">
			<a href="{{route('manage-home-slider.create')}}" class="btn btn-primary">Create Home Slider</a>
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
					@forelse($sliders as $slider)
					<tr>
						<td>
							@if($slider->image)
								<img src="{{asset('storage/'. $slider->image)}}" width="96px">
							@endif
						</td>
						<td>{{$slider->name}}</td>
						<td>
							@if($slider->status == "DRAFT")
								<span class="badge badge-dark text-white">{{$slider->status}}</span>
							@else
								<span class="badge badge-success">{{$slider->status}}</span>
							@endif
						</td>
						<td>
							<a 
								href="{{route('manage-home-slider.edit', $slider->id)}}"
								class="btn btn-info btn-sm">
								Edit
							</a>
							{{-- <a 
								href="{{route('manage-home-slider.show', $slider->id)}}"
								class="btn btn-primary btn-sm">
								Show
							</a> --}}
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#trash-{{$slider->id}}">
								Trash
							</button>

							{{-- Modal Trash --}}
							<div 
								class="modal fade" 
								id="trash-{{$slider->id}}" 
								tabindex="-1" 
								role="dialog" 
								aria-labelledby="exampleModalCenterTitle" 
								aria-hidden="true">

								<div 
									class="modal-dialog modal-dialog-centered" 
									role="document">

								    <div class="modal-content">

									   	<form method="POST" action="{{route('manage-home-slider.destroy', $slider->id)}}">
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
						<td colspan="4" class="text-center">
							<p>Tidak ada data</p>
						</td>
					</tr>
					@endforelse
				</tbody>
				<tfoot>
					<tr>
						<td>
							{{$sliders->appends(Request::all())->links()}}
						</td>
					</tr>
				</tfoot>
			</table>
					
			</div>
		</div>

@endsection