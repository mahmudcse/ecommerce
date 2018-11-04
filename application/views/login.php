<html>

	<head>

	 	<link href="<?php echo base_url(). "assets/css/layout.css"?>" rel="stylesheet" type="text/css">	

		<title>Login Page</title>

	</head>



	<body class="loginbody">



	<div id="loginbox">
		<section id="content">

			<?php echo form_open('login/authenticate');?>

			<h1>Login Form</h1>

			<div style=" padding-left:50px">

				<input type="text" placeholder="Username" required="" id="username" name="username"/>

			</div>

			<div style=" padding-left:50px">

				<input type="password" placeholder="Password" required="" id="password" name="password"/>

			</div>

			<div>

				<input type="submit" value="Log in" name="submit"/>

				<!--<a href="#">Lost your password?</a>

				<a href="#">Register</a>-->

			</div>

			<div class="loginfootercontainer">
				
				<small><strong>Developed By NetSOFT Ltd.(01824412272)</strong></small>

			</div>

		</form><!-- form -->

		

	</section>



		

			<!-- footer start -->

			<div class="loginfootercontainer">

				<!--All content copyright &copy; 2016 NetSoft, all rights reserved.-->

			</div>

			<!-- end of footer -->

	</div> <!-- end of loginbox -->

	</body>

</html>