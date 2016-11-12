<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Отправка изображения на сервер</title>
<link rel="stylesheet" type="text/css" href="upload_image.css">
	</head>

	 <body>
	 	<form enctype="multipart/form-data" method="post">
	 		<div class="upload_image">
	 			<div class="row_upload_image">
	 				<span>Выберите файл с изображением:</span>
			 		<input type="file" name="image" accept="image/*">
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Введите название:</span>
			 		<textarea id="name_clother" placeholder="Name" name="name_clother"></textarea>
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Введите описание одежды:</span>
			 		<textarea id="description_clother" placeholder="Description" name="description_clother"></textarea>
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Выберите тип одежды:</span>
	 				<div class="check_clother">
		 				<input type="checkbox" id="check1" name="check_list[]" value="Домашняя одежда">Домашняя одежда<br />
		 				<input type="checkbox" id="check2" name="check_list[]" value="Парадная одежда">Парадная одежда<br />
	 				</div>
	 				<div class="check_clother">
	 					<input type="checkbox" id="check3" name="check_list[]" value="Спортивная одежда">Спортивная одежда<br />
		 				<input type="checkbox" id="check4" name="check_list[]" value="Повседневная одежда">Повседневная одежда<br />
		 			</div>
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Температура:</span>
				 		<input type="number" id="min_temperature" placeholder="Min" name="min_temperature">
				 		<input type="number" id="max_temperature" placeholder="Max" name="max_temperature">
		   		</div>

		   	<input type="submit" name="submit" value="Отправить">
	   		</div>
	 	</form>

	 	<?php
	 		if(isset($_POST['submit'])) {
	 			if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
	 				echo "Пожалуйста, выберите изображение!";
	 			} else {
	 				$name = $_POST["name_clother"];
	 				$description = $_POST["description_clother"];
	 				$min_t = $_POST["min_temperature"];
	 				$max_t = $_POST["max_temperature"];
	 				$image = addslashes($_FILES['image']['tmp_name']);
	 				$image = file_get_contents($image);
	 				$image = base64_encode($image);
	 					if (!empty($_POST["check_list"])) {
	 						$array_type = array();
	 						foreach($_POST['check_list'] as $type) {
	 							array_push($array_type, $type);
	 						}
	 						$string_type = implode(",", $array_type);
	 					}
	 				save_image($name, $description, $string_type, $min_t, $max_t, $image);
	 			}
	 		}

	 		function save_image($name, $description, $string_type, $min_t, $max_t, $image) {
	 			$connect = mysql_connect("localhost", "root", "");
	 			mysql_select_db("new_database", $connect);
	 			$save = "INSERT into images (name, description, type, min_temperature, max_temperature, image) VALUES ('$name', '$description', '$string_type', '$min_t', '$max_t', '$image')";
	 			$result = mysql_query($save, $connect);
	 			if($result) {
	 				echo "<br /> Изображение добавлено";
	 				exit();
	 			} else {
	 				echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 			}
	 		}
	 	?>

	 </body>
</html>