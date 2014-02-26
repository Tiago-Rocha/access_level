@extends('layouts.scaffold')

@section('main')


<h1>Techinicians Manager</h1>
<p>{{ link_to_route('utilizadors.create', 'Add new User') }}</p>

@if (isset($utilizadors))
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Admin</th>
            <th>Human Resource</th>
            <th>Service Report</th>
            <th>Client Manager</th>
            <th>Contract Manager</th>
            <th>Network Manager</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($utilizadors as $utilizador)

        <tr>
            {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}

            <td>{{{ $utilizador->name }}}</td>
            <td>
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'admin') }}
                @if (!$utilizador->admin)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'humanresource') }}
                @if (!$utilizador->humanresource)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'servicereport') }}
                @if (!$utilizador->servicereport)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>


            <td>  
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'clientmanager') }}
                @if (!$utilizador->clientmanager)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>
            <td>  
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'contractmanager') }}
                @if (!$utilizador->contractmanager)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>
            <td>  
                {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                {{ Form::hidden('id', $utilizador->id) }} 
                {{ Form::hidden('op', 'networkmanager') }}
                @if (!$utilizador->networkmanager)
                {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                @else
                {{ Form::submit('', array('class' => 'btn btn-success')) }}
                @endif
                {{ Form::close() }}
            </td>
            {{ Form::close() }}
            <td>{{ link_to_route('utilizadors.edit', 'Edit', array($utilizador->id), array('class' => 'btn btn-info')) }}</td>

            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('utilizadors.destroy', $utilizador->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@else
There are no utilizadors
@endif




@stop
