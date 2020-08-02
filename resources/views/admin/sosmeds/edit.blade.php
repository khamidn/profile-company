@extends('layouts.polished')

@section('title') Edit Sosial Media @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-sosmeds.update', $sosmed->id)}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name*</label>
				<input 
					type="text"
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Nama sosial media yang digunakan" 
					value="{{old('name') ? old('name') : $sosmed->sosmed_name}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="profileUrl">Profile URL*</label>
				<input 
					type="text" 
					name="profileUrl"
					class="form-control {{$errors->first('profileUrl') ? 'is-invalid' : ''}}"
					placeholder="Masukkan URL profilmu di sini"
					value="{{old('profileUrl') ? old('profileUrl') : $sosmed->profile_url}}">
				<div class="invalid-feedback">
					{{$errors->first('profileUrl')}}
				</div>
				<br>
				<br>
				<small class="text-muted">(*) Tidak boleh kosong</small>
				<br>

				<button type="submit" class="btn btn-primary">Save</button>
				
			</form>
		</div>
	</div>
@endsection