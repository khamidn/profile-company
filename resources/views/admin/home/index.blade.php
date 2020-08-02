@extends('layouts.polished')
@section('title') Home Admin @endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body"> 
					@if(session('status'))
						<div class="alert alert-success" role="alert">
							{{session('status')}}
						</div>
					@endif

					{{ __('You are logged in!') }}
				</div>
			</div>
			
		</div>
	</div>
@endsection