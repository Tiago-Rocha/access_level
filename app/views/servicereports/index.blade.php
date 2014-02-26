@extends('layouts.scaffold')

@section('main')
<!-- Datepicker Styles - Scripts  --> 
{{ HTML::script('assets/js/jquery.datetimepicker.js') }}
{{ HTML::style('assets/css/jquery.datetimepicker.css') }}
<!-- Smart Search Styles - Scripts  --> 
{{ HTML::style('assets/css/selectize.bootstrap3.css') }}
{{ HTML::script('assets/js/selectize.min.js') }} 

<script>
    $('#myModal').click(function(e) {
        e.preventDefault();

        $("#teste").modal({
        backdrop: true;
        }
    })
</script>




<h2>All Service Reports</h2>
<p>{{ link_to_route('servicereports.create', 'Create new Service Report') }}</p>
{{ Form::open(array('action' => 'ServiceReportsController@searchpastservices')) }}

<table class="table" style="background-color: #f5f5f5; float :left;">
    <tbody>
        <tr style="width: 100%; float: left; border:none;">
            <td style="width: 20%;">{{ Form::label('start', 'Start') }}</td>
            <td>{{ Form::text('start', '', array('id' => 'start')) }}</td>
            <td style="width: 20%;">{{ Form::label('end', 'End') }}</td>
            <td>{{ Form::text('end','', array('id' => 'end'))  }}</td>
            <td style="width: 20%;">{{ Form::label('company', 'Company') }}</td>
            <td><select style="float:right; width: 300px" id="searchbox" name="id" placeholder="Search company..." class="form-control"></select></td>
            <td>{{ Form::submit('Search', array('class' => 'btn btn-info')) }}</td>
            {{ Form::close() }}
    </tbody></table>
@if(isset($servicereports_search))
@if(!$servicereports_search->count())

There is no Service Reports on those dates
@else
<h4 align="center">Service Reports from date to date of X Company</h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Technician</th>
            <th>Internal</th>
            <th>Duration</th>
            <th>Free</th>
            <th>Subject</th>
            <th>Comment</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($servicereports_search as $servicereport)
        <tr>
            <td>{{{ Utilizador::find($servicereport->utilizador_id)->name }}}</td>
            <td>{{{ timeHelper::yes_Or_no($servicereport->internal)}}}</td>
            <td>{{{ timeHelper::toHoursMinutes($servicereport->duration) }}}</td>
            <td>{{{ timeHelper::yes_Or_no($servicereport->free) }}}</td>
            <td><a href="#myModal" data-toggle="modal">{{{ Str::limit($servicereport->subject,20) }}}</a></td>
            <td><a href="#myModal" data-toggle="modal">{{{ Str::limit($servicereport->comment, 80) }}}</a></td>
            <td><a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">See More</a></td>
            <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Subject : {{{$servicereport->subject }}}</h3>
        </div>
        <div class="modal-body">
            <p>{{{$servicereport->comment }}}</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</tr>

@endforeach
</tbody>
</table>



@endif
@else

@if($servicereports->count())

<h4 align="center">My Service Reports</h4>
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicereports as $servicereport)
        @if($servicereport->utilizador_id == Auth::user()->id && $servicereport->state == 'submitted')
        <tr>
            <td>{{{ Company::find($servicereport->company_id)->name }}}</td>
            <td>{{{ Utilizador::find($servicereport->utilizador_id)->name }}}</td>
            <td>{{{ timeHelper::yes_Or_no($servicereport->internal) }}}</td>
            <td>{{{ $servicereport->start }}}</td>
            <td>{{{ $servicereport->end }}}</td>
            <td>{{{ timeHelper::toHoursMinutes($servicereport->duration) }}}</td>
            <td>{{{ $servicereport->subject }}}</td>
            <td>{{ link_to_route('servicereports.edit', 'Edit', array($servicereport->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('servicereports.destroy', $servicereport->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

@if(Auth::user()->servicereport)
<h4 align="center">Service Reports to Validate</h4>
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $background = ''; ?>
        @foreach ($servicereports as $servicereport)
        @if($servicereport->duration/60 > Contract::find($servicereport->contract_id)->hoursleft & $servicereport->type != 'regie')
        <?php $background = 'style="background-color:red;"'; ?>
        @endif

        <tr>

            <td>{{{ Company::find($servicereport->company_id)->name }}}</td>
            <td>{{{ Utilizador::find($servicereport->utilizador_id)->name }}}</td>
            <td>{{{ timeHelper::yes_Or_no($servicereport->internal) }}}</td>
            <td>{{{ $servicereport->start }}}</td>
            <td>{{{ $servicereport->end }}}</td>
            <td <?php echo $background; ?>>{{{ timeHelper::toHoursMinutes($servicereport->duration)}}}</td>
            <td>{{{ $servicereport->subject }}}</td>
            <td>
                {{ Form::open(array('action' => array('ServicereportsController@changeState'))) }}
                {{ Form::hidden('id', $servicereport->id) }} 
                {{ Form::hidden('op', 'validated') }}
                {{ Form::submit('Validate', array('class' => 'btn btn-success')) }}
                {{ Form::close() }}
            </td>
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
@endif

@else
There are no servicereports
@endif
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
<script>
    $('#searchbox').selectize({
        options: <?php echo $company_options; ?>,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        sortField: {
            field: 'text',
            direction: 'asc'
        },
        dropdownParent: 'body'
    });
</script>



@stop
