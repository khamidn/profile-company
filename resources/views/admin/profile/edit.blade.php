@extends('layouts.polished')

@section('title')Edit Profile @endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(session('status'))
				<div class="alert alert-success">
					{{session('status')}}
				</div>
			@endif


			<form
				action="{{route('profile.update', $user->id)}}"
				method="POST"
				enctype="multipart/form-data"
				class="shadown-sm p-3 bg-white">

				@csrf

				<input type="hidden" name="_method" value="PUT">

				<label for="name">Name</label>
				<input 
					type="text" 
					name="name"
					class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
					placeholder="Masukkan nama lengkapmu"
					value="{{old('name') ? old('name') : $user->name}}">
				<div class="invalid-feedback">
					{{$errors->first('name')}}
				</div>
				<br>

				<label for="username">Username</label>
				<input 
					type="text" 
					name="username"
					class="form-control {{$errors->first('username') ? 'is-invalid' : ''}}"
					placeholder="Masukkan usernamemu"
					value="{{old('username') ? old('username') : $user->username}}">
				<div class="invalid-feedback">
					{{$errors->first('username')}}
				</div>
				<br>

				<label for="email">Email</label>
				<input 
					type="text" 
					name="email"
					class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}"
					placeholder="namaemail@email.com"
					value="{{old('email') ? old('email') : $user->email}}">
				<div class="invalid-feedback">
					{{$errors->first('email')}}
				</div>
				<br>

				<label for="avatar">Avatar</label>
				<small class="text-muted">Current image</small><br>
				@if($user->avatar == 'belum-ada-avatar.jpg')
					<img src="{{asset('pivot/img/'. $user->avatar)}}" width="96px">
				@else
					<img src="{{asset('storage/'. $user->avatar)}}" width="96px">
				@endif
				<br><br>
				<input 
					type="file" 
					name="avatar"
					id="image"
					class="form-control {{$errors->first('avatar') ? 'is-invalid' : ''}}">
				<div class="invalid-feedback">
					{{$errors->first('avatar')}}
				</div>
				<small class="text-muted">Kosong jika tidak ingin merubah avatar</small>
				<br>
				<hr class="my-3">

				<label for="oldPassword">Old Password</label>
				<input 
					type="password" 
					name="oldPassword"
					class="form-control {{$errors->first('oldPassword') ? 'is-invalid' : ''}}">
				<div class="invalid-feedback">
					{{$errors->first('oldPassword')}}
				</div>
				<small class="text-muted">Kosongkan password jika tidak ingin merubahnya</small>
				<br><br>

				<label for="newPassword">New Password</label>
				<input 
					type="password" 
					name="newPassword"
					class="form-control {{$errors->first('newPassword') ? 'is-invalid' : ''}}">
				<div class="invalid-feedback">
					{{$errors->first('newPassword')}}
				</div>
				<br>

				<label for="confirmPassword">Confirm Password</label>
				<input 
					type="password" 
					name="confirmPassword"
					class="form-control {{$errors->first('confirmPassword') ? 'is-invalid' : ''}}">
				<div class="invalid-feedback">
					{{$errors->first('confirmPassword')}}
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