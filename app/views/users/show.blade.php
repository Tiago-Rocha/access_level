@extends('layouts.scaffold')

@section('main')

<h2>Show User</h2>

<p>{{ link_to_route('users.index', 'Return to all users') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Username</th>
				<th>Password</th>
				<th>Admin</th>
				<th>Humanresource</th>
				<th>Servicereport</th>
				<th>Clientmanager</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $user->username }}}</td>
					<td>{{{ $user->password }}}</td>
					<td>{{{ $user->admin }}}</td>
					<td>{{{ $user->humanresource }}}</td>
					<td>{{{ $user->servicereport }}}</td>
					<td>{{{ $user->clientmanager }}}</td>
                    <td>{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
