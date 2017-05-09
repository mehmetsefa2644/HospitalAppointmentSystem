<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
	</head>
	<body>
		<div align="center" style="position: absolute;
		    left: 50%;
		    top: 50%;
		    text-align: center;
		    width:546px;
		    height:265px;
		    margin-left: -273px; /*half width*/
		    margin-top: -132px; /*half height*/">

				<?php
				$username = $_POST["username"];
				$password = $_POST["password"];
				$dbname = "hospital";
				$server = "localhost";
				$dbusername = "root";
				$dbpass = "";

				$conn = new mysqli($server, $dbusername, $dbpass, $dbname);

				if ($conn->connect_error){
					die("Connection Failed!");
				}

				$sql = "SELECT PatID FROM patient WHERE UserName= \"".$username."\"";

				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					$sql = "SELECT PatID FROM patient WHERE UserName= \"".$username."\" AND Password= \"".$password."\"";
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
						$_SESSION['username'] = $username;
						$_SESSION['password'] = $password;
						$_SESSION['admin'] = 0;
						header("Location: /home.php");
						exit;
					}else{
						echo "PASSWORD IS NOT CORRECT!";
						?><br><a href="/login.php">Back</a><?php
						session_destroy();
					}
				}else{
					$sql = "SELECT AdID FROM admin WHERE UserName= \"".$username."\" AND Password= \"".$password."\"";
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
						$_SESSION['username'] = $username;
						$_SESSION['admin'] = 1;
						header("Location: /home.php");
						exit;
					}else{
						echo "PASSWORD OR USERNAME IS NOT CORRECT!";
						?><br><a href="/login.php">Back</a><?php
						session_destroy();
						die();
					}
					echo "USERNAME DOES NOT EXIST!";
					?><br><a href="/login.php">Back</a><?php
					session_destroy();
				}
				?>

		</div>
	</body>
</html>
