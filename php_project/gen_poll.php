<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
	$admin_name=$_SESSION['username'];
	$password=$_SESSION['password'];
}
else
{
	echo "<script>location.href='admin.php'</script>";
}
	$output=NULL;


	if(isset($_POST['submit']))
	{
		$mysqli= NEW mysqli('localhost','root','','project');
		$can_name=$_POST['can_name'];
		$can_age=$_POST['can_age'];
		$can_det=$_POST['can_det'];
		$ele_name=$_POST['ele_name'];
		$ele_code=$_POST['ele_code'];
		if(isset($ele_code))
		{
			$check=mysqli_query($mysqli,"select `ele_code` from `candidates` where `ele_code`='$ele_code'");
			$n=mysqli_num_rows($check);
		}
	if($n==0)
	{
		foreach($can_name AS $key=>$value){
		$query="SELECT can_id FROM candidates where can_name = '" . $mysqli->real_escape_string($can_det[$key]) . "' LIMIT 6";
		
		$resultSet = $mysqli->query($query);
			$val=$key+1;
			if($resultSet->num_rows == 0)
			{
				
				$query = "insert into candidates(admin_name,ele_name,ele_code,can_name,can_age,can_other,ad_pass,can_no) 
				VALUES ('$admin_name','$ele_name','$ele_code','"
				.	$mysqli->real_escape_string($value) .
				"','"
				.	$mysqli->real_escape_string($can_age[$key]) .
				"','"
				.	$mysqli->real_escape_string($can_det[$key]) .
				"','$password','$val')
				";
				
				$insert = $mysqli->query($query);
				
				if(!$insert)
				{
					echo $mysqli->error;
				}
				else
				{
					
					echo "<script>location.href='ad_logout.php'</script>";
				}
			}
			else
			{
				$output .= "please enter valid candidate $val data."."<br>".$mysqli->error;
			}
		}
	}
	else
	{
		$eleerr="THIS ELECTION CODE IS ALREADY EXIST";
	}
	$mysqli->close();
	}
?>
<html>
	<head>
		<title>Online Voting System | About</title><link href="css/style.css" rel="stylesheet" type="text/css" media="all">
		<link href="css/style2.css" rel="stylesheet" type="text/css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/navigation.css" rel="stylesheet" type="text/css">
 		<link href="css/bottom.css" rel="stylesheet" type="text/css">
			<style>
				.error {color: #FF0000;}
			</style>
			<script src="js/google_jquery.js"></script>
			<script>
			$(document).ready(function(e){
				//variables
				var html='<p /><div><b>CANDIDATE NAME:</b> <input type="TEXT" name="can_name[]" id="childcan_name" autocomplete="off" /> <b> CANDIDATE AGE:</b> <input type="TEXT" name="can_age[]" id="childcan_age" autocomplete="off" /> <b>OTHER DETAILS:</b> <textarea rows="3" cols="17" name="can_det[]" id="childcan_det" autocomplete="off"></textarea><a href="#" id="remove">REMOVE</a><div>';
				var maxRows = 5;
				var x = 1;
				//add rows to the form 
				$("#add").click(function(e){
					if(x <= maxRows){
					$("#con").append(html);
					x++;
					}
				});
				//remove rows from the form
				$("#con").on('click','#remove',function(e){
					$(this).parent('div').remove();
					x--;
				});
			});
			</script>
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
						<h1>GENERATE THE POLL</h1>
						<form method="POST">
							<div id="con">
								<b>NAME OF ELECTION:</b> <input name="ele_name" type="text"  autocomplete="off">
								<br><br>
								<b>ELECTION CODE:</b> <input type="text" name="ele_code"  autocomplete="off"><span class="error"><?php if(isset($eleerr)){echo $eleerr;} ?></span>
								<br><br>
								<b>CANDIDATE NAME:</b> <input type="TEXT" name="can_name[0]" id="make" autocomplete="off" />
								<b>CANDIDATE AGE:</b> <input type="TEXT" name="can_age[0]" id="model" autocomplete="off" />
								<b>OTHER DETAILS:</b> <textarea rows="3" cols="17" name="can_det[0]" id="serial" autocomplete="off"></textarea><br><br>
								<b>CANDIDATE NAME:</b> <input type="TEXT" name="can_name[]" id="make" autocomplete="off" />
								<b>CANDIDATE AGE:</b> <input type="TEXT" name="can_age[]" id="model" autocomplete="off" />
								<b>OTHER DETAILS:</b> <textarea rows="3" cols="17" name="can_det[]" id="serial" autocomplete="off"></textarea>
								<a href="#" id="add">ADD CANDIDATE</a><br>					
							</div>
							<p />
							<input type="SUBMIT" name="submit" /><span class="error"><?php echo "<br>".$output;?></span>
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