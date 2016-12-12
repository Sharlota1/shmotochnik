$(document).ready(function(){
	
});
var shm = shm || {};

shm.checkInbutByEmpty = function(){
	var $file_of_clother = $("input[type='file']");
	var $name_of_clother = $("#name_clother");
	var type_of_clother = document.getElementsByName('check_list[]');
	var isTypeChecked = false;
	for (var i = 0, len = type_of_clother.length; i < len; i++) {
		if(type_of_clother[i].checked) {
			isTypeChecked = true;
			break;
		}
	}

	var $min_temperature = $("#min_temperature");
	var $max_temperature = $("#max_temperature");
	var correct_data = true;
	if(!isTypeChecked){
		correct_data = false;
	}
	$(".dataIsNotCorrect").removeClass("dataIsNotCorrect");
	if($file_of_clother.val() == ""){
		correct_data = false;
		shm.addErrorToField($file_of_clother);
	}
	if ($name_of_clother.val().trim() == "") {
		correct_data = false;
		shm.addErrorToField($name_of_clother);
	}
	if (!isTypeChecked) {
		correct_data = false;
		shm.addErrorToField($(".check_clother"));
	}
	if ($min_temperature.val().trim() == "") {
		correct_data = false;
		shm.addErrorToField($min_temperature);
	}
	if ($max_temperature.val().trim() == "") {
		correct_data = false;
		shm.addErrorToField($max_temperature);
	}
	if(!shm.check_temperature($min_temperature, $max_temperature)){
		shm.addErrorToField($min_temperature);
		shm.addErrorToField($max_temperature);
	}

	if (correct_data) {
		$("#send_data").click();
	}

}
shm.addErrorToField = function(field) {
	field.addClass("dataIsNotCorrect");
}
shm.check_temperature = function (field_min, field_max){
	if((field_min.val() < -45 && field_min.val() > 45 ) || (field_max.val() > 45 && field_max.val() < -45) ){
		return false;
	} else if( field_min.val() < 0 && field_max.val() < 0 ) {
			if( Math.abs(field_min.val()) < Math.abs(field_max.val()) ) {
				return false;
			} else {
				return true;
			}
	} else {
		if(field_min.val() > field_max.val()){
			return false;
		} else {
			return true;
		}
	}
}