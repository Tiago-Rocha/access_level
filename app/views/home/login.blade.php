<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	 <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
        
        <title>Login</title>
        {{ HTML::script('js/jquery.js') }}
        {{ HTML::script('js/bootstrap.js') }}
        {{ HTML::style('css/bootstrap.css') }}
       
</head>
<body>
    <div class="row-fluid">
        <div class="span12 well">
            <h1>UNS Manager</h1>
        </div>
    </div>
    <body>


<div class="row">
    <div class="span4 offset1">
        <div class="well">
            <legend>Please Login</legend>
            {{ Form::open(array('url' => 'login')) }}
            @if($errors->any())
            <div class="alert alert-error">
                <a href="#" class="close" data-dismiss="alert">&times</a>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </div>
            @endif
            {{ Form::text('name', '',array('placeholder' => 'First Name')) }}
            {{ Form::password('password', array('placeholder' => 'Password')) }}
            {{ Form::submit('Login', array('class' => 'btn btn-success')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
       
</body>

</html>