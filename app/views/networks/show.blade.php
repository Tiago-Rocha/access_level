@extends('layouts.scaffold')

@section('main')

<h2>Show Servicereport</h2>

<p>{{ link_to_route('servicereports.index', 'Return to all servicereports') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Date</th>
				<th>Contract_id</th>
				<th>Utilizador_id</th>
				<th>Internal</th>
				<th>Start</th>
				<th>End</th>
				<th>Duration</th>
				<th>Subject</th>
				<th>Comment</th>
				<th>Status</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $servicereport->date }}}</td>
					<td>{{{ $servicereport->contract_id }}}</td>
					<td>{{{ $servicereport->utilizador_id }}}</td>
					<td>{{{ $servicereport->internal }}}</td>
					<td>{{{ $servicereport->start }}}</td>
					<td>{{{ $servicereport->end }}}</td>
					<td>{{{ $servicereport->duration }}}</td>
					<td>{{{ $servicereport->subject }}}</td>
					<td>{{{ $servicereport->comment }}}</td>
					<td>{{{ $servicereport->status }}}</td>
                    <td>{{ link_to_route('servicereports.edit', 'Edit', array($servicereport->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('servicereports.destroy', $servicereport->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
