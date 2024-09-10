<?php
$showAlert = false;
$showError = false;
$insert = false;
if (isset($_POST['email'])) {
	$server = "localhost";
	$username = "root";
	$password = "";
	$connection = mysqli_connect($server, $username, $password);
	if (!$connection) {
		die("Failed" . mysqli_connect_error());

	}
	function function_alert($message)
	{
		echo "<script>alert('$message');</script>";
	}
	$email = $_POST['email'];
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	$cpword = $_POST['repassword'];
	$emexists = true;
	$unexists = true;
	$sql = "SELECT * FROM dhaagacult.userdata WHERE email ='$email'";
	$result=$connection->query($sql);
	if (mysqli_num_rows($result)==1) {
		function_alert("Email already exists");
		header("refresh:0;url=signup.html");
	} else {
		$sql = "SELECT * FROM dhaagacult.userdata WHERE Username ='$uname'";
		$result=$connection->query($sql);
		if (mysqli_num_rows($result)==1) {
			function_alert("Username already exists");
			header("refresh:0;url=signup.html");
		}
		else
		{
			if ($pword == $cpword && $emexists) {
				$sql = "INSERT INTO `dhaagacult`.`userdata` (`Email`, `Username`, `Password`) VALUES ('$email', '$uname', '$pword')";
				if ($connection->query($sql) == true) {
					$showAlert = true;
					header('Location: login.html');
				} else {
					echo "Error: $sql <br> $connection->error";
				}
			} else {
				$showError = "Passwords do not match!!!";
				function_alert("Passwords do not match!!!");
				header("refresh:0;url=signup.html");
			}
		}
	}
	$connection->close();
}
?>