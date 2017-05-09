<!DOCTYPE html>
<html>
	<head>
		<style>
			html, body {
			    	background-color: #DCDCDC;
			    	color: #636b6f;
			    	font-family: 'Raleway', sans-serif;
			    	font-weight: 100;
			    	height: 100vh;
			    	margin: 0;
		        }
			.title {
			    	font-size: 20px;
		        }
			input[type=submit] {
			    padding:5px 15px;
			    background:#ccc;
			    border:0 none;
			    cursor:pointer;
			    -webkit-border-radius: 5px;
			    border-radius: 5px;
			}
		</style>
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
    		<div class="title" >
			<h2>LOGIN</h2>
		</div>
		<form action="checklogin.php" method="post">
			UserName: <input type="text"  name="username"><br><br>
			Password:  <input type="password"  name="password"><br><br>
			<input type="submit" value="login">
		</form>

		</div>
	</body>
</html>
