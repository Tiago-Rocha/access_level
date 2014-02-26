@extends('layouts.scaffold')

@section('main')

<h2>Edit Line</h2>
{{ Form::model($servicereport, array('method' => 'PATCH', 'route' => array('servicereports.update', $servicereport->id))) }}
	<ul>
        <li>
            {{ Form::label('date', 'Date:') }}
            {{ Form::text('date') }}
        </li>

        <li>
            {{ Form::label('contract_id', 'Contract_id:') }}
            {{ Form::input('number', 'contract_id') }}
        </li>

        <li>
            {{ Form::label('utilizador_id', 'Utilizador_id:') }}
            {{ Form::input('number', 'utilizador_id') }}
        </li>

        <li>
            {{ Form::label('internal', 'Internal:') }}
            {{ Form::checkbox('internal') }}
        </li>

        <li>
            {{ Form::label('start', 'Start:') }}
            {{ Form::text('start') }}
        </li>

        <li>
            {{ Form::label('end', 'End:') }}
            {{ Form::text('end') }}
        </li>

        <li>
            {{ Form::label('duration', 'Duration:') }}
            {{ Form::text('duration') }}
        </li>

        <li>
            {{ Form::label('subject', 'Subject:') }}
            {{ Form::text('subject') }}
        </li>

        <li>
            {{ Form::label('comment', 'Comment:') }}
            {{ Form::textarea('comment') }}
        </li>

   

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('servicereports.show', 'Cancel', $servicereport->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

