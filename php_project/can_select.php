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
				$p = "password";
				$dbname = "project";
				
				$conn = mysqli_connect("localhost","root","",$dbname);
				
				session_start();
				$username=$_SESSION['user_name'];
				$password=$_SESSION['pass_word'];
				$ele_code=$_SESSION['selcode'];
				$err='';
				$sql="select DISTINCT can_no from candidates where ele_code='$ele_code'";
				$resultq=mysqli_query($conn,$sql);
				$resultq2=mysqli_query($conn,$sql);
				if($_SERVER['REQUEST_METHOD']=='POST')
				{	
					$can_code=$_POST['can'];
					$sql1=mysqli_query($conn,"select `can_name`,`can_age`,`can_other` from candidates where `ele_code`='$ele_code' AND can_id='$can_code'");
					$row=mysqli_fetch_array($sql1);
					
					$vote=$_POST['vote'];
					$query2=mysqli_query($conn,"select `can_name` from `candidates` where can_id='$vote'");
					$row2=mysqlI_fetch_array($query2);
					$query="select `vote_id` from `vote` where `ele_code`='$ele_code'";
					$result=mysqli_query($conn,$query);
					$row3=mysqli_fetch_array($result);
					$can_name=$row2['can_name'];
					$vote_id=$row3['vote_id'];
				
						if(isset($_POST['submit']))
						{
								
							$query3 = "UPDATE `vote` SET `can_name`='$can_name',`can_code`='$vote' where `user_name`='$username' AND `password`='$password'";
							$Result=mysqli_query($conn,$query3);
							if($Result)
							{
								echo "<script>location.href='log-out.php'</script>";
							}
							else
							{
								
								$err= "your vote is not entered";
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
							<b>SELECT YOUR CANDIDATE:</b>
							
								<select name="can" id="can">
									<?php while($row1 = mysqli_fetch_array($resultq)):;?>
									<option name="can"><?php if(isset($row1[0])){echo $row1[0];}?></option>
									<?php endwhile; ?>
								</select>
								<br>
								<br>
							<B>CANDIDATE DETAILS:</B><button name="refresh" value="refresh">REFRESH</button>
							<br>
							<br>
							<b>NAME:</b><input type="text" name="can_name" value="<?php if(isset($row)){echo $row['can_name'];}else{echo "-";} ?>">
							<b>AGE:</b><input type="text" name="can_age" value="<?php if(isset($row)){echo $row['can_age'];}else{echo "-";}; ?>">
							<b>OTHER DETAILS:</b><input type="text" name="can_other" value="<?php if(isset($row)){echo $row['can_other'];}else{echo "-";} ?>">
							<br>
							<br>
							<b>SELECT YOUR VOTE:</b>
								<select name="vote" id="vote">
									<?php while($row1 = mysqli_fetch_array($resultq2)):;?>
									<option name="vote"><?php if(isset($row1[0])){echo $row1[0];}?></option>
									<?php endwhile; ?>
								</select><br>
								<br>
							<input type="submit" value="SUBMIT" name="submit"><?php if(isset($err)){echo $err;} ?>
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