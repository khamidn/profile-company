@extends('layouts.polished')

@section('title') Create New Testimonials @endsection

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
		<div class="col-md-8">
			<form
				action="{{route('manage-testimonials.store')}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<label for="name">Nama</label>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Name Testimoni"
					value="{{old('name')}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="image">Image</label>
				<input 
					type="file" 
					name="image"
					id="image"
					class="form-control {{$errors->first('image') ? 'is-invalid' : ''}}">
				<div class="invalid-feedback">
					{{$errors->first('image')}}
				</div>
				<br>

				<label for="asalKotaKbupaten">Asal Kota/Kabupate</label>
				<input 
					type="text" 
					name="asalKotaKbupaten"
					class="form-control {{$errors->first('asalKotaKbupaten') ? 'is-invalid' : ''}}"
					value="{{old('asalKotaKbupaten')}}">
				<div class="invalid-feedback">
					{{$errors->first('asalKotaKbupaten')}}
				</div>
				<br>

				<label for="captions">Caption</label>
				<textarea 
					class="form-control {{$errors->first('captions') ? 'is-invalid' : ''}}"
					name="captions"
					id="captions"
					placeholder="Isi hasil testimoni customer anda di sini"
					rows="7">{{old('captions')}}</textarea>
				<div class="invalid-feedback">
					{{$errors->first('captions')}}
				</div>
				<br><br>

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