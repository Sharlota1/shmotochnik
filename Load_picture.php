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
	 				<span>Введите описание одежды:</span>
			 		<textarea id="description_clother" placeholder="Description"></textarea>
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Выберите тип одежды:</span>
	 				<div class="check_clother">
		 				<input type="checkbox">Домашняя одежда<br />
		 				<input type="checkbox">Парадная одежда<br />
	 				</div>
	 				<div class="check_clother">
	 					<input type="checkbox">Спортивная одежда<br />
		 				<input type="checkbox">Повседневная одежда<br />
		 			</div>
		   		</div>

		   		<div class="row_upload_image">
	 				<span>Температура:</span>
				 		<input type="number" id="min_temperature" placeholder="min">
				 		<input type="number" id="max_temperature" placeholder="max">
		   		</div>

		   	<input type="submit" name="submit" value="Отправить">
	   		</div>
	 	</form>

	 	<?php
	 		/*if(isset($_POST['submit'])) {
	 			if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
	 				echo "Пожалуйста, выберите изображение!";
	 			} else {
	 				$image = addslashes($_FILES['image']['tmp_name']);
	 				$name = addslashes($_FILES['image']['name']);
	 				$image = file_get_contents($image);
	 				$image = base64_encode($image);
	 				save_image($name, $image);
	 			}
	 		}

	 		function save_image($name, $image) {
	 			$connect = mysql_connect("localhost", "root", "");
	 			mysql_select_db("new_database", $connect);
	 			$save = "INSERT into images (name, image) VALUES ('$name', '$image')";
	 			$result = mysql_query($save, $connect);
	 			if($result) {
	 				echo "<br /> Изображение добавлено";
	 			} else {
	 				echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 			}
	 		}*/
	 	?>
	 </body>
</html>