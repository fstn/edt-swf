<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='/jquery/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='/fullcalendar/fullcalendar.js'></script>
<script>
$(document).ready(function() {

    // page is now ready, initialize the calendar...
	var d = new Date();
	var y = d.getFullYear();
	var m = d.getMonth();
	var j = d.getDay();
    $(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			editable: true,
            weekends: false ,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'agendaWeek',
			events: [
				
				
			
		
{
	title: 'UNIX LINUX ',
	start: new Date(2011, 0, 10,  09, 00),
	end: new Date(2011, 0, 10,  12, 15),
	allDay: false
}
,
{
	title: 'PPRT ',
	start: new Date(2011, 0, 10,  13, 30),
	end: new Date(2011, 0, 10,  17, 30),
	allDay: false
}
,
{
	title: '- ',
	start: new Date(2011, 0, 10,  08, 00),
	end: new Date(2011, 0, 10,  18, 00),
	allDay: false
}
,
{
	title: 'ALGO. PROG. ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  15, 45),
	allDay: false
}
,
{
	title: 'ALGO. PROG. ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  15, 45),
	allDay: false
}
,
{
	title: 'ALGO. PROG. ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  15, 45),
	allDay: false
}
,
{
	title: 'MISSION M2 ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  14, 45),
	allDay: false
}
,
{
	title: 'PROJET R&D ',
	start: new Date(2011, 0, 10,  10, 15),
	end: new Date(2011, 0, 10,  12, 15),
	allDay: false
}
,
{
	title: 'BIOMATERIAUX ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  15, 45),
	allDay: false
}
,
{
	title: 'LES MEDIAS INFORMATISES DANS LES SIC ',
	start: new Date(2011, 0, 10,  09, 30),
	end: new Date(2011, 0, 10,  12, 30),
	allDay: false
}
,
{
	title: 'LES MEDIAS INFORMATISES DANS LES SIC ',
	start: new Date(2011, 0, 10,  14, 00),
	end: new Date(2011, 0, 10,  17, 00),
	allDay: false
}
,
{
	title: 'SIMULATION PROCEDES ',
	start: new Date(2011, 0, 10,  16, 00),
	end: new Date(2011, 0, 10,  18, 00),
	allDay: false
}
,
{
	title: 'EFFETS BIOLOGIQUES DES RI ',
	start: new Date(2011, 0, 10,  09, 00),
	end: new Date(2011, 0, 10,  12, 15),
	allDay: false
}
,
{
	title: 'EFFETS BIOLOGIQUES DES RI ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  17, 00),
	allDay: false
}
,
{
	title: 'MINERAUX INDUSTRIELS ',
	start: new Date(2011, 0, 10,  08, 00),
	end: new Date(2011, 0, 10,  10, 00),
	allDay: false
}
,
{
	title: 'REACTEURS CHIMIQUES ',
	start: new Date(2011, 0, 10,  08, 00),
	end: new Date(2011, 0, 10,  10, 00),
	allDay: false
}
,
{
	title: 'ANGLAIS ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  18, 00),
	allDay: false
}
,
{
	title: 'PROJET LONG,PROJET BAT. ',
	start: new Date(2011, 0, 10,  08, 00),
	end: new Date(2011, 0, 10,  12, 15),
	allDay: false
}
,
{
	title: 'RDM DES OA ',
	start: new Date(2011, 0, 10,  08, 30),
	end: new Date(2011, 0, 10,  12, 30),
	allDay: false
}
,
{
	title: 'RDM DES OA ',
	start: new Date(2011, 0, 10,  13, 45),
	end: new Date(2011, 0, 10,  18, 15),
	allDay: false
}
	]
		});
	});
 }); 

</script> 
<div id='calendar'></div>
