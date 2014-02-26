@extends('layouts.scaffold')

@section('main')

<h2>Edit Company</h2>
{{ Form::model($company, array('method' => 'PATCH', 'route' => array('companies.update', $company->id))) }}

<table class="table" style="background-color: #f5f5f5;  width: 45%; float:left;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Name and Address</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('name', 'Name *') }}</td>
        <td>{{ Form::text('name') }}</td>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('address1', 'Place') }}</td>
        <td>{{ Form::text('address1') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('address', 'Address *') }}</td>
        <td>{{ Form::text('address') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('zip_code', 'Zip Code *') }}</td>
        <td>{{ Form::text('zip_code') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('city', 'City *') }}</td>
        <td>{{ Form::text('city') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('country', 'Country *') }}</td>
        <td>{{ Form::text('country') }}</td>
    </tr>
</tbody></table>

<table class="table" style="background-color: #f5f5f5; float: left; width: 45%; margin-left: 10px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Accountig Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left; ">
        <td style="width: 45%;">{{ Form::label('bic', 'BIC *') }}</td>
        <td>{{ Form::text('bic') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('iban', 'IBAN *') }}</td>
        <td>{{ Form::text('iban') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('vat_number', 'Vat Number *') }}</td>
        <td>{{ Form::text('vat_number') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('tva_rate', 'Tva Rate *') }}</td>
        <td>{{ Form::text('tva_rate') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('travel_expenses', 'Travel Expenses *') }}</td>
        <td>{{ Form::text('travel_expenses') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('due_days', 'Due days *') }}</td>
        <td>{{ Form::text('due_days') }}</td>
    </tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5; float: left; width: 45%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">General Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('general_phone', 'General Phone') }}</td>
        <td>{{ Form::text('general_phone') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('general_fax', 'General Fax') }}</td>
        <td>{{ Form::text('general_fax') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('comment', 'Comment/Note') }}</td>
        <td>{{ Form::text('comment') }}</td>
    </tr>  
</tbody></table>
<table class="table" style="background-color: #f5f5f5; float: left; width: 45%; margin-left: 10px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Other Fees</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('hardware_delivery_fee', 'Hardware Delivery Fee') }}</td>
        <td>{{ Form::text('hardware_delivery_fee') }}</td>
    </tr> 
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('toners_delivery_fee', 'Toners Delivery Fee') }}</td>
        <td>{{ Form::text('toners_delivery_fee') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('out_of_contract', 'Out of Contract') }}</td>
        <td>{{ Form::text('out_of_contract') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="border: none;">{{ Form::submit('Update', array('class' => 'btn btn-info')) }}</td>
        <td style="border: none;">{{ link_to_route('companies.show', 'Cancel', $company->id, array('class' => 'btn')) }}</td>
    </tr>
</tbody></table>    <input id="active" type="hidden"  name="active" value="1">

{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop
