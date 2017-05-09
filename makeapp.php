<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
        <style>
                html, body {
                        background-color: #DCDCDC;
                        color: #636b6f;
                        font-family: 'Raleway', sans-serif;
                        font-weight: 100;
                        height: 70vh;
                        margin: 0;
                        position: absolute;
                            left: 50%;
                            top: 50%;
                            text-align: center;
                            width:546px;
                            height:265px;
                            margin-left: -273px; /*half width*/
                            margin-top: -132px; /*half height*/
                }
                .title {
                        font-size: 20px;
                }
                .links > a {
               color: #636b6f;
               padding: 0 25px;
               font-size: 20px;
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
        <?php if (isset($_SESSION['username'])){
                        #echo $_POST['date']." ".$_POST['hour']." ".$_POST['doctor']." ".$_SESSION['username']." ";
                        $token = strtok($_POST['doctor'], " ");
                        $doctorName = $token;
                        #echo $doctorName;
                        $token = strtok(" ");
                        $doctorSurname = $token;
                        #echo $doctorSurname;
                        $token = strtok(" ");
                        $token = strtok(" ");
                        $doctorBranch = $token;
                        #echo $doctorBranch;
                        #echo $_SESSION['password'];

                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";

                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        if ($conn->connect_error){
                                die("Connection Failed!");
                        }

                        $sql = "SELECT PatID FROM patient WHERE UserName= '".$_SESSION['username']."' AND Password='".$_SESSION['password']."'";
                        #echo $sql;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0){
                                $row = $result->fetch_assoc();
                                #echo $row['PatID'];
                        }

                        $sql = "SELECT DID FROM doctor WHERE Name= '".$doctorName."' AND Surname='".$doctorSurname."'";
                        #echo $sql;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0){
                                $row1 = $result->fetch_assoc();
                                #echo $row1['DID'];
                        }

                        $timestamp = strtotime($_POST['date']." ".$_POST['hour']);
                        $date_formated = date('Y-m-d H:i:s', $timestamp);
                        #echo "\n Date Formatted ".$date_formated;

                        $sql2 = "SELECT Date FROM appointment WHERE DID = (
                                        SELECT DID FROM doctor WHERE name = '".$doctorName."' AND Surname ='".$doctorSurname."'
                                )";
                        #echo $sql2;
                        $result = $conn->query($sql2);
                        if ($result->num_rows > 0){
                                while ($row2 = $result->fetch_assoc()) {
                                        $datesubstr = substr($row2['Date'], 0 , 19);
                                        #echo "\nROW DATE ".$datesubstr;
                                        #echo "\nPOST DATE ".$date_formated;
                                        if($datesubstr == $date_formated){ ?>
                                                <div class="links">
                                                        <a>Appointment is not available at</a> <?php echo "<div class=\"links\">". $datesubstr. "</div>"; ?><br><br>
                                                        <a href="/home.php">Continue</a>
                                                        <a href="/logout.php">Log Out</a>
                                                </div>
                                                <?php
                                                die();
                                        }
                                }
                        }

                        $sql = "INSERT INTO appointment (DID, PatID, Date) VALUES (".$row1['DID'].",".$row['PatID'].",'".$date_formated."')";
                        #echo $sql;
                        if ($conn->query($sql) === TRUE) { ?>
                        <div class="links">
                            <a>New Appointment Created Successfully!</a><br><br>
                            <a href="/home.php">Continue</a>
                            <a href="/logout.php">Log Out</a>
                       </div>
                            <?php
                        } else {
                                echo "error= ".$conn->error;
                                ?>
                        <div class="links">
                                <a>ERROR!</a>
                                <a href="/home.php">Continue</a>
                                <a href="/logout.php">Log Out</a>
                        </div>
                        <?php }

        }else {
                echo "Please <a href='/login.php'>login</a> first!";
        } ?>
</body>
</html>
