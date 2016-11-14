<!DOCTYPE html>
<html>
	<head>
		<title>Отправка изображения на сервер</title>
		<link rel="stylesheet" type="text/css" href="upload_image.css">
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="js/load_picture.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	 				<span>Выберите стиль одежды:</span>
	 				<div class="check_clother border_none_bottom">
		 				<input type="checkbox" id="check1" name="check_list[]" value="Повседневный стиль">Повседневный стиль<br />
		 				<input type="checkbox" id="check2" name="check_list[]" value="Официальный/вечерний стиль">Официальный/вечерний стиль<br />
	 				</div>
	 				<div class="check_clother border_none_top">
	 					<input type="checkbox" id="check3" name="check_list[]" value="Деловой стиль">Деловой стиль<br />
		 				<input type="checkbox" id="check4" name="check_list[]" value="Спортивный стиль">Спортивный стиль<br />
		 			</div>
		   		</div>

		   		<div class="row_upload_image">
		   			<span>Выберите категорию одежды:</span>
		   			<select name="category">
  						<option value="Верх" selected>Верх</option>
  						<option value="Низ">Низ</option>
  						<option value="Костюм">Костюм</option>
  						<option value="Верхняя одежда">Верхняя одежда</option>
  						<option value="Обувь">Обувь</option>
  						<option value="Головной убор">Головной убор</option>
  						<option value="Аксессуар">Аксессуар</option>
					</select>
				</div>

		   		<div class="row_upload_image">
	 				<span>Температура:</span>
				 		<input type="number" id="min_temperature" placeholder="Min" name="min_temperature">
				 		<input type="number" id="max_temperature" placeholder="Max" name="max_temperature">
		   		</div>

			<input id="send_data_display" value="Отправить" type="button" onclick="shm.checkInbutByEmpty()">
		   	<input type="submit" name="submit" id="send_data" value="Отправить">
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
	 				$category = $_POST['category'];

	 				$info =  pathinfo($_FILES['image']['name']);
					$ext = $info['extension']; // get the extension of the file
					$file_name = rus2translit($info["filename"]);
					$newname = $file_name.".".$ext; 
					$target = 'images/'.$newname;
					$image = $target;
					if(move_uploaded_file( $_FILES['image']['tmp_name'], $target)){
	 				// $image = addslashes($_FILES['image']['tmp_name']);
	 				// $image = file_get_contents($image);
	 				// $image = base64_encode($image);
	 					if (!empty($_POST["check_list"])) {
	 						$array_type = array();
	 						foreach($_POST['check_list'] as $type) {
	 							array_push($array_type, $type);
	 						}
	 						$string_type = implode(",", $array_type);
	 					}

	 				save_image($name, $description, $string_type, $category, $min_t, $max_t, $image);
	 				} else {
	 					echo "<br /> Not downloaded";
	 				}
	 			}
	 		}
	 		
	 		function save_image($name, $description, $string_type, $category, $min_t, $max_t, $image) {
	 			$connect = mysql_connect("localhost", "root", "");
	 			mysql_select_db("new_database", $connect);
	 			$save = "INSERT into images (name, description, type, category, min_temperature, max_temperature, image) VALUES ('$name', '$description', '$string_type', '$category', '$min_t', '$max_t', '$image')";
	 				$result = mysql_query($save, $connect);
	 			if($result) {
	 				echo "<br /> Изображение добавлено";
	 				header('location: http://'.$_SERVER['HTTP_HOST'].'/uploadimg/Load_picture.php');
	 				exit();
	 			} else {
	 				echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 			}
	 			mysql_close($connect);
			}

			function rus2translit($string) {
			    $converter = array(
			        'а' => 'a',   'б' => 'b',   'в' => 'v',
			        'г' => 'g',   'д' => 'd',   'е' => 'e',
			        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			        'и' => 'i',   'й' => 'y',   'к' => 'k',
			        'л' => 'l',   'м' => 'm',   'н' => 'n',
			        'о' => 'o',   'п' => 'p',   'р' => 'r',
			        'с' => 's',   'т' => 't',   'у' => 'u',
			        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			        'ь' => '`',   'ы' => 'y',   'ъ' => '`',
			        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			        
			        'А' => 'A',   'Б' => 'B',   'В' => 'V',
			        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			        'О' => 'O',   'П' => 'P',   'Р' => 'R',
			        'С' => 'S',   'Т' => 'T',   'У' => 'U',
			        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			        'Ь' => '`',   'Ы' => 'Y',   'Ъ' => '`',
			        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			    );
		    return strtr($string, $converter);
		}
	 	?>

	 </body>
</html>