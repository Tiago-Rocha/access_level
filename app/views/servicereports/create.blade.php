@extends('layouts.scaffold')

@section('main')
<!-- Datepicker Styles - Scripts  --> 
{{ HTML::script('assets/js/jquery.js') }}
{{ HTML::script('assets/js/jquery.datetimepicker.js') }}
{{ HTML::style('assets/css/jquery.datetimepicker.css') }}


<!-- Documentacao do datetimepicker -->
<!-- http://forums.laravel.io/viewtopic.php?id=10879 Vai servir para os invoices -->
<!-- http://jsfiddle.net/jaredwilli/tZPg4/4/ Adicionar check boxes -->


<h2>New Service Report</h2>
{{ Form::open(array('route' => 'servicereports.store')) }}

<table class="table" style="background-color: #f5f5f5; float :left; width : 33%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Company and Contract</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('company_id', 'Company') }}</td>
        <td>{{ Form::select('company_id', array('default' => 'Please Select')+$company_options, 'Default' ) }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('contract_id', 'Contract') }}</td>
        <td>
            <select id="contract_id" name="contract_id">
                <option>Please Choose a Contract</option>
            </select>
        </td>
    </tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5; float :left; width : 33%; margin-left: 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Duration </h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('start', 'Start') }}</td>
        <td>{{ Form::text('start', '', array('id' => 'start')) }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('end', 'End') }}</td>
        <td>{{ Form::text('end','', array('id' => 'end'))  }}</td>
    </tr>
    <tr style="width: 100%; float: left;"><td style="border : none;"><p id="text"/></td></tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5;float :left; width : 33%; margin-left: 5px;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Specific Info</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('free', 'Free?') }}</td>
        <td>{{ Form::select('free', array('default' => 'Free service Report?','0' => 'No','1' => 'Yes'), 'Default') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('internal', 'Internal Service?') }}</td>
        <td>
            {{ Form::select('internal', array(
                'default' => 'Internal?','0' => 'No','1' => 'Yes'), 'Default') }}
        </td>
    </tr>
</tbody></table>
<table class="table" style="background-color: #f5f5f5;float :left; width : 100%;">
    <thead>
        <tr style="background-color: #e3e3e3;">
            <th><h4 style="text-align: center;">Notes</h4></th>
</tr>
</thead>
<tbody>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%; border :none;">{{ Form::label('subject', 'Subject:') }}</td>
        <td style="border :none;">{{ Form::text('subject') }}</td>
    </tr>
    <tr style="width: 100%; float: left;">
        <td style="width: 45%;">{{ Form::label('comment', 'Comment:') }}</td>
        <td>{{ Form::textarea('comment') }}</td>
    </tr>    
    <tr style="width: 100%; float: left;">
        <td style="width: 100%; border: none;"></td>
        <td style="border: none;">{{ Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submit')) }}</td>
        <td style="border: none;">{{ link_to_route('servicereports.index', 'Cancel') }}</td>
    </tr>
</tbody></table>




<input id="duration" type="hidden"  name="duration" value="">
<input id="state" type="hidden"  name="state" value="submitted">
<input id="utilizador_id" type="hidden"  name="utilizador_id" value="{{{Auth::user()->id}}}">


{{ Form::close() }}
<script>
    $('#start').datetimepicker({
        format: 'Y-m-d H:i:00',
        onChangeDateTime: function() {
            calcDuration();
        }
    });
    $('#end').datetimepicker({
        format: 'Y-m-d H:i:00',
        onChangeDateTime: function() {
            calcDuration();
        }
    });
</script>
<script>
    function calcDuration() {
        var text = document.getElementById('text');
        text.innerHTML = '';
        //Get String values of datetime        
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;

        if (start === "" || end === "") {
            text.innerHTML = 'Fields Missing';
            return;
        }
        //Split String into array of bits
        var start_bits = start.split(/\D/);
        var end_bits = end.split(/\D/);

        //define and create var of type object for the algorythm
        var earlierDate, laterDate;
        earlierDate = new Date(start_bits[0], start_bits[1], start_bits[2], start_bits[3], start_bits[4]);
        laterDate = new Date(end_bits[0], end_bits[1], end_bits[2], end_bits[3], end_bits[4]);

        //checking Miliseconds difference between the two dates        
        var nTotalDiff = laterDate.getTime() - earlierDate.getTime();

        if (nTotalDiff < 0 || start === end) {
            text.innerHTML = 'Check dates';
            return;
        }
        var oDiff = new Object();

        oDiff.days = Math.floor(nTotalDiff / 1000 / 60 / 60 / 24);
        nTotalDiff -= oDiff.days * 1000 * 60 * 60 * 24;
        if (!(oDiff.days === 0)) {
            text.innerHTML = 'Service Report to long';
            return;
        }
        oDiff.hours = Math.floor(nTotalDiff / 1000 / 60 / 60);
        nTotalDiff -= oDiff.hours * 1000 * 60 * 60;

        oDiff.minutes = Math.floor(nTotalDiff / 1000 / 60);
        nTotalDiff -= oDiff.minutes * 1000 * 60;

        var minutes = oDiff.hours * 60 + oDiff.minutes;
        var duration = $('#duration');
        duration.empty();
        duration.type = "text";
        duration.val(minutes);
        duration.type = "hidden";
        text.innerHTML = 'Service Report with ' + oDiff.hours + ' hours and ' + oDiff.minutes + ' minutes';



    }
</script>
<script>
    $('#company_id').change(function() {
        $.get("{{ url('api/dropdown')}}",
                {option: $(this).val()},
        function(data) {
            var contract = $('#contract_id');
            contract.empty();
            var contracthours = new Array(3);
            contractinfos = new Object();
            contractinfos.regie = 0;
            contractinfos.itassist = 0;
            contractinfos.project = 0;
            contractinfos.regie_id = 0;
            contractinfos.itassist_id = 0;
            contractinfos.project_id = 0;
            contractinfos.itassist_lasthour = 0;
            contractinfos.project_lasthour = 0;

            $.each(data, function(index, element) {
                switch (element.type) {
                    case "regie":
                        contractinfos.regie_id = parseFloat(element.id);
                        break;

                    case "it assist":
                        if (contractinfos.itassist_id === 0 || contractinfos.itassist_lasthour > element.hoursleft) {
                            contractinfos.itassist_lasthour = parseFloat(element.hoursleft);
                            contractinfos.itassist_id = parseFloat(element.id);
                        }
                        contractinfos.itassist += parseFloat(element.hoursleft);
                        break;

                    case "project":
                        if (contractinfos.project_id === 0 || contractinfos.project_lasthour > element.hoursleft) {
                            contractinfos.project_lasthour = parseFloat(element.hoursleft);
                            contractinfos.project_id = parseFloat(element.id);
                        }
                        contractinfos.project += parseFloat(element.hoursleft);
                        break;
                }
            });
            if (!(contractinfos.regie_id === 0)) {
                contract.append("<option value='" + contractinfos.regie_id + "'>Regie</option>");
            }
            if (!(contractinfos.itassist === 0)) {
                contract.append("<option value='" + contractinfos.itassist_id + "'>IT Assist : " + Math.round(contractinfos.itassist * 100) / 100 + " hours</option>");
            }
            if ((!contractinfos.project === 0)) {
                contract.append("<option value='" + contractinfos.project_id + "'>Project : " + Math.round(contractinfos.project * 100) / 100 + " hours</option>");
            }
        });
    });
</script>


@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop


