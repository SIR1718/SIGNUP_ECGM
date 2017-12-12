<?php
session_start();

$username = "";
$fname = "";
$lname = "";

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}

if (isset($_SESSION['lname'])) {
	$lname = $_SESSION['lname'];
}

if (isset($_SESSION['fname'])) {
	$fname = $_SESSION['fname'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
</head>
<body>

<form action="signup.php" method="POST">

<label for="iuser"> username: <span id="status"></span></label>
<input type="text" id="iuser" name="username" value="<?php echo $username?>"/>

<label for="ipass1"> password: </label>
<input type="password" id="ipass1" name="password1"/>

<label for="ipass2"> confirm password: </label>
<input type="password" id="ipass2" name="password2"/>

<label for="ifname"> first name: </label>
<input type="text" id="ifname" name="fname" value="<?php echo $fname?>"/>

<label for="ilname"> last name: </label>
<input type="text" id="ilname" name="lname" value="<?php echo $lname?>"/>

<input type = "submit" value="create new account"/>

</form>
</body>
<script type="text/javascript">
	$("#iuser").keyup
	( function (event) {
		$.ajax({
			url : "checkuser.php",
			data : {
				"u" : $("#iuser").val()
			},
			method : "GET",
			dataType : "text",
			success : function (data) {
				console.log(data);
				if (data == "livre") {
					$("#iuser").css("background-color","lightgreen");
					$("#status").html("username livre");
				} else {
					$("#iuser").css("background-color","pink");
					$("#status").html("username ocupado");
				}
			}
		});
	});
</script>

</html>