@extends('layouts.scaffold')

@section('main')
<!-- Datepicker Styles - Scripts  --> 
{{ HTML::script('assets/js/jquery.js') }}
{{ HTML::script('assets/js/jquery.datetimepicker.js') }}
{{ HTML::style('assets/css/jquery.datetimepicker.css') }}

- Check box for hours</br>
- check box for send/save on server/print</br>
- Save selected</br>
- Send selected</br>
- Print selected</br>
- Input::has() to verify if exists or not
<h2>Invoicing</h2>

{{ Form::open(array('action' => array('InvoicesController@srsearch'))) }}

{{Form::label('start', 'Start :')}}
{{ Form::text('start', '', array('id' => 'start'))}}

{{ Form::label('end', 'End :') }}
{{ Form::text('end','', array('id' => 'end')) }}

</br>
{{ Form::submit('Search', array('class' => 'btn btn-info')) }}

{{ Form::close() }}

@if ($invoices->count())
<p>{{{'You have ' . $invoices->count() . ' Invoices to send!'}}}</p>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Regie</th>
            <th>IT Assist</th>
            <th>Project</th>
            <th>External Services</th>
            <th>TVA Rate</th>
            <th>Total</th>            
            <th>Actions</th>
            
        </tr>
    </thead>

    <tbody>
        @foreach ($invoices as $invoice)

        <tr>
            <td>{{{ $invoice->id }}}</td>
            <td>{{{ Company::find($invoice->company_id)->name }}}</td> 
            <td>{{{Invoice::getHours($invoice->id, 'regie')}}}</td>            
            <td>{{{Invoice::getHours($invoice->id, 'it assist')}}}</td>
            <td>{{{Invoice::getHours($invoice->id, 'project')}}}</td>
            <td>{{{Invoice::getHours($invoice->id, 'external')}}}</td>
            <td>{{{ $invoice->tva . '%' }}}</td>
            <td>{{{ round($invoice->total, 2) }}}</td>
            <td>
                {{ link_to_route('invoices.show', 'Preview Invoice', array($invoice->id), array('class' => 'btn btn-success')) }}
                {{ Form::label('send', 'Send by email?') }}
                {{ Form::checkbox('send', 'value', true) }}
            </td>
            <td>
                {{ link_to_action('InvoicesController@previewList', 'Preview List', array('id' => $invoice->id), array('class' => 'btn btn-success')) }}
                {{ Form::label('send', 'Send by email?') }}
                {{ Form::checkbox('send', 'value', true) }}
            </td>
            <td>{{ link_to_action('InvoiceLinesController@index', 'Edit', array('id' => $invoice->id), array('class' => 'btn btn-info')) }}</td>
            <td> 
                {{ Form::open(array('method' => 'DELETE', 'route' => array('invoices.destroy', $invoice->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
            
            
        @endforeach
        <tr style="border:none;"> 
            <td style="border-right:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            <td style="border:none;"></td>
            
            <td style="border:none;">
                Send 
            </td></tr>
    </tbody>
</table>
@else
There are no invoices ready to sent? to validate? Humm
@endif

<script>
    $('#start').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
    $('#end').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
</script>
@stop