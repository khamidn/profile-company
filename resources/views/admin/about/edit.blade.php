@extends('layouts.polished')

@section('title') Edit About @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-about.update', $about->id)}}"
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
					value="{{old('title') ? old('title') : $about->title}}">

				<div class="invalid-feedback">
					{{$errors->first('title')}}
				</div>
				<br>

				<label for="image">Image</label><br>
				<small class="text-muted">Current image</small><br>
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
				 	placeholder="Berikan description di sini"
				 	rows="7">{{old('description') ? old('description') : $about->description}}</textarea>

				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
				<br>

				<label for="status">Status</label>
				<select
					name="status"
					class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
					<option {{$about->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
					<option {{$about->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
				</select>
				<div class="invalid-feedback">
					{{$errors->first('status')}}
				</div>
				<br>
				<br>

				<button 
					class="btn btn-primary"
					type="submit">
					Update
				</button>

				
			</form>
		</div>
	</div>
@endsection