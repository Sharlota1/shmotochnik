<?php
	$connect = mysql_connect("localhost", "root", "");
	mysql_select_db("new_database", $connect);
	$del_id = $_GET['id'];
	$sql = "DELETE FROM images WHERE id='$del_id' ";
	$result = mysql_query($connect, $sql);
	if ($result) {
	    display_image();
	} else {
	    echo "Error deleting record: " . mysql_error($connect);
	}
	mysql_close($connect);
?>