@extends('layouts.scaffold')

@section('main')

<h1>All Utilizadors</h1>

<p> {{ HTML::link('/', 'Home') }}</p>
<p>{{ link_to_route('utilizadors.create', 'Add new utilizador') }}</p>

@if (isset($utilizadors))
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Username</th>
				<th>Admin</th>
				<th>Humanresource</th>
				<th>Servicereport</th>
				<th>Clientmanager</th>
                                <th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($utilizadors as $utilizador)
				<tr>
                                    {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                                            
					<td>{{{ $utilizador->username }}}</td>
					<td>
                                            {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                                            {{ Form::hidden('id', $utilizador->id) }} 
                                            {{ Form::hidden('op', 'admin') }}
                                            {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}
                                            {{{ $utilizador->admin }}}
                                        </td>
					<td>
                                            {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                                            {{ Form::hidden('id', $utilizador->id) }} 
                                            {{ Form::hidden('op', 'humanresource') }}
                                            {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}
                                            {{{ $utilizador->humanresource }}}
                                        </td>
					<td>
                                            {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                                            {{ Form::hidden('id', $utilizador->id) }} 
                                            {{ Form::hidden('op', 'servicereport') }}
                                            {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}
                                            {{{ $utilizador->servicereport }}}
                                        </td>
                                        <td>
                                            {{ Form::open(array('action' => array('UtilizadorsController@changeState'))) }}
                                            {{ Form::hidden('id', $utilizador->id) }} 
                                            {{ Form::hidden('op', 'clientmanager') }}
                                            {{ Form::submit('', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}
                                            {{{ $utilizador->clientmanager }}}
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