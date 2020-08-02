@extends('layouts.polished')

@section('title') Create About @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-about.store')}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">
				
				@csrf
				<label for="title">Title</label>
				<input 
					type="text" 
					name="title"
					class="form-control {{$errors->first('title') ? "is-invalid" : ""}}"
					placeholder="Title service"
					value="{{old('title')}}">

				<div class="invalid-feedback">
					{{$errors->first('title')}}
				</div>
				<br>

				<label for="image">Image</label>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">

				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<br>

				<label for="description">Description</label>
				<textarea
				 	class="form-control {{$errors->first('description') ? "is-invalid" : ""}}"
				 	name="description"
				 	id="description"
				 	placeholder="Berikan description di sini"
				 	rows="7">{{old('description')}}</textarea>

				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
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