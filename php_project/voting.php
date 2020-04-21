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
				
				$query1="select DISTINCT ele_code from candidates";
				$result1= mysqli_query($conn,$query1);
				
				
				if(isset($_POST['submit']))
				{
					if(isset($_POST['selcode']))
					{
						session_start();
						$selcode=$_POST['selcode'];
						$ele_code=$_POST['selcode'];
						$user_name=$_SESSION['user_name'];
						$password=$_SESSION['pass_word'];
						$_SESSION['selcode']=$_POST['selcode'];
						$check="select user_name from vote where user_name='$user_name' AND ele_code='$ele_code'";
						$res=mysqli_query($conn,$check);
						$count=mysqli_num_rows($res);
						if($count>0)
						{
							$err="YOU HAVE ALREADY VOTED";
						}
						else{
							if(isset($_SESSION['selcode']))
							{
								if(isset($ele_code))
								{
									$query="insert into vote(ele_code,user_name,password) values ('$ele_code','$user_name','$password')";
									$result= mysqli_query($conn,$query);
									$err='';
									if(isset($_SESSION['selcode']))
									{
										echo "<script>location.href='can_select.php'</script>";
									}
									
								}
								else
								{
									echo "<script>location.href='voting.php'</script>";
								}
							}
						}
					}
				}
				
			mysqli_close($conn);
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
						<h1> GENERAL VOTING SCHEAME</h1>
							<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<b>SELECT ELECTION CODE:</b>	
									<select name="selcode" id="selcode" index="selcode">
										<?php while($row1 = mysqli_fetch_array($result1)):;?>
											<option name="selcode"><?php if(isset($row1[0])){echo $row1[0];}?></option>
										<?php endwhile; ?>
									</select>
								<br>
								<br>
								<input type="submit" value="SUBMIT" name="submit"><?php if(isset($err)){echo $err;}?>
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