@extends('layouts.scaffold')

@section('main')
<h2>Edit Client</h2>
{{ Form::model($client, array('method' => 'PATCH', 'route' => array('clients.update', $client->id))) }}
<table class="table" style="background-color: #f5f5f5; float :left; width : 33%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Client Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('name', 'Name *') }}</td>
        <td>{{ Form::text('name') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('surname', 'Surname *') }}</td>
        <td>{{ Form::text('surname') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('city', 'City *') }}</td>
        <td>{{ Form::text('city') }}</td>
    </tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5; float:left; width: 33%; margin-left: 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Company Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('company_id', 'Company *') }}</td>
        <td>{{ Form::select('company_id', $company_options , Input::old('clients')) }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('function', 'Function') }}</td>
        <td>{{ Form::text('function') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('lang', 'Language') }}</td>
        <td>{{ Form::text('lang') }}</td>
    </tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left: 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Contact</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('phone', 'Phone *') }}</td>
        <td>{{ Form::text('phone') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('mobile', 'Mobile:') }}</td>
        <td>{{ Form::text('mobile') }}</td>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('email', 'Email *') }}</td>
        <td>{{ Form::text('email') }}</td>
    </tr>
    </tr>
</tbody></table>

   
        {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
        {{ link_to_route('clients.show', 'Cancel', $client->id, array('class' => 'btn')) }}


{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop
