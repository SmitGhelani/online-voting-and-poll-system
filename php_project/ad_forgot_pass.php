<html>
	<head>
		<title>Online Voting System | About</title><link href="css/style.css" rel="stylesheet" type="text/css" media="all">
		<link href="css/style2.css" rel="stylesheet" type="text/css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/navigation.css" rel="stylesheet" type="text/css">
 		<link href="css/bottom.css" rel="stylesheet" type="text/css"></head>
			<style>
				.error {color: #FF0000;}
			</style>
			<?php
				$servername = "localhost";
				$usrnm = "username";
				$pwd = "password";
				$dbname = "project";
				
				$conn = mysqli_connect("localhost","root","",$dbname);
				$result;
				if(isset($_POST['phone']) && isset($_POST['email']))
				{
					$phone=$_POST['phone'];
					$email=$_POST['email'];
					if(!empty($phone) && !empty($email))
					{
						$sql="select `password` from `admin_data` where `phone`='$phone' AND `email`='$email'";
						$fetch=mysqli_query($conn,$sql);	
						$row=mysqli_fetch_array($fetch);
						$result=$row['password'];
					}
					else
					{
						$result="empty";
					}
				}
				elseif(empty($_POST['phone']) or empty($_POST['email']))
				{
					$result="empty";
				}
				else
				{
					$result="empty";
				}
			?>
	<body>
		<div class="header">
			<div class="cut">
				<div class="header-top">
					<div class="logo">
						<a href="index.html"><img src="images/logo2.png" title="logo"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="cut">
				<div class="about">
					<div class="about-grids">
						<br>
						<br>
						<h1>FORGOT PASSWORD</h1>
						<br><br>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								ENTER YOUR PHONE NO:<input name="phone" type="text" autocomplete="off"><br><br>
								ENTER YOUR E-MAIL:<input name="email" type="text" autocomplete="off"><br><br>
								YOUR PASSWORD:<input name="password" type="text" value="<?php echo $result; ?>">
								<br>
								<br>
								<input type="submit" value="submit" name="submit">
								<a href="index.html">GOTO HOMEPAGE</a>
							</form>
					</div>
				</div>
				<div class="boxs">
					<div class="cut">
						<div class="box center-box">
							<ul>
								<li><a href="">Leave a Feedback</a></li>
								<li><a href="">Complaint</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>