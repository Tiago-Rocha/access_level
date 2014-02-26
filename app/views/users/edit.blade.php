@extends('layouts.scaffold')

@section('main')

<h2>Edit User</h2>
{{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}
	<ul>
        <li>
            {{ Form::label('username', 'Username:') }}
            {{ Form::text('username') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::text('password') }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('users.show', 'Cancel', $user->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
