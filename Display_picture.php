<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/show_image.css">
		<link rel="stylesheet" type="text/css" href="css/popup_window.css">
		<link rel="stylesheet" type="text/css" href="css/upload_image.css">

		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="js/popup_window.js"></script>
		<script type="text/javascript" src="js/load_picture.js"></script>


	</head>
	<body>

<?php


if (isset($_GET['id_del'])) {
	$connect = mysql_connect("localhost", "root", "");
	mysql_select_db("new_database", $connect);
	$del_id = $_GET["id_del"];
	$display = "SELECT * FROM images WHERE id=$del_id";
	$result_for_get = mysql_query($display, $connect);
	$res = mysql_fetch_array ($result_for_get);
	$filename = $res['image'];
	 if (file_exists($filename)) {
    	unlink($filename);
  	} 
	$sql = "DELETE FROM images WHERE id='$del_id'";
	$result = mysql_query($sql, $connect);
	if ($result) {
	    header('Location: Display_picture.php');
	} else {
	    echo "Error deleting record: " . mysql_error($conn);
	}
 }

function display_image_by_parameter($parameters, $value) {
		$connect = mysql_connect("localhost", "root", "");
	 	mysql_select_db("new_database", $connect);
	 	if ($parameters == "type") {
	 		$display = "SELECT * FROM type_of_clother WHERE value_type=$value";
	 		$result = mysql_query($display, $connect);
	 		getFilter();
	 		if(mysql_num_rows($result) > 0)
			{			
	 			while($row_type = mysql_fetch_array($result)) {
	 				$id_images = $row_type['id_images'];
	 				$display = "SELECT * FROM images WHERE id = '$id_images'";
	 				$result_images = mysql_query($display, $connect);
	 				if(mysql_num_rows($result_images) > 0)
					{
	 					$row = mysql_fetch_array($result_images);
	 					$id = $row['id'];
				 		echo '<div class="block_for_image">
						<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$row['type'].'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
		 				<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$row['type'].'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
		 				<div class="display_image"><img src="'.$row['image'].' "></div>
		 				<div class="display_details">
		 				<span>'.$row['name'].'</span>
		 			</div>
			 		</div></div>';
	 				}
	 			}
	 		}
	 	} else {
	 		$display = "SELECT * FROM images WHERE $parameters=$value";
	 		$result = mysql_query($display, $connect);
	 		getFilter();
			if(mysql_num_rows($result) > 0)
			{			
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
		 			</div></div>';
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
	function display_image_by_parameters($parameters1, $parameters2, $value1, $value2) {
		$connect = mysql_connect("localhost", "root", "");
	 	mysql_select_db("new_database", $connect);
	 	$display = "SELECT * FROM type_of_clother WHERE value_type=$value1";
	 	$result = mysql_query($display, $connect);
	 	getFilter();
		if(mysql_num_rows($result) > 0)
		{			
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
	 				if(mysql_num_rows($result_images) > 0)
					{

	 					$row = mysql_fetch_array($result_images);
	 		echo '<div class="block_for_image">
					<div class="toolbar"><img onclick="edit_element(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')" class="icon" src="icon/edit.png"/><a href="Display_picture.php?id_del='.$id.'"><img class="icon" src="icon/delete.png"></a></div>
	 		<div class="display_element" onclick="display_elemnt(\''.$row['name'].'\',\''.$row['description'].'\', \''.$row['image'].'\', \''.$string_type.'\', \''.$row['category'].'\', \''.$row['min_temperature'].'\', \''.$row['max_temperature'].'\')">
	 		<div class="display_image"><img src="'.$row['image'].' "></div>
	 			<div class="display_details">
	 				<span>'.$row['name'].'</span>
	 			</div>
	 		</div></div>';
	 	}
	 	}
	 }
		mysql_close($connect);
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

	function display_image() {

		$connect = mysql_connect("localhost", "root", "");
	 	mysql_select_db("new_database", $connect);
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
	 		</div></div>';
	 	}
		
		mysql_close($connect);
	}
	if(count($_GET) == 0){
		display_image();
	}
	if(isset($_POST['submit'])) {
		$id = $_POST["id"];
		echo $id;
		$name = $_POST["name_clother"];
		$description = $_POST["description_clother"];
		$min_t = $_POST["min_temperature"];
		$max_t = $_POST["max_temperature"];
		$category = $_POST['category'];
 		if (!empty($_POST["check_list"])) {
 			$array_type = array();
 				foreach($_POST['check_list'] as $type) {
 					array_push($array_type, $type);
 				}
 				$string_type = implode(", ", $array_type);
 			}
			update_image($name, $description, $string_type, $category, $min_t, $max_t, $id);
		}
	 	function update_image($name, $description, $string_type, $category, $min_t, $max_t, $id) {
	 		$connect = mysql_connect("localhost", "root", "");
	 		mysql_select_db("new_database", $connect);
	 		$save = "UPDATE images SET name='$name', description='$description', type='$string_type', category='$category', min_temperature='$min_t', max_temperature='$max_t' WHERE id=$id";
	 			$result = mysql_query($save, $connect);
	 			echo $save;
	 			if($result) {
	   				header('Location: Display_picture.php');
	 				exit();
	 			} else {
	 				echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 			}
	 			mysql_close($connect);
			}
?>

</body>
</html>