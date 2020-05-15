<?php
	session_start();
	$emptyErr=$invalidErr="";
	if(isset($_COOKIE['username'])){  
		header("location: home.php");
	}
	if(isset($_REQUEST['submit'])){
		$uname = $_REQUEST['uname'];
		$pass =  $_REQUEST['pass'];
		if(empty(trim($uname)) || empty(trim($pass))){
			$emptyErr = "User name and Password is required";
		}else{
		    $file = fopen('user.txt', 'r');
			while(!feof($file))  {
				$user = fgets($file);
				$data = explode('|', $user);
				if(trim($data[0]) == $uname && trim($data[1]) == $pass){
				$_SESSION['uname'] = $uname;
				$_SESSION['pass'] = $pass; 
				setcookie('username', $uname, time()+3600, '/');
				header("location: home.php");
				}
			}
				$invalidErr="invalid user name or password";
		}
	}
?> 

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<style>
	.error {color: #FF0000;}
	</style>
</head>
<body>
	<center><h1>Login to Explore Hundreds of Food Items & Order Them at  The Best Price !</h1></center>
	<table>
		<tr>
		<td width="50%">
		<center>
		<form method="POST" action="login.php">
			<span class="error"><?php echo $emptyErr;?></span>
			<span class="error"><?php echo $invalidErr;?></span>
			<table>
				<tr>
					<td><b>User ID</b></td>
					<td><b>: </b><input type="text" name="uname" placeholder="Enter user id" ></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td><b>Password</b></td>
					<td><b>: </b><input type="password" name="pass"  placeholder="Enter password"></td>
				</tr>
				<tr><td><br></td></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Login"></td>
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2" align="center"><a href="registration.php">Create a new account!</a></td>
				</tr>
			</table>
		</form>
		</center>
		</td>
		<td width = "50%">
				<img src="login.jpg" alt="login" height="80%" width="100%">
		</td>
		</tr>
	</table>
</body>
</html>