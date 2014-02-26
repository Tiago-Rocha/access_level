<!doctype html>

@if(!Auth::user())
{{ HTML::link('login', 'Please Authenticate Yourself') }}       
@else


<html>
    <head>
        <script type="text/javascript">
            var root = '{{url("/")}}';
        </script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
        
        <style>
            table form { margin-bottom: 0; }
            form ul { margin-left: 0; list-style: none; }
            .error { color: red; font-style: italic; }
            body { padding-top: 20px; }
        </style>
    </head>

    <body>
        <div class="row-fluid">
            <div class="span well"><h1 align="center">UNS Manager</h1></div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <ul class='nav nav-list'>
                    @if(Auth::user())
                    <li class="nav-header"> Welcome : {{ ucwords(Session::get('name')) }}</li>
                    @include('layouts.sidebar')
                    @else
                    <li> {{ HTML::link('login', 'Login') }}</li>
                    @endif
                </ul>
            </div>
            <div class="container">

                @if (Session::has('message'))
                <div class="flash alert">
                    <p>{{ Session::get('message') }}</p>
                </div>
                @endif
              
                @yield('main')
               </div>
        </div>
                <div class="row-fluid">
            <div class="span well"><h4 align="center">Some footer info?</h4></div>
        </div>


    </body>


</html>
@endif