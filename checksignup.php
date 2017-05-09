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
				///*INSERT INTO `patient` (`PatID`, `UserName`, `Password`) VALUES (NULL, 'mehmet', 'mehmet')*/
				$sql = "INSERT INTO patient (PatID, UserName, Password) VALUES (NULL,'".$username."','".$password."')";
				if ($conn->query($sql) === TRUE) {
					header("Location: /login.php");
					exit;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();

				?>

		</div>
	</body>
</html>
