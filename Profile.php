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
	session_start();
	if(isset($_SESSION['userID'])){
		$userID = $_SESSION['userID'];
		$sql = "SELECT * FROM usertable WHERE userID = '$userID'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(isset($row)){
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname']; 
			$_SESSION['username'] = $row['username'];
		}
	}
?>

<?php 
	if(isset($_POST['blabText'])){
		$userID = $_POST['userID'];
		$status = $_POST['blabText'];
		$sql = "INSERT INTO statuses (userID, status) VALUES ('$userID', '$status')";
		if($conn->query($sql) === TRUE){
			header("location: profile.php?id=$userID");
		}else{
			header("location: profile.php?id=$userID");
		}
	}
?>
<?php 
	include 'blab.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-16" />
<title>Profile - <?php echo $_SESSION['username']; ?></title>
<script>
function iFrameOn(){
	richBlabText.document.designMode = "on";
}
function iBold(){
	richBlabText.document.execCommand("bold",false, null);
}
function iItalic(){
	richBlabText.document.execCommand("italic",false, null);
}
function iUnderline(){
	richBlabText.document.execCommand("underline",false, null);
}
function iCreateUl(){
	richBlabText.document.execCommand("insertUnorderedList",false,null);
}
function iCreateOL(){
	richBlabText.document.execCommand("insertOrderedList",false,null);
}
function iInsertImage(){
			var file = document.getElementById("insertImageBtn").files[0];
			var imageType = /image.*/;
			if(file.type.match(imageType)){
				var reader = new FileReader();
				reader.onload = function(e){
					var myImage  = reader.result;
					richBlabText.document.execCommand("insertImage",false,myImage);
				}
				reader.readAsDataURL(file);
			}
}
function iCreateLink(){
	var myLink = prompt("Enter URL:",'');
	richBlabText.document.execCommand("createLink", false, myLink);
}
function iSetFontSize(){
	var choice= document.getElementById("").selectedIndex;
	var size = document.getElementById("").options[choice].value;
	richBlabText.document.execCommand("fontSize",false,size);
}

function iSetFontColor(){
	var myColor = prompt("Enter font color:",'');
	richBlabText.document.execCommand("foreColor",false,myColor);
}
function iHiLiteText(){
	var myHiLiteColor = prompt("Enter marker color",'');
	richBlabText.document.execCommand("hiLiteColor",false,myHiLiteColor);
}
function iEnterHRule(){
	richBlabText.document.execCommand("insertHorizontalRule",false, null);
}
function justify_text(option){
	switch(option){
		case 'left':
			option = "justifyLeft";
			break;
		case 'right':
			option = "justifyRight";
			break;
		case 'center':
			option = "justifyCenter";
			break;
		case 'justify':
			option = "justifyFull";
			break;
	}
	
	richBlabText.document.execCommand(option, false, null);
}
function select_all(){
	richBlabText.document.execCommand("selectAll", false, null);
}
function iUndo(){
	richBlabText.document.execCommand("undo", false, null);
}function unlink(){
	richBlabText.document.execCommand("unlink", false, null);
}
function iRedo(){
	richBlabText.document.execCommand("redo", false, null);
}
function iParagraph(){
	richBlabText.document.execCommand("insertParagraph", false, null);
}
function font_name(){
	var x = document.getElementById("fontNameSelect").selectedIndex;
	var myValue = document.getElementById("fontNameSelect").options[x].value;
	richBlabText.document.execCommand("fontName", false, myValue);
}
function iCut(){
	richBlabText.document.execCommand("cut", false, value);
}
function iCopy(){
	richBlabText.document.execCommand("copy", false, value);
}
function iPaste(){
	richBlabText.document.execCommand("paste", false, value);
}
function iDecreaseFontSize(){
	richBlabText.document.execCommand("decreaseFontSize", false, value);
}
function iDelete(){
	richBlabText.document.execCommand("delete", false, value);
}
function iEnableInlineTableEditing(){
	richBlabText.document.execCommand("enableInlineTableEditing", false, value);
}
function iEnableObjectResizing(){
	richBlabText.document.execCommand("enableObjectResizing", false, value);
}
function iFormatBlock(){
	richBlabText.document.execCommand("formatBlock", false, value);
}
function iForwardDelete(){
	richBlabText.document.execCommand("forwardDeletee", false, value);
}
function iHeading(){
	richBlabText.document.execCommand("heading", false, value);
}
function iIncreaseFontSize(){
	richBlabText.document.execCommand("increaseFontSize", false, value);
}
function iIndent(){
	richBlabText.document.execCommand("indent", false, value);
}
function iInsertBrOnReturn(){
	richBlabText.document.execCommand("insertBrOnReturn", false, value);
}
function iInsertHTML(){
	richBlabText.document.execCommand("insertHTML", false, value);
}
function iInsertParagraph(){
	richBlabText.document.execCommand("insertParagraph", false, value);
}
function iInsertText(){
	richBlabText.document.execCommand("insertText", false, value);
}
function iOutdent(){
	richBlabText.document.execCommand("outdent", false, value);
}
function iRemoveFormat(){
	richBlabText.document.execCommand("removeFormat", false, value);
}
function iStrikeThrough(){
	richBlabText.document.execCommand("strikeThrough", false, value);
}
function iSuperscript(){
	richBlabText.document.execCommand("superscript", false, value);
}
function iSubscript(){
	richBlabText.document.execCommand("subscript", false, value);
}
function iStyleWithCSS(){
	richBlabText.document.execCommand("styleWithCSS", false, value);
}
function iBackColor(){
	richBlabText.document.execCommand("backColor", false, value);
}
function copy(){
	richBlabText.document.execCommand("fontName", false, value);
}
function submit_form(){
	document.upstatus.blabText.value = window.frames['richBlabText'].document.body.innerHTML;
	upstatus.submit();
}
function myAsync(userID, data, url, method){
	
	if(window.XMLHttpRequest){
		var xmlhttp = new XMLHttpRequest();
	}else{
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
		xmlhttp.onreadystatechange=function(){
			this.value = xmlhttp.responseText;
		}
		if(method == "post"){
			url += "userID=" + userID;
			xmlhttp.open(method, url, true);
			xmlhttp.send(data);
		}else{
			url += "userID=" + userID + "data=" + data;
			xmlhttp.open(method, url, true);
			xmlhttp.send();
		}	
	}
}
/*
function blab(){
	var blab = this.parentNode.childNodes[0].value;
	var userID = this.parentNode.childNodes[2].value;
	var method = "post";
	var url = "blab.php";
	myAsync(userID, blab, url, method);	
}

function star(){
	var blab = this.parentNode.childNodes[0].value;
	var userID = this.parentNode.childNodes[2].value;
	var method = "post";
	var url = "blab.php";
	myAsync(userID, blab, url, method);	
}

function note(){
	var blab = this.parentNode.childNodes[0].value;
	var userID = this.parentNode.childNodes[2].value;
	var method = "post";
	var url = "blab.php";
	myAsync(userID, blab, url, method);	
}

function shine(){
	var blab = this.parentNode.childNodes[0].value;
	var userID = this.parentNode.childNodes[2].value;
	var method = "post";
	var url = "blab.php";
	myAsync(userID, blab, url, method);	
}

function opine(){
	var blab = this.parentNode.childNodes[0].value;
	var userID = this.parentNode.childNodes[2].value;
	var method = "post";
	var url = "blab.php";
	myAsync(userID, blab, url, method);	
}*/
</script>
<style>
*{
	box-sizing:border-box;
	font-family:Times New Roman, serif;
}
#boldBtn{
	font-weight:bolder;
}
#italicBtn{
	font-style:italic;
	padding-right:0px;
	padding-left:0px;
	font-weight:bold;
}
#underlineBtn{
	text-decoration:underline;
	font-weight:bold;
}
.blabs{
	box-shadow: 0px 0px 1px #000;
	border-radius: 2px;
	border-style:none;
	border-width:1px;
	padding:1%;
	margin:5px;
}
.blabAttLinks{
	display:inline-block;
	box-shadow: 1px 1px 1px #000;
	padding:4px;
	text-decoration:none;
}
#starBtn::after{
	content: "0";
	height:inherit;
	background:white;
	padding:1px;
	text-decoration:none;
	display:inline-block;
	box-shadow: 0px 0px 1px #000;
	position:relative;
	top:0px;
	left: 0px;
	margin:2px;
}
#noteBtn::after{
	content: "0";
	height:inherit;
	background:white;
	padding:1px;
	text-decoration:none;
	display:inline-block;
	box-shadow: 0px 0px 1px #000;
	position:relative;
	top:0px;
	left:0px;
	margin:2px;
}
#shineBtn::after{
	content: "0";
	height:inherit;
	background:white;
	padding:1px;
	text-decoration:none;
	display:inline-block;
	box-shadow: 0px 0px 1px #000;
	position:relative;
	left: 0px;
	margin:2px;
}
#opineBtn::after{
	content: "0";
	height:inherit;
	background:white;
	padding:1px;
	text-decoration:none;
	display:inline-block;
	box-shadow: 0px 0px 1px #000;
	position:relative;
	left: 0px;
	margin:2px;
}
a#starBtn, #opineBtn, #shineBtn, #noteBtn{
	padding-top:0px;
	padding-bottom:0px;
	margin:2px;
	border-radius:2px;
}
</style>
</head>
<body onload="iFrameOn()">
<header>
<h1><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h1>
<h2><?php echo "(".$_SESSION['username'].")"; ?></h2>
</header>
<main>
<!--<div id="richBlabToolbar">
    <input type="button" name="boldBtn" id="boldBtn" value="Bold"  onClick="iBold()" />
    <input type="button" name="italicBtn" id="italicBtn" value="Italic" onClick="iItalic()" />
    <input type="button" name="underlineBtn" id="underlineBtn" value="underline" onClick="iUnderline()" />
    <select name="fontSizeSelect" id="fontSizeSelect" onchange="font_name()">
        <option value="Georgia"></option>
        <option value="Georgia"></option>
        <option value="Georgia"></option>
        <option value="Georgia"></option>
        <option value="Georgia"></option>
        <option value="Georgia"></option>
        <option value="Georgia"></option>
    </select>
    <input type="button" name="ulBtn" id="ulBtn" value="Uunordered List" onClick="iCreateUl()" />
    <input type="button" name="olBtn" id="olBtn" value="Ordered List" onClick="iCreateOL()" />
    <input type="file" name="insertImageBtn" id="insertImageBtn" onchange="iInsertImage()" />
    <input type="button" name="createLinkBtn" id="createLinkBtn" value="Link" onClick="iCreateLink()" />
    <input type="button" name="fontColorBtn" id="fontColorBtn" value="Font Color" onClick="iSetFontColor()" />
    <input type="button" name="hiliteBtn" id="hiliteBtn" value="Highlight" onClick="iHiLiteText()" />
   	<input type="button" name="paragraph" id="paragraph" value="Paragraph" onClick="iParagraph()" />
    <input type="button" name="superscript" id="superscript" value="Superscript" onClick="iSuperscript()" /> 
   	<input type="button" name="subscript" id="subscript" value="Subscript" onClick="iSubscript()" /> 
   	<input type="button" name="redo" id="redo" value="Redo" onClick="redo()" /> 
    <input type="button" name="cut" id="cut" value="Cut" onClick="iCut()" />
    <input type="button" name="copy" id="copy" value="Copy" onClick="iCopy()" /> 
    <input type="button" name="paste" id="paste" value="Paste" onClick="iPaste()" />
    <input type="button" name="backColor" id="backColor" value="Back Color" onClick="iBackColor()" />
    <select name="fontNameSelect" id="fontNameSelect" onchange="font_name()">
        <option value="Georgia">Georgia</option>
        <option value="Palatino Linotype">Palatino Linotype</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Arial">Arial</option>
        <option value="Arial Black">Arial Black</option>
        <option value="Comic Sans MS">Comic Sans MS</option>
        <option value="Impact">Impact</option>
        <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
        <option value="Tahoma">Tahoma</option>
        <option value="Trebuchet MS">Trebuchet MS</option>
        <option value="Verdana">Verdana</option>
        <option value="monospace">Courier New</option>
        <option value="Lucida Console">Lucida Console</option>
    </select> 
    <input type="button" name="undo" id="undo" value="Undo" onClick="iUndo()" />
    <input type="button" name="redo" id="redo" value="Redo" onClick="iRedo()" />
</div>
<form action="#" method="POST" name="upstatus" id="upstatus">
  <textarea name="blabText" id="blabText" cols="50" rows="1000" style="display:none;"></textarea><iframe name="richBlabText" id="richBlabText"  style="width:100%; 
border-style:solid; border-width:4px; border-color:black; border-radius:5px;" 
onblur="transfer()"></iframe>

  <br />
<input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['userID']; ?>" />
<input type="button" name="blabBtn" id="blabBtn"  value = "blab" onClick="submit_form()" /> 
</form>-->
<p>Welcome back <?php echo "<b>".$_SESSION['']." ".$_SESSION['']."</b> (".$_SESSION[''].")" ?>
<p>Your instructor is <b>Mr Oyakhilome S.</b></p>
<h3>Select a course</h3>
<table>
<tr><td><label for='course1'>Advanced Certificate in Financial Planning</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Advanced Certificate in Management Studies</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Advanced Certificate in Business Management</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Business Administration</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Business Administration Honours</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Commerce in Accounting</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Commerce in Corporate Communication</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Commerce in Digital Marketing</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
<tr><td><label for='course1'>Bachelor of Commerce in Entrepreneurship</lablel></td><td><input type='radio' name='course1' id='course1'></td></tr>
</table>
<?php 
	if(isset($_SESSION['userID'])){
		$userID = $_SESSION['userID'];
		$sql = "SELECT * FROM statuses where userID = '$userID' ORDER BY timestamp DESC";
		$result = $conn->query($sql);
		$rowcount = $result->num_rows;
		if($rowcount >= 1){
			for($count = 0; $count < $rowcount; $count++){
				$row = $result->fetch_assoc();
				$statusID = "blab".$row['statusID'];
				$username = $_SESSION['username'];
				$status = $row['status'];
				$timestamp = $row['timestamp'];
				echo "<form action='#' method='post' name='$statusID' id='$statusID' class='blabs'>
							<p><a href='' >$username</a>&nbsp;<span>$timestamp</span></p>
							<p>$status</p>
							<p>
								<a href='' onclick='star()' id='starBtn' name='starBtn' class='blabAttLinks'>star</a>
								<a href='' onclick='note()' id='noteBtn' name='noteBtn' class='blabAttLinks'>note</a>
								<a href='' onclick='shine()' id='shineBtn' name='shineBtn' class='blabAttLinks'>shine</a>
								<a  onclick='opine(this.parentNode.parentNode.id)' id='opineBtn' name='opineBtn' class='blabAttLinks'>opine</a>
							</p>
					  </form>";
			}
		}
	}
?>
</main>
</body>
</html>