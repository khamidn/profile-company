@extends('layouts.polished')
@section('title') Manage Contact @endsection

@section('content')
	@if(session('status'))
		<div class="row">
			<div class="col-md-8">
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			</div>
		</div>
	@endif

	<div class="row">
		<div class="col-md-8">
			<form 
				class="shadow-sm p-3 bg-white"
				method="POST"
				action="{{route('manage-contact.update', $contact->id)}}"
				enctype="multipart/form-data">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="alamat">Alamat*</label>
						<input 
							type="text" 
							name="alamat" 
							class="form-control {{$errors->first('alamat') ? 'is-invalid' : ''}}"
							placeholder="Jl. Raya Soekarno Hatta No.20, Kec. Lowokwaru"
							value="{{ old('alamat') ? old('alamat') : $contact->alamat}}">
						<div class="invalid-feedback">
							{{$errors->first('alamat')}}
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="kotaKabupaten">Kota/Kabupaten*</label>
						<input 
							type="text" 
							name="kotaKabupaten" 
							class="form-control  {{$errors->first('kotaKabupaten') ? 'is-invalid' : ''}}"
							placeholder="Kota Malang"
							value="{{old('kotaKabupaten') ? old('kotaKabupaten') : $contact->kota_kabupaten}}">
						<div class="invalid-feedback">
							{{$errors->first('kotaKabupaten')}}
						</div>
					</div>
					<div class="form-group col">
						<label>Provinsi*</label>
						<input 
							type="text" 
							name="provinsi" 
							class="form-control {{$errors->first('provinsi') ? 'is-invalid' : ''}}"
							placeholder="Jawa Timur"
							value="{{old('provinsi') ? old('provinsi') : $contact->provinsi}}">
						<div class="invalid-feedback">
							{{$errors->first('provinsi')}}
						</div>
					</div>
					<div class="form-group col">
						<label>Kode pos*</label>
						<input 
							type="text" 
							name="kodePos" 
							class="form-control {{$errors->first('kodePos') ? 'is-invalid' : ''}}"
							placeholder="12345"
							value="{{old('kodePos') ? old('kodePos') : $contact->kode_pos}}">
					</div>
					<div class="invalid-feedback">
						{{$errors->first('kodePos')}}
					</div>
				</div>

				<hr class="my-3">

				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Email 1*</label>
						<input 
							type="email" 
							name="email1" 
							class="form-control {{$errors->first('email1') ? 'is-invalid' : ''}}"
							placeholder="alamat1@email.com"
							value="{{old('email1') ? old('email1') : $contact->email1}}">
						<div>
							{{$errors->first('email1')}}
						</div>
					</div>
					<div class="form-group col-md-6">
						<label>Email 2</label>
						<input 
							type="email" 
							name="email2" 
							class="form-control {{$errors->first('email2') ? 'is-invalid' : ''}}"
							placeholder="alamat2@email.com"
							value="{{old('email2') ? old('email2') : $contact->email2}}">
						<div class="invalid-feedback">
							{{$errors->first('email2')}}
						</div> 
					</div>
				</div>

				<hr class="my-3">

				<div class="form-row">
					<div class="form-group col-md-4">
						<label>Phone (+62)</label>
						<input 
							type="text" 
							name="phone" 
							class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}"
							placeholder="(0341) 4353533"
							value="{{old('phone') ? old('phone') : $contact->phone}}">
						<div class="invalid-feedback">
							{{$errors->first('phone')}}
						</div>
						<small class="text-muted">Masukkan beserta kode area</small>
					</div>
					<div class="form-group col-md-4">
						<label>Mobile (+62) </label>
						<input 
							type="text" 
							name="mobile" 
							class="form-control {{$errors->first('mobile') ? 'is-invalid' : ''}}"
							placeholder="12345678901"
							value="{{old('mobile') ? old('mobile') : $contact->mobile}}">
						<div class="invalid-feedback">
							{{$errors->first('mobile')}}
						</div>
					</div>
					<div class="form-group col-md-4">
						<label>Fax (+62) </label>
						<input 
							type="text" 
							name="fax" 
							class="form-control {{$errors->first('fax') ? 'is-invalid' : ''}}"
							placeholder="1212345123"
							value="{{old('fax') ? old('fax') : $contact->fax}}">
					</div>
				</div>
				<br>

				<small class="text-muted">(*) Tidak boleh kosong</small>
				<br><br>


				<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
@endsection