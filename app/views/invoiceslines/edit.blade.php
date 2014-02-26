@extends('layouts.scaffold')

@section('main')

<h2>Edit Invoice Line</h2>
{{ Form::model($line, array('method' => 'PATCH', 'route' => array('invoicelines.update', $line->id))) }}
<ul>
    @if ($line->code == 'internal'  || $line->code == 'external')

    <li>
        {{ Form::label('code', 'Internal Service') }}
        {{ Form::select('code', array('default' => $line->code,'External' => 'No','Internal' => 'Yes'), 'Default') }}
    </li>
    @endif
    <li>
        {{ Form::label('Description', 'Description:') }}
        {{ Form::textarea('description') }}
    </li>
    <li>
        {{ Form::label('Quantity', 'Quantity:') }}
        {{ Form::text('quantity') }}
    </li>
    <li>
        {{ Form::label('price_unit', 'Price Unit:') }}
        {{ Form::text('price_unit') }}
    </li>
    
<input id="utilizador_id" type="hidden"  name="invoice_id" value="{{{$line->invoice_id}}}">

    <li>
        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
        {{ link_to_action('InvoiceLinesController@index', 'Cancel', array('id' => $line->invoice_id), array('class' => 'btn btn')) }}

    </li>
</ul>
{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop