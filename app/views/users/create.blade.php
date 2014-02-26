@extends('layouts.scaffold')

@section('main')

<h2>Create User</h2>

{{ Form::open(array('route' => 'users.store')) }}
	<ul>
        <li>
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
        </li>

        <li>
            {{ Form::label('admin', 'Admin:') }}
            {{ Form::checkbox('admin') }}
        </li>

        <li>
            {{ Form::label('humanresource', 'Humanresource:') }}
            {{ Form::checkbox('humanresource') }}
        </li>

        <li>
            {{ Form::label('servicereport', 'Servicereport:') }}
            {{ Form::checkbox('servicereport') }}
        </li>

        <li>
            {{ Form::label('clientmanager', 'Clientmanager:') }}
            {{ Form::checkbox('clientmanager') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


