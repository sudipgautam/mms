<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src = "https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.1.1/fullcalendar.min.js"></script> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<div id="calendar"></div>

<div id="createEventModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel1">Create Appointment</h3>
    </div>
    <div class="modal-body">
    <form id="createAppointmentForm" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="inputPatient">Patient:</label>
            <div class="controls">
                <input type="text" name="patientName" id="patientName" tyle="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Value 1&quot;,&quot;Value 2&quot;,&quot;Value 3&quot;]">
                  <input type="hidden" id="apptStartTime"/>
                  <input type="hidden" id="apptEndTime"/>
                  <input type="hidden" id="apptAllDay" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="when">When:</label>
            <div class="controls controls-row" id="when" style="margin-top:5px;">
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
    </div>
</div>
  
<script type="text/javascript">
$(document).ready(function() {

      var calendar = $('#calendar').fullCalendar({
      defaultView: 'agendaWeek',
      editable: true,
        selectable: true,
      //header and other values
      select: function(start, end, allDay) {
          endtime = $.fullCalendar.formatDate(end,'h:mm tt');
          starttime = $.fullCalendar.formatDate(start,'ddd, MMM d, h:mm tt');
          var mywhen = starttime + ' - ' + endtime;
          $('#createEventModal #apptStartTime').val(start);
          $('#createEventModal #apptEndTime').val(end);
          $('#createEventModal #apptAllDay').val(allDay);
          $('#createEventModal #when').text(mywhen);
          $('#createEventModal').modal('show');
       }
    });

  $('#submitButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();

    doSubmit();
  });

  function doSubmit(){
    $("#createEventModal").modal('hide');
    console.log($('#apptStartTime').val());
    console.log($('#apptEndTime').val());
    console.log($('#apptAllDay').val());
    alert("form submitted");
        
    $("#calendar").fullCalendar('renderEvent',
        {
            title: $('#patientName').val(),
            start: new Date($('#apptStartTime').val()),
            end: new Date($('#apptEndTime').val()),
            allDay: ($('#apptAllDay').val() == "true"),
        },
        true);
   }
});
</script>