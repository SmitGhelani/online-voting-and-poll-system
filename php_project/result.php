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
				
				$query="SELECT DISTINCT ele_code from candidates";
				$result=mysqli_query($conn,$query);
				
				if(isset($_POST['rslt_ele']))
				{
					session_start();
					$_SESSION['rslt']=$_POST['rslt_ele'];
					if(isset($_POST['submit']))
					{
						echo "<script>location.href='show_rslt.php'</script>";
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
						<h1> RESULT</h1>
						<br>
						<br>
						<form method="post">
							SELECT ELECTION CODE:	
								<select name="rslt_ele" id="rslt_ele">
									<?php while($row1 = mysqli_fetch_array($result)):;?>
									<option name="rslt_ele"><?php if(isset($row1[0])){echo $row1[0];}?></option>
									<?php endwhile; ?>
								</select><br>
								<br>
							<input type="submit" value="SUBMIT" name="submit">
						</form>
					</div>
				</div>
				<div class="boxs">
					<div class="cut">
						<div class="box center-box">
							<ul>
								<li><a href="feedback.php">Leave a Feedback</a></li>
								<li><a href="complaint.php">Complaint</a></li>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>