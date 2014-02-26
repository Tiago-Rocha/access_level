@extends('layouts.scaffold')

@section('main')

<h2>Show Company</h2>

<p>{{ link_to_route('companies.index', 'Return to all companies') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Place</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>City</th>
            <th>Country</th>
            <th>General Phone</th>
            <th>General Fax</th>
        </tr>
    </thead>     
    <tbody>
        <tr>
            <td>{{{ $company->name }}}</td>
            <td>{{{$company->address1 }}}</td>
            <td>{{{$company->address }}}</td>
            <td>{{{$company->zip_code }}}</td>
            <td>{{{$company->city }}}</td>
            <td>{{{$company->country }}}</td>
            <td>{{{$company->general_phone }}}</td>
            <td>{{{$company->general_fax }}}</td>
        </tr>
    </tbody>
</table>
<table class="table table-striped table-bordered">
    <thead><tr>
            <th>TVA Rate</th>
            <th>VAT Number</th>
            <th>IBAN</th>
            <th>BIC</th>
            <th>Hardware Delivery Fee</th>
            <th>Toners Delivery Fee</th>
            <th>Out of Contract</th>
            <th>Travel Expenses</th>
            <th>Due Days</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{{$company->tva_rate }}}</td>
            <td>{{{$company->vat_number }}}</td>
            <td>{{{$company->iban }}}</td>
            <td>{{{$company->bic }}}</td>
            <td>{{{$company->hardware_delivery_fee }}}</td>
            <td>{{{$company->toners_delivery_fee }}}</td>
            <td>{{{$company->out_of_contract }}}</td>
            <td>{{{$company->travel_expenses }}}</td>
            <td>{{{$company->due_days }}}</td>
            <td>{{{$company->comment }}}</td>
        </tr>
    </tbody>
</table>

@stop
