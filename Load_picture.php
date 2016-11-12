<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Отправка изображения на сервер</title>
	</head>

	 <body>
	 	<form enctype="multipart/form-data" method="post">
	 		<p>Загрузите ваши фотографии на сервер</p>
	 		<p><input type="file" name="image" accept="image/*">
   			<input type="submit" name="submit" value="Отправить"></p>
	 	</form>

	 	<?php
	 		if(isset($_POST['submit'])) {
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
	 		}
	 	?>
	 </body>
</html>