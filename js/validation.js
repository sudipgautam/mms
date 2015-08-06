/*$( "#signup" ).submit(function( event ) {
	var name 		= $( "#name" ).val();
  	var email 		= $("#email").val();
  	var password 	= $("#password").val();
  	var c_password	= $("#c_password").val();

  	if (/^[a-z\d]* [a-z\d]*$/i.test(name)) {
    	alert('suceess');
    	$("#name").css("border", "2px solid #cccccc");
	} else {
		$("#name").css("border","2px solid #A52A2A");
    	alert('fail');
	}
	if (((password.length) > 5) && (password == c_password)){
		$("#password").css("border", "2px solid #cccccc");
		$("#c_password").css("border", "2px solid #cccccc");
	} else{
		$("#password").css("border","2px solid #A52A2A");
		$("#c_password").css("border","2px solid #A52A2A");

	}

  console.log(name);
  event.preventDefault();
});

*/