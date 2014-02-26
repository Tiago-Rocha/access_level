@extends('layouts.scaffold')

@section('main')
      <!-- Datepicker Styles - Scripts  --> 
        {{ HTML::script('assets/js/jquery.js') }}
        {{ HTML::script('assets/js/jquery.datetimepicker.js') }}
        {{ HTML::style('assets/css/jquery.datetimepicker.css') }}
        
        
<!-- Documentacao do datetimepicker -->
<!-- http://forums.laravel.io/viewtopic.php?id=10879 Vai servir para os invoices -->
<!-- http://jsfiddle.net/jaredwilli/tZPg4/4/ Adicionar check boxes -->
<h2>Create Servicereport</h2>

{{ Form::open(array('route' => 'servicereports.store')) }}
	<ul>
        <li>
            {{ Form::label('Utilizador', 'Utilizador:') }}
            {{ Form::select('utilizador_id', $utilizador_options, Session::get('username')) }}
        </li>
        <li>
            {{ Form::label('company_id', 'Company :') }}
            {{ Form::select('company_id', $company_options , 'Toni') }}
        </li>     
        <li>
            {{ Form::label('contract_id', 'Contract :') }}
                <select id="contract_id" name="contract_id">
                    <option></option>
                </select>
        </li>
        <li>
            {{ Form::label('internal', 'Internal Service?') }}
            {{ Form::select('internal', array(
                '' => '',        
                '0' => 'No',
                '1' => 'Yes')) }}
        </li>
        <li>
            {{ Form::label('start', 'Start:') }}
            {{ Form::text('start', '', array('id' => 'start')) }}
        </li>
        <li>
            {{ Form::label('end', 'End:') }}
            {{ Form::text('end','', array('id' => 'end'))  }}
        </li>
        <li>
            <p id="text"></p>
        </li>
        <li>
            {{ Form::label('subject', 'Subject:') }}
            {{ Form::text('subject') }}
        </li>
        <li>
            {{ Form::label('comment', 'Comment:') }}
            {{ Form::textarea('comment') }}
        </li>
           <input id="duration" type="hidden"  name="duration" value="">
           <input id="state" type="hidden"  name="state" value="submitted">
        <li>
            {{ Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submit')) }}
	</li>
	</ul>
{{ Form::close() }}
<script>
$('#start').datetimepicker({
    format:'Y-m-d H:i:00',
        onChangeDateTime:function(){
		calcDuration();
	}        
});
$('#end').datetimepicker({
        format:'Y-m-d H:i:00',
        onChangeDateTime:function(){
		calcDuration();
	}
});
</script>
<script>    
    function calcDuration() {
        var text = document.getElementById('text');
        text.innerHTML ='';
            //Get String values of datetime        
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        
        if(start === "" || end === ""){
            text.innerHTML ='Fields Missing';
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
        
        if(nTotalDiff < 0  || start === end){
            text.innerHTML ='Check dates';
            return;
        }
            var oDiff = new Object();

       oDiff.days = Math.floor(nTotalDiff/1000/60/60/24);
       nTotalDiff -= oDiff.days*1000*60*60*24;
       if (!(oDiff.days === 0)){
           text.innerHTML ='Service Report to long';
           return;
       }
       oDiff.hours = Math.floor(nTotalDiff/1000/60/60);
       nTotalDiff -= oDiff.hours*1000*60*60;
 
       oDiff.minutes = Math.floor(nTotalDiff/1000/60);
       nTotalDiff -= oDiff.minutes*1000*60;
       
       var minutes = oDiff.hours*60+oDiff.minutes;
       var duration = $('#duration');
            duration.empty();
            duration.type = "text";
            duration.val(minutes);
            duration.type = "hidden";
       //duration.val(oDiff.hours + " hour(s) " + "and " + oDiff.minutes + "minutes" );
       text.innerHTML= 'Service Report with '+oDiff.hours+' hours and '+ oDiff.minutes +' minutes';
       
        
           
     }
</script>
<!-- http://xdsoft.net/jqplugins/datetimepicker/  Tem handler para quando sai-->
<script>
        $('#company_id').change(function(){
                                $.get("{{ url('api/dropdown')}}", 
                                        { option: $(this).val() }, 
                                        function(data) {
                                                var contract = $('#contract_id');
                                                contract.empty();
                                                var contracthours = new Array(3);
                                                contractinfos=new Object();
                                                contractinfos.regie = 0;
                                                contractinfos.itassist = 0;
                                                contractinfos.project = 0;
                                                contractinfos.regie_id = 0;
                                                contractinfos.itassist_id = 0;
                                                contractinfos.project_id = 0;
                                                contractinfos.itassist_lasthour = 0;
                                                contractinfos.project_lasthour = 0;
                                               /* contracthours[0] = 0;
                                                contracthours[1] = 0;
                                                contracthours[2] = 0;*/
                                                $.each(data, function(index, element) {
                                                    switch (element.type){
                                                               case "regie":
                                                               contractinfos.regie_id = parseFloat(element.id);
                                                               break;
                                                               
                                                               case "it assist":
                                                               if  (contractinfos.itassist_id ===0 || contractinfos.itassist_lasthour > element.hoursleft) {
                                                                   contractinfos.itassist_lasthour = parseFloat(element.hoursleft);
                                                                   contractinfos.itassist_id = parseFloat(element.id);
                                                               }
                                                               contractinfos.itassist += parseFloat(element.hoursleft);
                                                               break;
                                                               
                                                               case "project":
                                                               if  (contractinfos.project_id ===0 || contractinfos.project_lasthour > element.hoursleft) {
                                                                   contractinfos.project_lasthour = parseFloat(element.hoursleft);
                                                                   contractinfos.project_id = parseFloat(element.id);
                                                               }
                                                               contractinfos.project += parseFloat(element.hoursleft);
                                                               break;
                                                        }
                                                  });
                                                  if(!(contractinfos.regie_id==0)){
                                                  contract.append("<option value='"+contractinfos.regie_id+"'>Regie</option>");
                                                  }
                                                  if(!(contractinfos.itassist==0)){
                                                  contract.append("<option value='"+contractinfos.itassist_id+"'>IT Assist : "+ contractinfos.itassist + " hours</option>");
                                                  }
                                                  if((!contractinfos.project==0)){
                                                    contract.append("<option value='"+contractinfos.project_id+"'>Project : "+ contractinfos.project + " hours</option>");
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


