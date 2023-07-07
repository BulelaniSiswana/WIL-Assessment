<?php
$servername = "localhost";
$username = "karipose";
$password = "@Cr@b05696**";
$dbname = "blabbr";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
	echo "connection to server failed.<br /> Our severs are down. <br /> Please try again in 15 minutes.";
}
?>
<?php
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password  = md5($_POST['password']);
		$sql = "SELECT * FROM usertable WHERE username='$username' AND password = '$password' ";
		$result = $conn->query($sql);
		$row = $result->fetch_array(MYSQLI_BOTH);	
		session_start();
		$_SESSION['userID'] = $row['userID'];
		if($result->num_rows==1){
			header('location: profile2.php');
		}else{
			header('location: login.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8" />
<title>Login or Sign up</title>
</head>

<body>
<header>
<h2>Sign In</h2>
<form name="loginform" action="#" method="POST">
<table>
<tr>
<td>
Username
</td>
<td>
<input type="text" name="username" id="username" maxlength="100" />
</td>
</tr>
<tr>
<td>
Password
</td>
<td>
<input type="password" name="password" id="password" maxlength="100" />
</td>
<tr>
<td>&nbsp;</td>
<td>
<input type="submit" name="login" id="login" value="Login" />
</td>
</tr>
<tr>&nbsp;</tr>
</tr>
<tr>
<td>Not already a member? <a href="http://wewash.co.za/signup2.php"><b>Sign Up</b></a></td>
</tr>
</table>
</form>
</header>
</body>
</html>