$(document).ready(function(){
	$('.timepicker').timepicker({
		timeFormat: 'H:mm',
		interval: 15,
		minTime: '0:00am',
		maxTime: '11:45pm',
		defaultTime: '20',
		startTime: '00:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true
	});
});