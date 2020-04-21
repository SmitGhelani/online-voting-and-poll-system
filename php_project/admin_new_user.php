<html>
	<head>	
		<title>Online Voting System | About</title><link href="css/style.css" rel="stylesheet" type="text/css" media="all">
		<link href="css/style2.css" rel="stylesheet" type="text/css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/navigation.css" rel="stylesheet" type="text/css">
 		<link href="css/bottom.css" rel="stylesheet" type="text/css"></head>
		<style>
			.error {color: #FF0000;}
			.sucess{color:green;}
		</style>
		<?php
			$servername = "localhost";
			$usrnm = "username";
			$pwd = "password";
			$dbname = "project";
			
			$conn = mysqli_connect("localhost","root","",$dbname);
			$unameerr=$adderr=$passerr=$rpasserr=$ageerr=$phoneerr=$gendererr=$emailerr=$succ=$err="";
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$uname=$_POST['username'];
				$age=$_POST['age'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$add=$_POST['add'];
				$pass=$_POST['password'];
				$rpass=$_POST['r_password'];
				$gender=$_POST['gender'];
				$unameerr=$adderr=$passerr=$rpasserr=$ageerr=$phoneerr=$gendererr=$emailerr="";
			
				if($uname!='' && preg_match("/^[a-zA-Z]*$/",$uname))
				{
					$clone=mysqli_query($conn,"select `admin_name` from admin_data");
					$row=mysqli_fetch_array($clone);
					$n=mysqli_num_rows($clone);
					for($i=0;$i<$n;$i++)
					{
						if($row[$i]==$uname)
						{
							$unameerr="THIS USERNAME IS ALREADY EXIST!!!";
							$uname="";
						}
					}
				}
				else
				{
					$unameerr="*please enter valid username<br>";
				}
				if($age != '' && $age >=18 && $age<=100)
				{
					
				}
				else{
					$ageerr="*please your age in between 18 to 100<br>";
				}
				if($phone != '' && preg_match('/^[0-9]{10}$/',$phone))
				{
					$clone1=mysqli_query($conn,"select `phone` from admin_data");
					$row1=mysqli_fetch_array($clone1);
					$n1=mysqli_num_rows($clone1);
					for($i=0;$i<$n1;$i++)
					{
						if($row1[$i]==$phone)
						{
							$phoneerr="THIS PHONE NO. IS ALREADY ENTERED BY SOMEONE!!!";
							$phone="";
						}
					}
				}
				else{
					$phoneerr="*please enter valid phone number<br>";
				}
				if($email != '' && filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$clone2=mysqli_query($conn,"select `email` from admin_data");
					$row2=mysqli_fetch_array($clone2);
					$n2=mysqli_num_rows($clone2);
					for($i=0;$i<$n2;$i++)
					{
						if($row2[$i]==$email)
						{
							$emailerr="THIS EMAIL-ID IS ALREADY ENTERED BY SOMEONE!!!";
							$email="";
						}
					}
				}
				else{
					$emailerr="*please enter valid email-id<br>";
				}
				if($add != '')
				{
					
				}
				else{
					$adderr="*please enter address<br>";
				}
				if($pass != '')
				{
					
					if($rpass != '')
					{
						
						if($rpass==$pass)
						{
						}
						else
						{
							$rpasserr="*both password are different<br>";
						}
					}
					else{
						$rpasserr="*please repeat your password<br>";
					}
				}
				else{
					$passerr= "*please enter password<br>";
					if($rpass != '')
					{
					}
					else{
						$rpasserr="*please repeat your password<br>";
					}
				}
				$query="";
				if($uname != '' && preg_match("/^[a-zA-Z]*$/",$uname) && $age != '' && $age >=18 && $age<=100 && $phone != '' && preg_match('/^[0-9]{10}$/',$phone) && $email != '' && filter_var($email,FILTER_VALIDATE_EMAIL) && $add != '' && $pass != '' && $rpass != '' && $rpass==$pass)
				{
					$query="INSERT INTO `admin_data`(`admin_name`, `age`, `phone`, `email`, `gender`, `address`, `password`) VALUES ('$uname','$age','$phone','$email','$gender','$add','$pass');";
					
					if(mysqli_query($conn, $query))
					{
					
						session_start();
						$_SESSION['password']=$_POST['password'];
						$_SESSION['username']=$_POST['username'];
						if(isset($_SESSION['username']) && isset($_SESSION['password']))
						{
							echo "<script>location.href='gen_poll.php'</script>";
						}
						else
						{
							echo "<script>location.href='admin.html'</script>";
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
						<h1>NEW ADMIN REGISTRATION</h1>
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<table>
								<tr>
									<th>USER NAME:</th>
									<td><input name="username" autocomplete="off"><span class="error"><?php echo $unameerr; ?></span></td>
								</tr>
								<tr>
									<th>CURRENT ADDRESS:</th>
									<td><textarea cols="15" rows="3" name="add" autocomplete="off"></textarea><span class="error"><?php echo $adderr; ?></span></td>
								</tr>
								<tr>
									<th>EMAIL ADDRESS:</th>
									<td><input name="email"  autocomplete="off"><span class="error"><?php echo $emailerr; ?></span></td>
								</tr>
								<tr>
									<th>CREATE PASSWORD:</th>
									<td><input name="password" type="password" ><span class="error"><?php echo $passerr; ?></span></td>
								</tr>
								<tr>
									<th>REPEAT PASSWORD:</th>
									<td><input name="r_password" type="password" ><span class="error"><?php echo $rpasserr; ?></span></td>
								</tr>
								<tr>
									<th>PHONE NO:</th>
									<td><input name="phone" autocomplete="off"><span class="error"><?php echo $phoneerr; ?></span></td>
								</tr>
								<tr>
									<th>AGE:</th>
									<td><input name="age" autocomplete="off"><span class="error"><?php echo $ageerr; ?></span></td>
								</tr>
								<tr>
									<th>GENDER:</th>
									<td><input checked="checked" name="gender" value="male" type="radio">MALE </td>
									<td><input name="gender" value="female" type="radio" >FEMALE<span class="error"><?php echo $gendererr; ?></span></td>
								</tr>
								<tr>
									<td><input name="submit" value="SUBMIT" type="submit"></td>
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