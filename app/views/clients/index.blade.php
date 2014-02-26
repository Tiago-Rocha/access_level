@extends('layouts.scaffold')

@section('main')
      <!-- Datepicker Styles - Scripts  --> 
        {{ HTML::script('assets/js/jquery.js') }}
      <!-- Smart Search Styles - Scripts  --> 
        {{ HTML::style('assets/css/selectize.bootstrap3.css') }}
        {{ HTML::script('assets/js/selectize.min.js') }} 
        
<h2>Clients</h2>
<p>{{ link_to_route('clients.create', 'Add new client') }}</p>
<select style="float:right; width: 400px" id="searchbox" name="q" placeholder="Search clients or companies..." class="form-control"></select>
@if ($clients->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Actions</th>
			</tr>
		</thead>
                
		<tbody>
			@foreach ($clients as $client)
				<tr>
                                    <td>{{{ $client->id }}}</td>
                                    <td>{{{ Company::find($client->company_id)->name }}}</td>
                                    <td>{{{ $client->name }}}</td>
                                    <td>{{{ $client->surname }}}</td>
                                    <td>{{{ $client->email }}}</td>
                                    <td>{{{ $client->phone }}}</td>
                                    <td>{{{ $client->mobile }}}</td> 
                                    <td>{{ link_to_route('clients.edit', 'Edit', array($client->id), array('class' => 'btn btn-info')) }}</td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('clients.destroy', $client->id))) }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                        {{ Form::close() }}
                                    </td>
				</tr>
			@endforeach
                  </tbody>
	</table>

@else
	There are no clients
@endif

<h1>Companies</h1>
<p>{{ link_to_route('companies.create', 'Add new company') }}</p>
@if ($companies->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Name</th>
				<th>City</th>
				<th>Tva Rate</th>
				<th>General Phone</th>
				<th>Vat Number</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($companies as $company)
				<tr>
                                        <td>{{{ $company->id }}}</td>
					<td>{{{ $company->name }}}</td>
					<td>{{{ $company->city }}}</td>
					<td>{{{ $company->tva_rate }}}</td>
					<td>{{{ $company->general_phone }}}</td>
					<td>{{{ $company->vat_number }}}</td>
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

<script>
   $(document).ready(function(){
    $('#searchbox').selectize({
        valueField: 'url',
        labelField: 'name',
        searchField: ['name'],
        maxOptions: 20,
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div><img src="'+ item.icon +'">' +escape(item.name)+'</div>';
            }
        },
        optgroups: [
            {value: 'client', label: 'Clients'},
            {value: 'technician', label: 'Technicians'},
            {value: 'company', label: 'Companies'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['client','company','technician'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: root+'/api/clients',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            window.location = this.items[0];
        }
    });
});
</script>
@stop
