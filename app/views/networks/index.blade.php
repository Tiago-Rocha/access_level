@extends('layouts.scaffold')

@section('main')

<h2>All Service Reports</h2>
<p>{{ link_to_route('servicereports.create', 'Add new servicereport') }}</p>

@if ($servicereports->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Company</th>
				<th>Technician</th>
				<th>Internal</th>
				<th>Start</th>
				<th>End</th>
				<th>Duration</th>
				<th>Subject</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($servicereports as $servicereport)
				<tr>
					<td>{{{ Company::find($servicereport->company_id)->name }}}</td>
					<td>{{{ Utilizador::find($servicereport->utilizador_id)->username }}}</td>
					<td>{{{ $servicereport->internal }}}</td>
					<td>{{{ $servicereport->start }}}</td>
					<td>{{{ $servicereport->end }}}</td>
					<td>{{{ $servicereport->duration }}}</td>
					<td>{{{ $servicereport->subject }}}</td>
                    <td>{{ link_to_route('servicereports.edit', 'Edit', array($servicereport->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('servicereports.destroy', $servicereport->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no servicereports
@endif

@stop
