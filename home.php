<?php
        session_start();
 ?>
 <!DOCTYPE html>
 <html>
         <head>
                 <title>HOME</title>
                 <style>
                         html, body {
                                 background-color: #DCDCDC;
                                 color: #636b6f;
                                 font-family: 'Raleway', sans-serif;
                                 font-weight: 100;
                                 height: 70vh;
                                 margin: 0;
                         }
                         .title {
                                 font-size: 20px;
                         }
                         .links > a {
                     	color: #636b6f;
                     	padding: 0 25px;
                     	font-size: 30px;
                     	font-weight: 600;
                     	letter-spacing: .1rem;
                     	text-decoration: none;
                     	text-transform: uppercase;
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
        </head>
        <body>
                <?php
                if(isset($_SESSION['admin'])){
                        if ($_SESSION['admin'] == 0) {
                                if(!isset($_SESSION['username'])){
                                        echo "Please <a href='/login.php'>login</a> first!";
                                }else {?>
                                        <div style="text-align:center">
                                                <h3>Welcome patient <?php echo $_SESSION['username'] ?> </h3><a href="/logout.php">Logout</a>
                                        </div>
                                        <div class="links" style="position: absolute;
                                                            left: 50%;
                                                            top: 50%;
                                                            text-align: center;
                                                            width:546px;
                                                            height:265px;
                                                            margin-left: -273px;
                                                            margin-top: -132px; ">
                                                        <a>Make Appointment</a><br><br>
                                                        <form action="makeapp.php" method="post">
                                                                Date:
                                                                <input type="date" name="date">
                                                                Time:
                                                                <select style="width:85px;" name="hour">
                                                                <?php for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
                                                                    for($mins=0; $mins<60; $mins+=5) // the interval for mins is '5'
                                                                        echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';?>
                                                                </select>
                                                                Doctor:
                                                                <select style="width:85px;" name="doctor">
                                                                <?php
                                                                        $dbname = "hospital";
                                                                        $server = "localhost";
                                                                        $dbusername = "root";
                                                                        $dbpass = "";
                                                                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                                        				if ($conn->connect_error){
                                        					die("Connection Failed!");
                                        				}

                                        				$sql = "SELECT Name, Surname, BranchID FROM doctor";

                                        				$result = $conn->query($sql);
                                        				if ($result->num_rows > 0){
                                                                                while ($row = $result->fetch_assoc()) {
                                                                                        $sql1 = "SELECT BranchName FROM brach WHERE BranchID=".$row['BranchID'];
                                                                                        $result1 = $conn->query($sql1);
                                                                                        $row1 = $result1->fetch_assoc();
                                                                                        echo '<option>'.$row['Name'].' '.$row['Surname'].' : '.$row1['BranchName'].'</option>';
                                                                                }
                                                                        }
                                                                ?>
                                                                </select>
                                                                <input type="submit" value="make">
                                                        </form><br><br>
                                                        <a>Appointments</a><br><br>
                                                        <div style="text-align:left; margin-left:90px">
                                                        <form action="/editapp.php" method="POST">
                                                        <select name="appointment">
                                                        <?php
                                                                $sql = "SELECT PatID FROM patient WHERE UserName='".$_SESSION['username'].
                                                                                "' AND Password ='".$_SESSION['password']."'";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                        $row3 = $result->fetch_assoc();
                                                                        $patid = $row3['PatID'];
                                                                        #echo $patid;
                                                                }
                                                                $sql = "SELECT DID, Date FROM appointment WHERE PatID='".$patid."'";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0){
                                                                        while ($row2 = $result->fetch_assoc()) {
                                                                                $datesubstr = substr($row2['Date'], 0 , 16);
                                                                                $sql1 = "SELECT Name, Surname FROM doctor WHERE DID=".$row2['DID'];
                                                                                $result1 = $conn->query($sql1);
                                                                                $row4 = $result1->fetch_assoc();
                                                                                echo '<option > Date: '.$datesubstr.'
                                                                                        Doctor: '.$row4['Name'].' '.$row4['Surname'].'</option>';
                                                                        }
                                                                }
                                                         ?>
                                                        </select>
                                                        <input type="submit" value="Edit" name="edit">
                                                        <input type="submit" value="Cancel" name="cancel">
                                                        </form>
                                        </div>
                                <?php }
                        }else{
                                if(!isset($_SESSION['username'])){
                                        echo "Please <a href='/login.php'>login</a> first!";
                                }else {?>
                                        <a href="/logout.php">Logout</a><br>
                                        <h3>Welcome admin <?php echo $_SESSION['username'] ?> </h3>
                                        <h2>HOME</h2>
                                <?php }
                        }
                }else{
                        echo "Please <a href='/login.php'>login</a> first!";
                }?>
        </body>
</html>
