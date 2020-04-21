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
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<?php
								$conn=mysqli_connect("localhost","root","","project") or die("connection failed");
								
								session_start();
								$ele_code=$_SESSION['rslt'];
								$sql=mysqli_query($conn,"select `can_no` from candidates where `ele_code`='$ele_code'");
								$n=mysqli_num_rows($sql);	
								$vote=mysqli_query($conn,"select can_name from vote where ele_code='$ele_code'");
								$total=mysqli_num_rows($vote);
								for($i = 1 ; $i <= $n; $i++)
								{
									$p[$i]=$i;
									$query = mysqli_query($conn,"SELECT `vote_id` FROM vote WHERE `ele_code`='$ele_code' AND `can_code`='$i'");
									$n1[$i] = mysqli_num_rows($query);
									$per[$i] = ($n1[$i]*100)/$total;
									
									echo "<br>"."candidate $i has $per[$i] % votes"."<br><br>";
								}
								for($i = 1 ; $i <= $n; $i++)
								{
									$won[$i]=$n1[$i];
								}	
												
								$max=1;
								$won_max=$won[1];
								for($i = 1 ; $i <= $n; $i++)
								{	
									if($n1[$i]>=$n1[$max])
									{
										if($per[$i]>$per[$max])
										{
											
											$max=$i;
											$won_max=$won[$i];
										}
										else
										{
											$max_RSLT="NONE";
											$won_max=$won[$i];
										}
									}
									
								}
								echo "<b>CANDIADTE $max IS WINNER WITH $won_max GOT</b>";
								mysqli_close($conn);
							?>
							<br>
							<br>
							<a href="index.html">GOTO HOMEPAGE</a>
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