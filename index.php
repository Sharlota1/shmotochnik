<?php session_start();
?>

<html>
	<head>
		<title>Шмоточник</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	<body>

			<div id="wrapper">
 <div class="profile">
                    <a href="dashboard.php" accesskey="2" title="">
                        <?php 
                        echo $_SESSION["login"];
                        ?>
                    </a>

                </div>
					<nav id="nav">
						<a href="#me"><span>Home</span>Home</a>
						<a href="#login"><span>Log In</span>Log In</a>
						<a href="#signup"><span>Sign Up</span>Sign Up</a>
					</nav>

					<div id="main">

							<article id="me" class="panel">
								<header>
									<h1>Шмоточник</h1>
									<p>Ваш персональный помощник</p>
								</header>	
							</article>

							<article id="login" class="panel">
								<header>
									<h1>Log In</h1>
								</header>
								<form action="testreg.php" method="post">
												<input type="text" name="login" placeholder="login" /><br>
												<input type="password" name="password" placeholder="password" /><br>
												<input type="submit" name="submit" value="Log in" />
											
								</form>
							</article>					
						
							<article id="signup" class="panel">
								<header>
									<h1>Sign Up</h1>
								</header>
								<form action="save_user.php" method="post" enctype="multipart/form-data">
												<input type="text" name="login" placeholder="login" /><br>
												<input type="text" name="email" placeholder="Email" /><br>
												<input type="password" name="password" placeholder="password" /><br>
												<input type="FILE" name="fupload"><br>
												<input type="submit" name="submit" value="Sign up" />
								</form>
							</article>	
							

					</div>
                   
					<div id="footer">
						<ul class="copyright">
							<li>Шмоточник</li><li>Дизайн: девчата</li>
						</ul>
					</div>

			</div>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>