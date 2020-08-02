@extends('layouts.polished')

@section('title') Create Sosial Media @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif

			<form
				action="{{route('manage-sosmeds.store')}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<label for="name">Name*</label>
				<input 
					type="text"
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Nama sosial media yang digunakan" 
					value="{{old('name')}}">
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
					value="{{old('profileUrl')}}">
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