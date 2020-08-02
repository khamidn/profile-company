@extends('layouts.polished')
@section('title') Edit Image Slide @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form 
				action="{{route('manage-home-slider.update', $slider->id)}}" 
				method="POST" 
				enctype="multipart/form-data" 
				class="shadow-sm p-3 bg-white">
				
				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name</label><br>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
					placeholder="Name home image slider"
					value="{{old('name') ? old('name') : $slider->name}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="slug">Slug</label><br>
				<input 
					type="text" 
					name="slug"
					class="form-control"
					value="{{$slider->slug}}" 
					disabled="">
				<br>


				<label for="image">Image Home Slider</label><br>
				<small class="text-muted">Current image</small><br>
				@if($slider->image)
					<img src="{{asset('storage/'. $slider->image)}}" width="96px">
				@endif
				<br>
				<br>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? "is-invalid": ""}}">
				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small><br>
				<small class="text-muted">Untuk hasil yang maksimal, gunakan dimensi 1900 x  1318 pixel</small>
				<br>
				<br>

				<label for="status">Status</label>
				<select 
					name="status"
					class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
					<option {{$slider->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
					<option {{$slider->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
				</select>
				<div class="invalid-feedback">
					{{$errors->first('status')}}
				</div>
				<br>

				<button
					type="submit"
					class="btn btn-primary">
					Update
				</button>
			</form>
		</div>
	</div>
@endsection