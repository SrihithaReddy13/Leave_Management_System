$(document).ready(function(){
	$('#emplinfo').hide();
	$('#leavetaken').hide();
	$('#empl').click(function(){
		$('#emplinfo').show();
		$('#personal').hide();
		$('#leavetaken').hide();
	});
	$('#profile').click(function(){
		$('#emplinfo').hide();
		$('#personal').show();
		$('#leavetaken').hide();
	});
	$('#leaves').click(function(){
		$('#emplinfo').hide();
		$('#personal').hide();
		$('#leavetaken').show();
	});
	$('#leaveinfo').hide();
	$('#leavetaken').hide();
	$('#applyleave').hide();
	$('#salarycalc').hide();
	$('#profile').click(function(){
		$('#leaveinfo').hide();
		$('#personal').show();
		$('#leavetaken').hide();
		$('#applyleave').hide();
		$('#salarycalc').hide();
	});
	$('#aleave').click(function(){
		$('#leaveinfo').hide();
		$('#personal').hide();
		$('#leavetaken').hide();
		$('#applyleave').show();
		$('#salarycalc').hide();
	});
	$('#sleave').click(function(){
		$('#leaveinfo').hide();
		$('#personal').hide();
		$('#leavetaken').show();
		$('#applyleave').hide();
		$('#salarycalc').hide();
	});
	$('#rleave').click(function(){
		$('#leaveinfo').show();
		$('#personal').hide();
		$('#leavetaken').hide();
		$('#applyleave').hide();
		$('#salarycalc').hide();
	});
	$('#salary').click(function(){
		$('#leaveinfo').hide();
		$('#personal').hide();
		$('#leavetaken').hide();
		$('#applyleave').hide();
		$('#salarycalc').show();
	})
});
var dateToday = new Date();
var dates = $("#sdate, #edate").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "sdate" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
