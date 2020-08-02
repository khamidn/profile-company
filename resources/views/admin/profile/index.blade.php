@extends('layouts.polished')

@section('title')Profile @endsection

@section('content')

<div class="row">
	<div class="col-md-4">
		<table class="table table-borderless">
			<body>
				<tr>
					<th scope="row" width="15%"></th>
					<td>
						@if($user->avatar == 'belum-ada-avatar.jpg')
							<img src="{{asset('pivot/img/'. $user->avatar)}}" width="128px">
						@else
							<img src="{{asset('storage/'. $user->avatar)}}" width="128px">
						@endif
					</td>
				</tr>
				<tr>
					<th scope="row" width="15%"><b>Username</b></th>
					<td>{{$user->username}}</td>
				</tr>
				<tr>
					<th scope="row" width="15%"><b>Email</b></th>
					<td>{{$user->email}}</td>
				</tr>
			</body>
			<tfoot>
				<tr>
					<td colspan="2">
						<a 
						href="{{route('profile.edit', $user->id)}}"
						class="btn btn-block btn-primary">
						Edit
					</a>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

@endsection