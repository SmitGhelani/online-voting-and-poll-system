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
				$conn=mysqli_connect("localhost","root","","project") or die("connection failed");
				
				if(isset($_POST['submit']))
				{	
					$name=$_POST['name'];
					$email=$_POST['email'];
					$sub=$_POST['subject'];
					$comment=$_POST['comment'];
					if(isset($name) && isset($email) && isset($sub) && isset($comment))
					{
						$query=mysqli_query($conn,"insert into complaint(name,email,subject,complaint) values('$name','$email','$sub','$comment')");
					}
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
		<div class="clear"> </div>
		<div class="content">
			<div class="cut">
				<div class="about">
					<div class="about-grids">
						<form method="POST">
							<h1>COMPLAINT</h1>
							<br><br>
							NAME:<br><input type="text" name="name" required><br><br>
							EMAIL:<br><input type="text" name="email" required><br><br>
							SUBJECT:<br><input type="text" name="subject" required><br><br>
							COMMENT:<br><textarea name="comment" rows="4" cols="17"></textarea><br><br> 
							<input type="submit" value="submit" name="submit">
						</form>
					</div>
				</div>
				<div class="boxs">
					<div class="cut">
						<div class="box center-box">
							<ul>
								<li><a href="feedback.php">Leave a Feedback</a></li>
								<li><a href="complaint.php">Complaint</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>