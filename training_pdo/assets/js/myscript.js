$(document).ready(function(){
	$("#checkAll").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	//Disable Button Apply
	if($('select[name=action]').val() == 'default'){
		$('button[name=apply]').attr('disabled', 'disabled');
	}

	$('select[name=action]').change(function(){
		if($('select[name=action]').val() == 'default'){
			$('button[name=apply]').attr('disabled', 'disabled');
		}else{
			$('button[name=apply]').removeAttr('disabled');
		}
	});

	$('button[name=apply]').click(function() {
		if(document.querySelectorAll('input[type="checkbox"]:checked').length == 0){
			alert('Please select the row to change!');
			return false;
		}

		if($('select[name=action]').val() == 'delete'){
			var flag = confirm('Are you sure to delete ?');
			if(flag == false) return false;
		}
	});
	//Hide Alert
	$('div.alert').fadeOut(5000);      
});