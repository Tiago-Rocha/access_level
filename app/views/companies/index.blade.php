@extends('layouts.scaffold')

@section('main')

<h2>All Companies</h2>

<p>{{ link_to_route('companies.create', 'Add new company') }}</p>

@if ($companies->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>City</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($companies as $company)
				<tr>
					<td>{{{ $company->name }}}</td>
					<td>{{{ $company->city }}}</td>
                    <td>{{ link_to_route('companies.edit', 'Edit', array($company->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('companies.destroy', $company->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no companies
@endif

@stop
