@extends('layouts.scaffold')

@section('main')
    
      <!-- Datepicker Styles - Scripts  --> 
        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/jquery.datetimepicker.js') }}
        {{ HTML::style('assets/css/jquery.datetimepicker.css') }}
     
<h2>Create Contract</h2>

{{ Form::open(array('route' => 'contracts.store')) }}
	<ul>
        <li>               
            {{ Form::label('date', 'Date:') }}
            {{ Form::text('date', '', array('id' => 'date', 'data-date-format'=>'yyyy-mm-dd'))}}
        </li>
   
        <li>
            {{ Form::label('client_id', 'Client :') }}
            {{ Form::select('client_id', $client_options , Input::old('contracts')) }}
        </li>
        <li>
            {{ Form::label('type', 'Type :') }}
            {{ Form::select('type', array('' => 'Pick Type', 'regie' => 'Regie', 'it assist' => 'IT Assist', 'project' => 'Project'), '')  }}
        </li>
        <li>
            <label id="hourstotal_label" for="hourstotal">Total Hours :</label>
            <input  id="hourstotal" type="text" name="hourstotal" value="">
        </li>

        <li>
            {{ Form::label('hourprice_label', 'Price Per Hour :') }}
            {{ Form::input('number', 'hourprice') }}
        </li>

        <li>
            {{ Form::label('travelprice', 'Travel Fee :') }}
            {{ Form::input('number', 'travelprice') }}
        </li>
            <label id="note_label" for="note">Contract Note :</label>
            <input  id="note" type="text" name="note" value="">
            <input  id="hoursleft" type="hidden" name="hoursleft" value="0">
            <input  id="state" type="hidden" name="state" value="created">
	<li>
            {{ Form::submit('Create', array('class' => 'btn btn-info')) }}
            {{ link_to_route('contracts.index', 'Cancel') }}
	</li>
	</ul>
{{ Form::close() }}

<script>
    $('#date').datetimepicker({
	timepicker:false,
	format:'Y-m-d'
});
</script> 
<script>
    $('#type').change(function(){
                if($(this).val() === 'regie') {
                     document.getElementById("hourstotal").value = 0;
                     document.getElementById("hourstotal").type = "hidden";
                     document.getElementById("hourstotal_label").style.display = "none";
                }else{
                     document.getElementById("hourstotal").type = "text";
                     document.getElementById("hourstotal_label").style.display = "block";
                     
                }
             
    });
    $('#hourstotal').change(function(){
        var hoursleft = $('#hoursleft');
        hoursleft.empty();
        hoursleft.type = "text";
        hoursleft.val($(this).val());
        hoursleft.type = "hidden";
        });
</script> 
@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>

@endif

@stop


