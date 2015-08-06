<?php
	session_start();

?>

<link href='plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='plugins/moment/moment.min.js'></script>
<script src="js/validation.js"></script>


<!--<script src='../plugins/jquery/jquery.min.js'></script>-->
<script src='plugins/fullcalendar/fullcalendar.min.js'></script>

<div class="row full-calendar">
	<!--<div class="col-sm-3">
		<div id="add-new-event">
			<h4 class="page-header">Add new bills</h4>
			<div class="form-group">
				<label>Bills title</label>
				<input type="text" id="new-event-title" class="form-control">
			</div>
			<div class="form-group">
				<label>Bill description</label>
				<textarea class="form-control" id="new-event-desc" rows="3"></textarea>
			</div>
			<a href="#" id="new-event-add" class="btn btn-primary pull-right">Add Bill</a>
			<div class="clearfix"></div>
		</div>
		<div id="external-events">
			<h4 class="page-header" id="events-templates-header">Mostly used Bill titles</h4>
			<div class="external-event">Restaurant</div>
			<div class="external-event">Trips</div>
			<div class="external-event">Coffee Time</div>
			<div class="external-event">Lunch</div>
			<div class="external-event">Dinner</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" id="drop-remove"> remove after drop
					<i class="fa fa-square-o small"></i>
				</label>
			</div>
		</div>
	</div>-->
	<div class="col-sm-9">
		<div id="calendar"></div>
	</div>
</div>
<div id="fullCalModal" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title">Add Bills</h4>
            </div>
            <div class="modal-body" >
                <form data-toggle="validator" name="addbills" id="addbills" role="form" >
                    <div class="form-group">
                        <input type="hidden" name="start_bill_day" id="start_bill_day" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="name" name="bill_title" id="bill_title" class="form-control" data-minlength="3" required placeholder="Bill Title" data-error="atleast 3 character" >
                    	<div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                         <textarea name="bill_description" id="bill_description" class="form-control" id="new-event-desc" placeholder="Bill Description " rows="3"></textarea>
                     </div>
                    <div class="form-group">
                        <input type="name" name="bill_amount" id="bill_amount" class="form-control" required pattern="^[0-9]+.*[0-9]*" placeholder="Amount" data-error="please use 0.0">
                        <span class="help-block">use 0.0 format</span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="1checkbox">
    					<label>
      						<input type="checkbox" id="split_frens_check" name="split_frens_check" value="split_frens_check_val">  split with friends
    					</label>
  					</div>
  					<div class="form-group">
					<div id="add_friend_container" class="container">
    					<div class="row clearfix">
							<div class="col-md-5 column">
								<table class="table table-bordered table-hover" id="tab_logic">
									<thead>
										<tr >
											<th class="text-center">
												#
											</th>
											<th class="text-center">
												Name
											</th>
											<th class="text-center">
												Share 
											</th>
										</tr>
									</thead>
									<tbody>
                    					<tr id='addr1'></tr>
									</tbody>
								</table>
							</div>
						</div>
						<button type="button" id="add_row" class="btn btn-primary pull-left">Add Friend</a>&nbsp;
						<button type="button" id='delete_row' class="pull-left btn btn-default">Delete Friend</a>
					</div>
  					</div>                             
                   	<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                	<button type="submit" id="addbills_btn" class="btn btn-primary">Add Bill</button>
                  		
                   	</div>
                </form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
$("#add_friend_container").hide();
	$('#split_frens_check').change(function(){
    	if (this.checked) {
        	$("#add_friend_container").show();
    	}
    	else {
    		$("#add_friend_container").hide();
    	}
	});
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			selectable: true,
			selectHelper: true,
			timezone: 'UTC',
			select: function(start, end) {
				$('#addbills')[0].reset();
            	$('#fullCalModal #start_bill_day').val(start);
            	$('#fullCalModal').modal();
				$('#calendar').fullCalendar('unselect');
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			eventClick: function(calEvent, jsEvent, view) {
				//alert(calEvent.title);
				$('#fullCalModal #start_bill_day').val(calEvent.start);
				$('#fullCalModal #bill_title').val(calEvent.title);
				$('#fullCalModal #bill_description').val(calEvent.description);
				$('#fullCalModal #bill_amount').val(calEvent.amount);
				$('#fullCalModal').modal();
			},
			events: {
					url: 'ajax/get_events.php',
					error: function() {
						alert('wtf');
					}
				},

			/*events: [
				{
					title: 'All Day Event',
					start: '2014-12-01'
				},
				{
					title: 'Long Event',
					start: '2014-12-10',
					end: '2014-12-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2014-11-11',
					end: '2014-11-13'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T10:30:00',
					end: '2014-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2014-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2014-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-11-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-12-28'
				}
			]*/
		});
		

 $('#addbills').on('submit', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doSubmit();
  });

  function doSubmit(){
    $("#fullCalModal").modal('hide'); 
    var post_bill_details = new Object();
    post_bill_details['title'] = $('#bill_title').val();
    post_bill_details['desc'] = $('#bill_description').val();
    for (var cnt = 1; cnt<=i ; cnt++){
    	//post_bill_details['friends'].push("email","30");
    }
    //alert(post_bill_details['friends']['email']);
    $("#calendar").fullCalendar('renderEvent',
        {
            title: $('#bill_title').val(),
            start: new Date($('#start_bill_day').val()),
            allDay:1,
            
        },
        true);
   // $.post( "ajax/add_bills.php", { title: $('#bill_title').val(), billday: new Date($('#start_bill_day').val()) })
   	$.post( "ajax/add_bills.php", $( "#addbills" ).serialize())
	.done(function( data ) {
		alert(data);
	});
   }

    var i=1;
    $("#add_row").click(function(){

    $('#addr'+i).html("<td>"+ (i) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md' /> </td><td><input  id = 'share"+i+"' name='share"+i+"' type='text' class='form-control input-md'></td>");

    $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
    do_share_math(i);
    i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
			$("#addr"+(i-1)).html('');
			do_share_math(i-2);
			i--;

		}
	});
	function do_share_math(i){
		if(i>=1){
    	var per_share = $('#bill_amount').val()/(i+1);
    	for(var counter=1; counter<=i; counter++){
   			$('#share'+counter).val(per_share);
   		}
   	}
	}

});

</script>
