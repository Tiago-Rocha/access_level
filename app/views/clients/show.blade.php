@extends('layouts.scaffold')

@section('main')

<h2>Show Client</h2>

<p>{{ link_to_route('clients.index', 'Return to all clients') }}</p>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>City</th>
            <th>Company</th>
            <th>Function</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Mobile</th>
            <th>Lang</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{{ $client->name }}}</td>
            <td>{{{ $client->surname }}}</td>
            <td>{{{ $client->city }}}</td>
            <td>{{{ Company::withTrashed()->find($client->company_id)->name }}}</td>
            <td>{{{ $client->function }}}</td>
            <td>{{{ $client->email }}}</td>
            <td>{{{ $client->phone }}}</td>
            <td>{{{ $client->mobile }}}</td>
            <td>{{{ $client->lang }}}</td>
            <td>{{ link_to_route('clients.edit', 'Edit', array($client->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('clients.destroy', $client->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
