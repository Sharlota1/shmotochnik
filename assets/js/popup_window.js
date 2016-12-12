$(document).ready(function(){
	var type = getParameters("type");
	var category = getParameters("category");
	$("select[name='category']").on("change", function(){
		if(!!type && ($("select[name='category']").val() != "Выберите категорию...")){
			location.href = location.origin + location.pathname + "#setting" + "?category='"+ $("select[name='category']").val() + "'&type='"+ $("select[name='type']").val() + "'";
		} else {
			if($("select[name='category']").val() != "Выберите категорию..."){
				location.href = location.origin + location.pathname + "#setting" + "?category='"+ $("select[name='category']").val() + "'";
			} else {
				location.href = location.origin + location.pathname + "#setting";

			}
		}
	});
	$("select[name='type']").on("change", function(){
		if (!!category && ($("select[name='type']").val() != "Выберите стиль...")) {
			location.href = location.origin + location.pathname + "#setting" + "?category='"+ $("select[name='category']").val() + "'&type='"+ $("select[name='type']").val()+ "'";
		} else {
			if($("select[name='type']").val() != "Выберите стиль..."){
				location.href = location.origin + location.pathname + "#setting" + "?type='"+ $("select[name='type']").val() + "'";
			} else {
				location.href = location.origin + location.pathname + "#setting" ;
			}
		}
	});
	if (!!category) {
		$("option[value="+ decodeURIComponent(category)+"]").attr("selected", "selected");
	}
	if (!!type) {
		$("option[value="+ decodeURIComponent(type)+"]").attr('selected','selected');
	}
});

function getParameters(sParam) {
	 var sPageURL = location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}
function display_elemnt(name, description, img_link, type, category, min_temperature, max_temperature) {
	var popup_block = $('<div id="popup_window" class="pop_up">'
						+'<div class="modal_content">'
							+'<span id="close" onclick="close_popup(event)">x</span>'
								+'<div class="image_content"><img src="'+img_link+'"></div>'
								+'<div class="text_content">'
								+'<div class="TitleClother">'+name+'</div>'
								+'<div class="TypeClother"><span class="field">Стиль: </span><span class="value">'+type+'</span></div>'
								+'<div class="CategoryClother"><span class="field">Категория: </span><span class="value">'+category+'</span></div>'
								+'<div class="TemperatureOfClother"><span class="field">Температура: </span><span class="value">'+min_temperature+' - '+max_temperature+' °C</span></div>'
								+'<div class="DescriptionClother">'+description+'</div>'
								+'</div>'
							+'</div>'
						+'</div>');
	    popup_block.insertAfter($('body'));
	}
function close_popup(event) {
	$(event.target).closest("div#popup_window").remove();
}
function edit_element(id, name, description, img_link, type, category, min_temperature, max_temperature){
	var popup_block = $('<form enctype="multipart/form-data" method="post">'
						+'<input id="id" name="id" type="text" value="'+id+'">'
						+'<div id="popup_window" class="pop_up">'
						+'<div class="modal_content">'
							+'<span id="close" onclick="close_popup(event)">x</span>'
								+'<div class="row_upload_image">'
					 				+'<span>Введите название:</span>'
							 		+'<textarea id="name_clother" placeholder="Name" name="name_clother" value="">'+name+'</textarea>'
						   		+'</div>'
						   		+'<div class="row_upload_image">'
					 				+'<span>Введите описание одежды:</span>'
							 		+'<textarea id="description_clother" placeholder="Description" name="description_clother" value="">'+description+'</textarea>'
						   		+'</div>'
						   		+'<div class="row_upload_image">'
					 				+'<span>Выберите стиль одежды:</span>'
					 				+'<div class="check_clother">'
						 				+'<input type="checkbox" id="check1" name="check_list[]" value="Повседневный стиль">Повседневный стиль<br />'
						 				+'<input type="checkbox" id="check2" name="check_list[]" value="Официальный/вечерний стиль">Официальный/вечерний стиль<br />'
					 					+'<input type="checkbox" id="check3" name="check_list[]" value="Деловой стиль">Деловой стиль<br />'
						 				+'<input type="checkbox" id="check4" name="check_list[]" value="Спортивный стиль">Спортивный стиль<br />'
						 			+'</div>'
						   		+'</div>'
						   		+'<div class="row_upload_image">'
						   			+'<span>Выберите категорию одежды:</span>'
						   			+'<select name="category">'
				  						+'<option value="Верх" selected>Верх</option>'
				  						+'<option value="Низ">Низ</option>'
				  						+'<option value="Костюм">Костюм</option>'
				  						+'<option value="Верхняя одежда">Верхняя одежда</option>'
				  						+'<option value="Обувь">Обувь</option>'
				  						+'<option value="Головной убор">Головной убор</option>'
				  						+'<option value="Аксессуар">Аксессуар</option>'
									+'</select>'
								+'</div>'
						   		+'<div class="row_upload_image">'
					 				+'<span>Температура:</span>'
								 		+'<input type="number" id="min_temperature" placeholder="Min" name="min_temperature" value="'+min_temperature+'">'
								 		+'<input type="number" id="max_temperature" placeholder="Max" name="max_temperature" value="'+max_temperature+'">'
						   		+'</div>'
						   		+'<input id="send_data_display" value="Обновить" type="button" onclick="checkInbutByEmpty()">'
		   	   					+'<input type="submit" name="submit" id="send_data" value="Обновить">'
							+'</div>'
						+'</div>'
						+'</form>'

						);
	    popup_block.insertAfter($('body'));
	    $("select[name='category'] option[value='"+category+"']").attr('selected', 'selected');
	    $("input[type='checkbox'][value='"+type+"']").attr('checked','checked');
}


function checkInbutByEmpty(){
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
	if ($name_of_clother.val().trim() == "") {
		correct_data = false;
		addErrorToField($name_of_clother);
	}
	if (!isTypeChecked) {
		correct_data = false;
		addErrorToField($(".check_clother"));
	}
	if ($min_temperature.val().trim() == "") {
		correct_data = false;
		addErrorToField($min_temperature);
	}
	if ($max_temperature.val().trim() == "") {
		correct_data = false;
		addErrorToField($max_temperature);
	}
	if(!check_temperature($min_temperature, $max_temperature)){
		addErrorToField($min_temperature);
		addErrorToField($max_temperature);
	}

	if (correct_data) {
		$("#send_data").click();
	}

}
function addErrorToField(field) {
	field.addClass("dataIsNotCorrect");
}
function check_temperature (field_min, field_max){
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