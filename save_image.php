<?php
	session_start();
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
			$ext = $info['extension'];
			$file_name = rus2translit($info["filename"]);
			$newname = $file_name.".".$ext; 
			$target = 'images/'.$newname;
			$image = $target;
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
	 			save_image($name, $description, $category, $min_t, $max_t, $image);
	 		} else {
	 			echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 		}
	 	}
	}
	 		
	function save_image($name, $description, $category, $min_t, $max_t, $image) {
	 	include ("bd.php");
	 	$save = "INSERT into images (name, description, category, min_temperature, max_temperature, image) VALUES ('$name', '$description', '$category', '$min_t', '$max_t', '$image')";
	 	$result = mysql_query($save, $connect);
	 	if($result) {
	 		$id = mysql_insert_id();
	 		if (!empty($_POST["check_list"])) {
	 			$array_type = array();
	 			foreach($_POST['check_list'] as $type) {
	 				$save_type = "INSERT into type_of_clother (id_images, value_type) VALUES ('$id', '$type')";
	 				$result_type = mysql_query($save_type, $connect);
 				}
	 		}
	 		header('location: http://'.$_SERVER['HTTP_HOST'].'/dashboard.php#load');
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