<?php
	session_start();
	if (isset($_GET['id_del'])) {
		include ("bd.php");
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
	    	header('Location: /dashboard.php');
		} else {
	    	echo "Error deleting record: " . mysql_error($conn);
		}
 	}


 	if(isset($_POST['submit'])) {
		$id = $_POST["id"];
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

	function update_image($id, $name, $description, $string_type, $category, $min_t, $max_t) {
	 	include ("bd.php");
	 	$save = "UPDATE images SET name='$name', description='$description', type='$string_type', category='$category', min_temperature='$min_t', max_temperature='$max_t' WHERE id=$id";
	 	$result = mysql_query($save, $connect);
	 	if($result) {
	   		header('Location: /dashboard.php');
	 		exit();
	 	} else {
	 		echo "<br /> Ошибка! Изображение не добавлено. Повторите попытку!";
	 	}
	 	mysql_close($connect);
	}
?>