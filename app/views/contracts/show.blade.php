@extends('layouts.scaffold')

@section('main')

<h2>Show Contract</h2>

<p>{{ link_to_route('contracts.index', 'Return to all contracts') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Date</th>
				<th>Client_id</th>
				<th>Hourstotal</th>
				<th>Hoursleft</th>
				<th>Hourprice</th>
				<th>Pricetravel</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $contract->date }}}</td>
					<td>{{{ $contract->client_id }}}</td>
					<td>{{{ $contract->hourstotal }}}</td>
					<td>{{{ $contract->hoursleft }}}</td>
					<td>{{{ $contract->hourprice }}}</td>
					<td>{{{ $contract->travelprice }}}</td>
                    <td>{{ link_to_route('contracts.edit', 'Edit', array($contract->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('contracts.destroy', $contract->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
