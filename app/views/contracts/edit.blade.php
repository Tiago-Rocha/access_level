@extends('layouts.scaffold')

@section('main')

<h2>Edit Contract</h2>
{{ Form::model($contract, array('method' => 'PATCH', 'route' => array('contracts.update', $contract->id))) }}
	<ul>
        <li>
            {{ Form::label('date', 'Date:') }}
            {{ Form::text('date') }}
        </li>

        <li>
            {{ Form::label('client_id', 'Client_id:') }}
            {{ Form::input('number', 'client_id') }}
        </li>

        <li>
            {{ Form::label('hourstotal', 'Total Hours :') }}
            {{ Form::text('hourstotal') }}
        </li>

        <li>
            {{ Form::label('hoursleft', ' Hours Left:') }}
            {{ Form::text('hoursleft') }}
        </li>

        <li>
            {{ Form::label('hourprice', 'Price per Hour:') }}
            {{ Form::input('number', 'hourprice') }}
        </li>

        <li>
            {{ Form::label('travelprice', 'Travel Price :') }}
            {{ Form::input('number', 'travelprice') }}
        </li>
        
            <input  id="type" type="hidden" name="type" value="{{{$contract->type}}}">
	<li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('contracts.show', 'Cancel', $contract->id, array('class' => 'btn')) }}
	</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
