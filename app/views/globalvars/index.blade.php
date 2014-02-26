@extends('layouts.scaffold')

@section('main')
<h2>UNS Info</h2>
@if ($var->count())
{{ Form::model($var, array('method' => 'PATCH', 'route' => array('globalvars.update', $var->id))) }}
<table class="table" style="background-color: #f5f5f5; float :left; width : 33%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Location Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('place', 'Place ') }}</td>
        <td>{{ Form::text('place') }}</td>
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

<table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left : 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Contact Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('mail', 'Email *') }}</td>
        <td>{{ Form::text('mail') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('phone', 'Phone *') }}</td>
        <td>{{ Form::text('phone') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('fax', 'Fax *') }}</td>
        <td>{{ Form::text('fax') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('website', 'Website *') }}</td>
        <td>{{ Form::text('website') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('account_number', 'Account Number *') }}</td>
        <td>{{ Form::text('account_number') }}</td>
    </tr>
</tbody></table>
 
    <table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left : 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Account Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('bic', 'BIC *') }}</td>
        <td>{{ Form::text('bic') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('iban', 'IBAN *') }}</td>
        <td>{{ Form::text('iban') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('vat_rate', 'VAT Rate *') }}</td>
        <td>{{ Form::text('vat_rate') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('vat_number', 'VAT Number *') }}</td>
        <td>{{ Form::text('vat_number') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('default_due_days', 'Default Due Days *') }}</td>
        <td>{{ Form::text('default_due_days') }}</td>
    </tr>
</tbody></table>   
    <table class="table" style="background-color: #f5f5f5; float :left; width : 33%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Invoice Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('short_name', 'Short Name *') }}</td>
        <td>{{ Form::text('short_name') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('name', 'Name *') }}</td>
        <td>{{ Form::text('name') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('pdf_directory', 'PDF Directory *') }}</td>
        <td>{{ Form::text('pdf_directory') }}</td>
    </tr>

</tbody></table>
<table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left : 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Conditions</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('conditions', 'Conditions *') }}</td>
        <td>{{ Form::textarea('conditions') }}</td>
    </tr>
</tbody></table>
    <table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left : 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Policy</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('policy', 'Policy  *') }}</td>
        <td>{{ Form::textarea('policy') }}</td>
    </tr>
</tbody></table>
{{ Form::submit('Update', array('class' => 'btn btn-info')) }}


{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@else
	There are no clients
@endif
@stop