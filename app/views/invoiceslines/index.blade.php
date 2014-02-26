@extends('layouts.scaffold')

@section('main')
<!-- Datepicker Styles - Scripts  --> 
{{ HTML::script('assets/js/jquery.js') }}
<h2>Invoice Info</h2>



@if ($contentlines->count())
<p>{{{'You have ' . $contentlines->count() . ' lines to check!'}}}</p>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total HTVA</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($contentlines as $contentline)
        <tr>
            <td>{{{ $contentline->id }}}</td>
            <td>{{{ $contentline->code }}}</td>
            <td>{{{ $contentline->description }}}</td>
            <td>{{{ round($contentline->quantity, 2) }}}</td>
            <td>{{{ $contentline->price_unit }}}</td>
            <td>{{{ round(($contentline->quantity * $contentline->price_unit), 2) }}}</td>
            <td>{{ link_to_route('invoicelines.edit', 'Edit', array($contentline->id), array('class' => 'btn btn-info')) }}</td>
            <td> 
                {{ Form::open(array('method' => 'DELETE', 'route' => array('invoices.destroy', $contentline->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
       @endforeach

    </tbody>
</table>
@else
This Invoice is empty
@endif

@stop