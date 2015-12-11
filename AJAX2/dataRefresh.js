$(document).ready(function(){
	toastr.options = {"closeButton": true, "debug": false,"newestOnTop": false,"progressBar": false, "positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};

	//Add to Database
	$("#sendButton").click(function(){
		var nameInput = $("#name").val();
		var numberInput = $("#number").val();
		if(!nameInput || !numberInput){
			toastr["warning"]('Please enter a name and number');
		}else{
			var form_data = {'name':nameInput.trim(), 'number':numberInput, 'f':'addNewContact'};
			$.ajax({
                url: "main.php",
                data: form_data,
                type: 'POST',
                dataType: 'json',
                success: function(php_response) {
                	var phpResponse = eval(php_response);
                	if(phpResponse.s == 1){
                		toastr["success"](phpResponse.msg);
                	}else if(phpResponse.s == 0){
                		toastr["warning"](phpResponse.msg);
                	}else{
                		toastr["error"](phpResponse.msg);
                	}
                    $('#name').val(null); 
                    $('#number').val(null);
                    updateContacts();
                }
            });
		}
	});
	$('#del').click(function() {
		if(confirm("Are you sure?")){
	    $.ajax({url: "main.php",data: {'f':'delAll'},type: 'POST', success: function(lol) {
            	toastr["success"]("Drop it like it's hot");
            	$('#database_data_trs').empty();
        	}
		});
		}else{
		    toastr["info"]("Okay Than");
		}
		
	});

	function updateContacts(){
		$.ajax({
	        url: "main.php",
	        data: {'f':'updateContacts'},
	        type: 'POST',
	        dataType: 'json',
	        success: function(contacts){
	        	$('#database_data_trs').empty();

	        	for(i = 0; i < contacts.length; i++){
	         		var contactsEvaled = eval(contacts);
	         		$('#database_data_trs').append("<tr><td>"+contactsEvaled[i].name+"</td><td>"+contactsEvaled[i].number+"</td></tr>");
	         	}
	    	}
		});
	}
	//Interval check database for data
	setInterval(function(){ updateContacts() }, 5000);
	
});