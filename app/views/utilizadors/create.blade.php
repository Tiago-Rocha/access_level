@extends('layouts.scaffold')

@section('main')

                       {{ link_to_route('utilizadors.index', 'Return to all utilizadors') }}
<h1>Create Utilizador</h1>

{{ Form::open(array('route' => 'utilizadors.store')) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
        </li>

        <li>
            {{ Form::label('admin', 'Admin:')}} {{Form::checkbox('admin')}}
        </li>

        <li>
            {{ Form::label('humanresource', 'Humanresource:')}} {{ Form::checkbox('humanresource') }}
            
        </li>

        <li>
            {{ Form::label('servicereport', 'Servicereport:') }} {{ Form::checkbox('servicereport') }}
        </li>

        <li>
            {{ Form::label('clientmanager', 'Clientmanager:') }} {{ Form::checkbox('clientmanager') }}
        </li></br>

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


