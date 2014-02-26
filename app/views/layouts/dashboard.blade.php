@extends('layouts.scaffold')

@section('main')
{{ HTML::script('assets/js/jquery.min.js') }}
{{ HTML::script('assets/js/fullcalendar.min.js') }}
{{ HTML::script('assets/js/jquery-ui.custom.min.js') }}
{{ HTML::style('assets/css/fullcalendar.css') }}
<script>

    $(document).ready(function() {

    var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var servicereports = <?php echo $servicereports ?>;
            var allevents = new Array();
            var color = null;
            for (var index = 0; index < servicereports.length; ++index) {
                if((servicereports[index].internal === 0) ? color = 'blue' : color = 'green');
                allevents.push({
                    title: servicereports[index].subject,
                    start: servicereports[index].start,
                    end: servicereports[index].end,
                    allDay: false,
                    backgroundColor: color,              
                    textColor: 'white',
                    color: 'yellow'
                });
              }
    $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,month,agendaDay'
    },
            defaultView : 'agendaWeek',      
            hiddenDays: [ 0, 6 ],
            minTime: '8:00am',
            maxTime: '8:00pm',
            events: allevents
    
            });
    });

</script>
<style>


    #calendar {
        width: 900px;
        margin: 0 auto;
        float: left;
    }

</style>
<div id="calendar"/>


@stop
