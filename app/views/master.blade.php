<!doctype html>
 @if(!Auth::user())
       {{ HTML::link('login', 'Please Authenticate Yourself') }}       
      @else
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	 <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
        
        <title>TITULO</title>
        {{ HTML::script('js/jquery.js') }}
        {{ HTML::script('js/bootstrap.js') }}
        {{ HTML::style('css/bootstrap.css') }}
       
</head>
<body>
    <div class="row-fluid">
        <div class="span well">
            <h1 align="center">UNS Manager</h1>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span3">
            <ul class='nav nav-list'>
                @if(Auth::user())
                <li class="nav-header"> Welcome : {{ ucwords(Auth::user()->username) }}</li>
                @include('layouts.sidebar')
                <li> {{ HTML::link('logout', 'Logout') }}</li>
                @else
                <li> {{ HTML::link('login', 'Login') }}</li>
                @endif
            </ul>
        </div>
           <div class="span9">
	@yield('content')
     </div>
    </div>
</body>
</html>
@endif