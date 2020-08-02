@extends('layouts.polished')
@section('title') Create Home Slider @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form 
				action="{{route('manage-home-slider.store')}}" 
				method="POST" 
				enctype="multipart/form-data" 
				class="shadow-sm p-3 bg-white">
				
				@csrf

				<label for="name">Name</label><br>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
					placeholder="Name home image slider"
					value="{{old('name')}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="image">Image Home Slider</label>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? "is-invalid": ""}}">
				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<small class="text-muted">Untuk hasil yang maksimal, gunakan dimensi 1900 x  1318 pixel</small>
				<br>
				<br>

				<button
					class="btn btn-primary"
					name="save_action"
					value="PUBLISH">
					Publish
				</button>

				<button
					class="btn btn-secondary"
					name="save_action"
					value="DRAFT">
					Save as draft
				</button>
			</form>
		</div>
	</div>

@endsection