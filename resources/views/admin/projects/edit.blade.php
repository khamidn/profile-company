@extends('layouts.polished')

@section('title') Create Project @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-projects.update', $project->id)}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name</label>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Name your project"
					value="{{old('name') ? old('name') : $project->name}}">

				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="image">Image</label><br>
				<small class="text-muted">Current image</small><br>

				@if($project->image)
                  @if($project->image === 'gambar-project-default.jpg')
                    <img src="{{asset('pivot/img/'. $project->image)}}" width="96px">
                  @else
                    <img src="{{asset('storage/'. $project->image)}}" width="96px">
                  @endif
                @else
                  <img src="{{asset('pivot/img/gambar-project-default.jpg')}}" width="96px"><br>
                  <small class="text-muted">Gambar tidak ada</small>
                @endif
                
				<br><br>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? 'is-invalid' : ''}}">

				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small><br>
				<small class="text-muted">Untuk hasil maksimal, gunakan dimensi 0 x 0 pixel</small>
				<br><br>

				<label for="description">Description</label>
				<textarea 
					class="form-control {{$errors->first('description') ? 'is-invalid' : ''}}" 
					rows="7"
					name="description"
					id="description"
					placeholder="Berikan description projectmu">{{old('description') ? old('description') : $project->description}}</textarea>

				<div class="invalid-feedback">
					{{$errors->first('description')}}
				</div>
				<br>

				<label for="status">Status</label>
				<select
					name="status"
					class="form-control {{$errors->first('status') ? 'is-invalid' : ''}}">
					<option {{$project->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
					<option {{$project->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
				</select>
				<br>
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