<?php session_start(); ?>
<html>
	<head>
		<title>Шмоточник</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/upload_image.css">
		<link rel="stylesheet" type="text/css" href="assets/css/show_image.css">
		<link rel="stylesheet" type="text/css" href="assets/css/popup_window.css">

		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/load_picture.js"></script>
		<script type="text/javascript" src="assets/js/popup_window.js"></script>
		<script type="text/javascript" src="assets/js/skel.min.js"></script>
		<script type="text/javascript" src="assets/js/skel-viewport.min.js"></script>
		<script type="text/javascript" src="assets/js/util.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</head>
	
	<body>
		<div id="wrapper">
			<a href="index.php">Exit</a>
	        <nav id="nav">
				<a href="#me"><span>Home</span>Home</a>
				<a href="#load"><span>Load</span>Load</a>
				<a href="#setting"><span>Setting</span>Setting</a>
			</nav>
					
			<div id="main">
				<article id="me" class="panel">
					<header>
						<h1>Welcome</h1>
					</header>	
				</article>

				<article id="load" class="panel">
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
	 				<?php include("save_image.php"); ?>
				</article>
							
				<article id="setting" class="panel">
					<?php include("display_image.php"); ?>
				</article>
			</div>
                   
			<div id="footer">
				<ul class="copyright">
					<li>Шмоточник</li><li>Дизайн: девчата</li>
				</ul>
			</div>
		</div>
	</body>
</html>