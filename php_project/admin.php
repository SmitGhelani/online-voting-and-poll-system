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
				$connect=mysqli_connect("localhost","root","","project") or die("connection failed");
				$err="";
				if(!empty($_POST['submit']))
				{
					$uname=$_POST['username'];
					$pass=$_POST['password'];
					$query="select * from `admin_data` where `admin_name`='$uname' and `password`='$pass'";
					$result=mysqli_query($connect,$query);
					$count=mysqli_num_rows($result);
					
					session_start();
					$_SESSION['password']=$_POST['password'];
					$_SESSION['username']=$_POST['username'];
					if(isset($_SESSION['username']) && isset($_SESSION['password']))
					{
						if($count >0)
						{
							echo "<script>location.href='gen_poll.php'</script>";
							$err="";
						}
						else
						{
							$err="username and password are incorrect";
						}
					}
					else
					{
						echo "<script>location.href='admin.html'</script>";
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
						<h1>LOGIN</h1>
						<form method="post">
							<table>
								<tr>
									<th>NAME:</th>
									<td><input type="text" name="username" autocomplete="off"></td>
								</tr>
								<tr>
									<th>PASSWORD:</th>
									<td><input type="password" name="password" autocomplete="off"></td>
								</tr>
								<tr>
									<td><input type="submit" name="submit" value="SUBMIT"></td>
									<td><span class="error"><?php echo $err; ?></span></td>
								</tr>
								<tr>
									<td><a href="admin_new_user.php">NEW ADMIN</a></td>
									<td></td>
									<td><a href="ad_forgot_pass.php">FORGOT PASSWORD</a></td>
								</tr>
							</table>
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