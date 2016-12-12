<?php
	session_start();
	function display_image() {
		include ("bd.php");
	 	$display = "SELECT * FROM images";
	 	$result = mysql_query($display, $connect);
		getFilter();
	 	while($row = mysql_fetch_array($result)) {
	 		$id = $row['id'];
	 		$select_type = "SELECT * FROM type_of_clother WHERE id_images = $id";
	 		$result_by_type = mysql_query($select_type, $connect);
	 		$array_type = array();
	 		while($row_type = mysql_fetch_array($result_by_type)) {
 				array_push($array_type, $row_type['value_type']);
 				$string_type = implode(", ", $array_type);
 			}
	 		echo '<div class="block_for_image">
					<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
	 				<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
	 					<div class="display_image"><img src="'.$row['image'].' "></div>
	 					<div class="display_details">
	 						<span>'.$row['name'].'</span>
	 					</div>
	 				</div>
	 			</div>';
	 	}
		mysql_close($connect);
	}

	function display_image_by_parameter($parameters, $value) {
		include ("bd.php");
	 	if ($parameters == "type") {
	 		$display = "SELECT * FROM type_of_clother WHERE value_type=$value";
	 		$result = mysql_query($display, $connect);
	 		getFilter();
	 		if(mysql_num_rows($result) > 0) {			
	 			while($row_type = mysql_fetch_array($result)) {
	 				$id_images = $row_type['id_images'];
	 				$display = "SELECT * FROM images WHERE id = '$id_images'";
	 				$result_images = mysql_query($display, $connect);
	 				if(mysql_num_rows($result_images) > 0){
	 					$row = mysql_fetch_array($result_images);
	 					$id = $row['id'];
				 		echo '<div class="block_for_image">
								<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$row['type'].'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
		 						<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$row['type'].'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
		 							<div class="display_image"><img src="'.$row['image'].' "></div>
		 							<div class="display_details">
		 								<span>'.$row['name'].'</span>
		 							</div>
			 					</div>
			 				</div>';
	 				}
	 			}
	 		}
	 	} else {
	 		$display = "SELECT * FROM images WHERE $parameters=$value";
	 		$result = mysql_query($display, $connect);
	 		getFilter();
			if(mysql_num_rows($result) > 0) {			
			 	while($row = mysql_fetch_array($result)) {
		 			$id = $row['id'];
		 			$select_type = "SELECT * FROM type_of_clother WHERE id_images = $id";
			 		$result_by_type = mysql_query($select_type, $connect);
			 		$array_type = array();
			 		while($row_type = mysql_fetch_array($result_by_type)) {
		 				array_push($array_type, $row_type['value_type']);
		 				$string_type = implode(", ", $array_type);
		 			}
		 			echo '<div class="block_for_image">
							<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
		 					<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
		 						<div class="display_image"><img src="'.$row['image'].' "></div>
		 						<div class="display_details">
		 							<span>'.$row['name'].'</span>
		 						</div>
		 					</div>
		 				</div>';
		 		}
	 		}
		}
		mysql_close($connect);
	}

	function display_image_by_parameters($parameters1, $parameters2, $value1, $value2) {
		include ("bd.php");
	 	$display = "SELECT * FROM type_of_clother WHERE value_type=$value1";
	 	$result = mysql_query($display, $connect);
	 	getFilter();
		if(mysql_num_rows($result) > 0) {			
	 		while($row_type = mysql_fetch_array($result)) {
	 			$id = $row_type['id_images'];
	 			$select_type = "SELECT * FROM type_of_clother WHERE id_images = $id";
	 			$result_by_type = mysql_query($select_type, $connect);
	 			$array_type = array();
	 				while($row_type = mysql_fetch_array($result_by_type)) {
 						array_push($array_type, $row_type['value_type']);
 						$string_type = implode(", ", $array_type);
 					}
	 			$display_by_second = "SELECT * FROM images WHERE id = '$id' and $parameters2 = $value2";
	 			$result_images = mysql_query($display_by_second, $connect);
	 			if(mysql_num_rows($result_images) > 0) {
	 				$row = mysql_fetch_array($result_images);
	 				echo '<div class="block_for_image">
							<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
	 						<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
	 							<div class="display_image"><img src="'.$row['image'].' "></div>
	 							<div class="display_details">
	 								<span>'.$row['name'].'</span>
	 							</div>
	 						</div>
	 					</div>';
	 			}
	 		}
		}
		mysql_close($connect);
	}

	function getFilter(){
		echo '<div id="filters">
		<select name="category">
			<option value="Выберите категорию...">Выберите категорию...</option>
			<option value="Верх">Верх</option>
			<option value="Низ">Низ</option>
			<option value="Костюм">Костюм</option>
			<option value="Верхняя одежда">Верхняя одежда</option>
			<option value="Обувь">Обувь</option>
			<option value="Головной убор">Головной убор</option>
			<option value="Аксессуар">Аксессуар</option>
		</select>
		<select name="type">
			<option value="Выберите стиль...">Выберите стиль...</option>
			<option value="Повседневный стиль">Повседневный стиль</option>
			<option value="Официальный/вечерний стиль">Официальный/вечерний стиль</option>
			<option value="Деловой стиль">Деловой стиль</option>
			<option value="Спортивный стиль">Спортивный стиль</option>
		</select>
		</div>';
	}

	if (isset($_GET['type']) && isset($_GET['category'])) {
		$type = $_GET['type'];
		$category = $_GET['category'];
		display_image_by_parameters("type", "category", $type, $category);
	}
	if (isset($_GET['category']) && !isset($_GET['type'])) {
		$category = $_GET['category'];
		display_image_by_parameter("category", $category);
	}
	if (isset($_GET['type']) && !isset($_GET['category'])) {
		$type = $_GET['type'];
		display_image_by_parameter("type", $type);
	}
	if(count($_GET) == 0){
		display_image();
	}
?>