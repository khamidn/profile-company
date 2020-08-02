<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin @yield("title")</title>
	<link rel="stylesheet" href="{{asset('polished/polished.min.css')}}">
	<link rel="stylesheet" href="{{asset('polished/iconic/css/open-iconic-bootstrap.min.css')}}">

	<style>
		.grid-higlight {
			padding-top: 1rem;
			padding-bottom: 1rem;
			background-color: #5c6ac4;
			border: 1px solid #202e78;
			color: #fff;
		}

		hr{
			margin: 6rem 0;
		}

		hr+.display-3,
		hr+.display-2+.display-3 {
			margin-bottom: 2rem;
		}
	</style>

	<script type="text/javascript">
		document.documentElement.className = document.documentElement.className.replace('no-js','js')+(document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")? 'svg': 'no-svg');
	</script>

</head>

<body>
	<nav class="navbar navbar-expand p-0">
		<div class="container">
			<a class="navbar-brand col-xs-12 col-md-3 col-lg-2 mr-0" href="{{route('home.index')}}">Profile Company</a>

			<div class="collapse navbar-collapse">
				 <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    	<div class="dropdown d-none d-md-block">

							@if(Auth::check())
							<button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown">
								{{Auth::user()->name}}
							</button>

							<div class="dropdown-menu dropdown-menu-right" id="navbar-dropdown">
								<a href="{{route('profile.index')}}" class="dropdown-item">Profile</a>
								<div class="dropdown-divider"></div>
								<li>
									<form action="{{route('logout')}}" method="POST">
										@csrf
										<button  class="dropdown-item" style="cursor: pointer">Logout</button>
									</form>
								</li>
							</div>
							@endif

								
						</div>
                    </ul>
			</div>

			<button 
				class="btn btn-link d-block d-md-none" 
				data-toggle="collapse" 
				data-target="#sidebar-nav" 
				role="button">
				<span class="oi oi-menu"></span>
          	</button>

		</div>
		

		

		
		

		

		{{-- <a href="#" class="btn btn-success">Login</a> --}}
	</nav>

	<div class="container-fluid h-100 p-0">
		<div style="min-height: 100%" class="flex-row d-flex align-items-strethc m-0">
			<div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">
				<ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
					<input class="border-dark form-control d-block d-md-none mb-4" type="text" placeholder="Search" aria-label="Search"/>		
							<li class="{{set_active('home')}}">
								<a href="{{route('home')}}"><span class="oi oi-home"></span> Home</a>
							</li>
							<li class="{{set_active([
													'manage-home-slider.index', 
													'manage-home-slider.create', 
													'manage-home-slider.trash', 
													'manage-home-slider.edit'
													])
										}}">
								<a href="{{route('manage-home-slider.index')}}">
									<span class="oi oi-image"></span> 
									Manage Home Slider
								</a>
							</li>
							<li class="{{set_active([
													'manage-services.index', 
													'manage-services.create', 
													'manage-services.show',
													'manage-services.edit',
													'manage-services.trash'
													])
										}}">
								<a href="{{route('manage-services.index')}}"><span class="oi oi-tag"></span> Manage Services</a>
							</li>
							<li class="{{set_active([
													'manage-projects.index',
													'manage-projects.create',
													'manage-projects.show',
													'manage-projects.edit',
													'manage-projects.trash'
													])

										}}">
								<a href="{{route('manage-projects.index')}}"><span class="oi oi-book"></span> Manage Projects</a>
							</li>
							<li class="{{set_active([
													'manage-about.index',
													'manage-about.create',
													'manage-about.show',
													'manage-about.edit',
													'manage-about.trash'
													])

										}}">
								<a href="{{route('manage-about.index')}}"><span class="oi oi-inbox"></span> Manage About</a>
							</li>
							<li class="{{set_active('manage-contact.index')}}">
								<a href="{{route('manage-contact.index')}}"><span class="oi oi-phone"></span> Manage Contact</a>
							</li>
							<li class="{{set_active([
													'manage-testimonials.index',
													'manage-testimonials.create',
													'manage-testimonials.show',
													'manage-testimonials.edit',
													'manage-testimonials.trash'
													])
										}}">
								<a href="{{route('manage-testimonials.index')}}"><span class="oi oi-people"></span> Manage Testimonials</a>
							</li>
							<li class="{{set_active([
													'manage-sosmeds.index',
													'manage-sosmeds.create',
													'manage-sosmeds.edit',
													'manage-sosmeds.trash'
													])
										}}">
								<a href="{{route('manage-sosmeds.index')}}"><span class="oi oi-people"></span> Manage Sosmeds</a>
							</li>
					<div class="d-block d-md-none">
						<div class="dropdown-divider"></div>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Setting</a></li>
						<li>
							<form action="#" method="POST">
								@csrf
								<button class="dropdown-item" style="cursor: pointer;">
									Sign Out
								</button>
							</form>
						</li>
					</div>
				</ul>
				<div class="pl-3 d-none d-md-block position-fixed" style="bottom:0px;">
					<span class="oi oi-cog"></span>
					Setting
				</div>
			</div>

			<div class="col-lg-10 col-md-9 p-4">
				<div class="row">
					<div class="col-md-12 pl-3 pt-2">
						<div class="pl-3">
							<h3>@yield("title")</h3>
							<br>
						</div>
					</div>
				</div>

				@yield("content")
			</div>
		</div>
		</div>
	</div>




<script 
	src="https://code.jquery.com/jquery-3.3.1.min.js" 
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
	crossorigin="anonymous">
</script>
<script 
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" 
	integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
	crossorigin="anonymous">
</script>
<script 
	src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" 
	integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" 
	crossorigin="anonymous">
</script>

@yield('footer-scripts')

</body>
</html>