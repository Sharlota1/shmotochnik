<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="show_image.css">
	</head>
	<body>
<?php
	function display_image() {
		$connect = mysql_connect("localhost", "root", "");
	 	mysql_select_db("new_database", $connect);
	 	$display = "SELECT * FROM images";
	 	$result = mysql_query($display, $connect);

	 	while($row = mysql_fetch_array($result)) {////data:image/*;base64,
	 		echo '<div class="display_element">
	 		<div class="display_image"><img src="'.$row['image'].' "></div>
	 			<div class="display_details">
	 				<span>'.$row['name'].'</span>
	 			</div>
	 		</div>';
	 	}
		
		mysql_close($connect);
	}

	display_image();
?>
</body>
</html>