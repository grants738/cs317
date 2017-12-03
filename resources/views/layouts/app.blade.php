<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart</title>
	<link rel="stylesheet" href="/css/app.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,600" rel="stylesheet" type="text/css">
	<style>
		body {
			padding-bottom: 60px;
			font-family: "Raleway", sans-serif;
		}

		.flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }
	</style>
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default">
		  	<div class="container-fluid">
		    	<div class="navbar-header">
		    		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        				<span class="sr-only">Toggle navigation</span>
       					<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
		      		<a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
		    	</div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav navbar-right">
			      		@if(auth()->check())
						<li><a href="{{route('admin.orders')}}">Orders</a></li>
						<li><a href="{{route('admin.products')}}">Products</a></li>
						<li>
							<a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
						</li>
			      		@else
			        	<li><a href="{{route('cart.index')}}"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Cart ({{$basket->itemCount()}})</a></li>
			        	@endif
			      	</ul>
			    </div>
		 	</div>
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					@if(Session::has('success'))
						<div class="alert alert-success text-center" role="alert">
							<strong>Success!</strong> {{Session::get('success')}}
						</div>
					@endif

					@if(Session::has('message'))
						<div class="alert alert-info text-center" role="alert">
							{{Session::get('message')}}
						</div>
					@endif

					@if(Session::has('error'))
						<div class="alert alert-danger text-center" role="alert">
							<strong>Uh oh!</strong> {{Session::get('error')}}
						</div>
					@endif
				</div>
			</div>
		</div>

		@yield('content')
	</div>
	<script src="/js/app.js"></script>
	@stack('scripts')
</body>
</html>