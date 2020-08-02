@extends('layouts.polished')

@section('title') Edit New Testimonials @endsection

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
				action="{{route('manage-testimonials.update', $testimoni->id)}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadow-sm p-3 bg-white">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Nama</label>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Name Testimoni"
					value="{{old('name') ? old('name') : $testimoni->name}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="image">Image</label><br>
				<small class="text-muted">Current image</small><br>
				@if($testimoni->image)
					@if($testimoni->image === 'avatar-testimoni-default.jpg')
						<img src="{{asset('pivot/img/'. $testimoni->image)}}" width="96px">
					@else
						<img src="{{asset('storage/'.$testimoni->image)}}" width="96px">
					@endif
				@else
					<img src="{{asset('pivot/img/avatar-testimoni-default.jpg')}}" width="96px"><br>
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
				<small class="text-muted">Untuk hasil yang maksimal, gunakan dimensi 0 x 0 pixel</small>
				<br>
				<br>

				<label for="asalKotaKbupaten">Asal Kota/Kabupaten</label>
				<input 
					type="text" 
					name="asalKotaKbupaten"
					class="form-control {{$errors->first('asalKotaKbupaten') ? 'is-invalid' : ''}}"
					value="{{old('asalKotaKbupaten') ? old('asalKotaKbupaten') : $testimoni->asal_kota_kabupaten}}">
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
					rows="7">{{old('captions') ? old('captions') : $testimoni->captions}}</textarea>
				<div class="invalid-feedback">
					{{$errors->first('captions')}}
				</div>
				<br><br>

				<label for="status">Status</label>
				<select
					name="status"
					class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
					<option {{$testimoni->status == 'PUBLISH' ? 'selected' : ''}}>PUBLISH</option>
					<option {{$testimoni->status == 'DRAFT' ? 'selected' : ''}}>DRAFT</option>
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