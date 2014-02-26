@extends('layouts.scaffold')

@section('main')

<h1>Edit Utilizador</h1>
{{ Form::model($utilizador, array('method' => 'PATCH', 'route' => array('utilizadors.update', $utilizador->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::text('password') }}
        </li>

        <li>
            {{ Form::label('admin', 'Admin:') }}
            {{ Form::checkbox('admin' , 0) }}
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
			{{ link_to_route('utilizadors.show', 'Cancel', $utilizador->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
