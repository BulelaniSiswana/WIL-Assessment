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
	if(isset($_POST['newpasswordcon'])){
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$cell = $_POST['cell'];
		$username = $_POST['newusername'];
		$email = md5($_POST["email"]);
		$password  = md5($_POST["newpassword"]);
		$sql = "INSERT INTO usertable (firstname, lastname, username, email, password)
					VALUES ('$fname', '$lname', '$username', '$email', '$password')";		
					
		if($conn->query($sql)===TRUE){
			echo "Signed up successfully!"
			header("location: login.php");
		}else{
			echo "Sorry, there was an error while signing up. <br /> ERROR: ".$conn->error;
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<script>
function confirm_pass(){
	var pass1 = document.getElementById("newpassword").value;
    var pass2 = document.getElementById("newpasswordcon").value;
    var bubble =  document.getElementById("test_pass_con");
    if(pass1 == pass2 && pass2!=""){
		bubble.className="pass_con_msg1";
    	bubble.innerHTML = "Passwords match! &#10004; ";
    }else if(pass1 != pass2){
		bubble.className="pass_con_msg2";
    	bubble.innerHTML = "Passwords don't match! &#10008";
    }else{
		bubble.innerHTML = "";
	}
}

function check_availability(inputId, bubbleId, dataType){
	var choice = document.getElementById(inputId).value;
    var bubble =  document.getElementById(bubbleId);
	var colName = dataType;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			bubble.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","username_test.php?q="+choice+"& colName="+colName,true);
	xmlhttp.send();
}

function submit_form(){
	var pass1 = document.getElementById("newpassword").value;
    var pass2 = document.getElementById("newpasswordcon").value;
	var pass3 = document.getElementById("test_username").innerHTML;
	var pass4 = document.getElementById("test_email_add").innerHTML;
	if(pass3 =="" && pass4==""){
		if(pass1 == pass2){
			document.signupform.submit();
		}else{
			alert("Your passwords do not match. Please enter a matching password!");
		}
    }else{
		alert("Please choose valid username and email to proceed!");
    }
}
</script>
<style>
.pass_con_msg1{
	color: green;
}
.pass_con_msg2{
	color: red;
}
</style>
</head>
<body>
<section>
<h1>Sign Up</h1>
<form name="signupform" action="#" method="POST">
<table>
<tr>
<td>
Fisrt Name
</td>
<td>
<input type="text" name="firstname" id="firstname" required />
</td>
</tr>
<tr>
<td>
Last Name
</td>
<td>
<input type="text" name="lastname" id="lastname" required />
</td>
</tr>
<tr>
<td>
Cell number
</td>
<td>
<input type="text" name="cell" id="cell" required />
</td>
</tr>
<tr>
<td>
Username
</td>
<td>
<input type="text" name="newusername" id="newusername" onkeyup="check_availability(this.id, 'test_username', 'username')" onblur="check_availability(this.id, 'test_username', 'username')" required />
</td>
<td id="test_username"></td>
</tr>
<tr>
<td>
Email
</td>
<td>
<input type="email" name="email" id="email" onkeyup="check_availability(this.id,'test_email_add','email')" onblur="check_availability('email','test_email_add','email')" required />
</td>
<td id="test_email_add"></td>
</tr>
<tr>
<td>
Password
</td>
<td>
<input type="password" name="newpassword" id="newpassword" required />
</td>
</tr>
<tr>
<td>
Confirm password
</td>
<td>
<input type="password" name="newpasswordcon" id="newpasswordcon" onkeyup="confirm_pass()" required />
</td>
<td id="test_pass_con"></td>
</tr>
<tr>
<td></td><td><input type="submit" name="signup" id="signup" value="sign up" required /></td>
</tr>
</table>
</form>
</section>
</body>
</html>