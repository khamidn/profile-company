@extends('layouts.polished')
@section('title') Edit Service @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-services.update', $service->id)}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">
				
				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="title">Title</label>
				<input 
					type="text" 
					name="title"
					class="form-control {{$errors->first('title') ? "is-invalid" : ""}}"
					placeholder="Title service"
					value="{{old('title') ? old('title') : $service->title}}">

				<div class="invalid-feedback">
					{{$errors->first('title')}}
				</div>
				<br>

				<label for="slug">Slug</label>
				<input 
					type="text" 
					name="slug" 
					class="form-control" 
					disabled=""
					value="{{$service->slug}}">
				<br>

				<label for="subtitle">Subtitle</label>
				<input 
					type="text" 
					name="subtitle"
					class="form-control {{$errors->first('subtitle') ? "is-invalid" : ""}}"
					placeholder="Subtitle service"
					value="{{old('subtitle') ? old('subtitle') : $service->subtitle}}">
				
				<div class="invalid-feedback">
					{{$errors->first('subtitle')}}
				</div>
				<br>

				<label for="image">Image</label><br>
				<small class="text-muted">Current image</small><br>
				
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
				
				<br><br>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">

				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small><br>
				<small class="text-muted">Untuk hasil yang maksimal, gunakan dimensi 1900 x  1318 pixel</small>
				<br>
				<br>

				<label for="description">Description</label>
				<textarea
				 	class="form-control {{$errors->first('description') ? "is-invalid" : ""}}"
				 	name="description"
				 	id="description"
				 	placeholder="Berikan description service perusahaanmu"
				 	rows="7">{{old('description') ? old('description') : $service->description}}</textarea>

				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
				<br>
				<br>

				<label for="status">Status</label>
				<select
					name="status"
					class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
					<option {{$service->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
					<option {{$service->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
				</select>
				<div class="invalid-feedback">
					{{$errors->first('status')}}
				</div>
				<br>

				<button 
					type="submit"
					class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
@endsection