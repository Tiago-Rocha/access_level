@extends('layouts.scaffold')

@section('main')

<h2>All Contracts</h2>

<p>{{ link_to_route('contracts.create', 'Add new contract') }}</p>

@if ($contracts->count())
	<table class="table table-bordered">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Date</th>
				<th>Client</th>
                                <th>Company</th>
				<th>Total hours</th>
				<th>Hours Left</th>
				<th>Price Hour</th>
                                <th>Type</th>
				<th>External Fee</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($contracts as $contract)
				<tr style="font-weight: bolder;background-color:{{{$colors[$contract->id]}}};">
                                        <td>{{{$contract->id }}}</td>
					<td>{{{ $contract->date }}}</td>
					<td>{{{ $client = Client::find($contract->client_id)->name }}}</td>
                                        <td>{{{ Company::find(Client::find($contract->client_id)->company_id)->name }}}</td>
					<td>{{{ $contract->hourstotal }}}</td>
					<td>{{{ round($contract->hoursleft,2) }}}</td>
					<td>{{{ $contract->hourprice }}}</td>
                                        <td>{{{ $contract->type}}}</td>
					<td>{{{ $contract->travelprice }}}</td>
                                        <td style="background-color:white;">{{ link_to_route('contracts.edit', 'Edit', array($contract->id), array('class' => 'btn btn-info')) }}</td>
                    <td style="background-color:white;">
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('contracts.destroy', $contract->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no contracts
@endif

@stop
