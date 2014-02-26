@extends('layouts.scaffold')

@section('main')

<h1>Show Utilizador</h1>

<p>{{ link_to_route('utilizadors.index', 'Return to all utilizadors') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Admin</th>
            <th>Humanresource</th>
            <th>Servicereport</th>
            <th>Clientmanager</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{{ $utilizador->name }}}</td>
            <td>{{{ $utilizador->admin }}}</td>
            <td>{{{ $utilizador->humanresource }}}</td>
            <td>{{{ $utilizador->servicereport }}}</td>
            <td>{{{ $utilizador->clientmanager }}}</td>
            <td>{{ link_to_route('utilizadors.edit', 'Edit', array($utilizador->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('utilizadors.destroy', $utilizador->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
