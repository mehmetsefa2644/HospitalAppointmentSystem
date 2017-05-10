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
        <?php if (isset($_SESSION['username'])){
                if(isset($_POST['edit'])){
                        $token = strtok($_POST['appointment'], " ");
                        $token = strtok(" ");
                        $appdate = $token;
                        #echo $appdate;
                        $token = strtok(" ");
                        $apphour = $token;
                        $token = strtok(" ");
                        $token =strtok(" ");
                        $appdoctorname = $token;
                        $token = strtok(" ");
                        $appdoctorsurname = $token;
                        #echo $apphour.$appdoctorname.$appdoctorsurname; ?>

                        <div class="links" style="position: absolute;
                                            left: 50%;
                                            top: 50%;
                                            text-align: center;
                                            width:546px;
                                            height:265px;
                                            margin-left: -273px;
                                            margin-top: -200px; ">
                                        <a>Edit Appointment</a><br><br>
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
                                                <input type="hidden" name="appdoctorname" value="<?php echo $appdoctorname;?>">
                                                <input type="hidden" name="appdoctorsurname" value="<?php echo $appdoctorsurname;?>">
                                                <input type="hidden" name="appdate" value="<?php echo $appdate;?>">
                                                <input type="hidden" name="apphour" value="<?php echo $apphour;?>">
                                                <input type="submit" value="edit" name="fromedit">
                                        </form><br><br>
                                        <div style="font-size:25px">
                                        <a>Appointment to be editted: Doctor: <?php echo $appdoctorname.' '.$appdoctorsurname; ?> Date: <?php echo $appdate.' '.$apphour; ?>
                                        </div>
                                        <div>
                <?php
                }elseif(isset($_POST['cancel'])){
                        $token = strtok($_POST['appointment'], " ");
                        $token = strtok(" ");
                        $appdate = $token;
                        #echo $appdate;
                        $token = strtok(" ");
                        $apphour = $token;
                        $token = strtok(" ");
                        $token =strtok(" ");
                        $appdoctorname = $token;
                        $token = strtok(" ");
                        $appdoctorsurname = $token;
                        #echo $apphour.$appdoctorname.$appdoctorsurname;
                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";
                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        $sql = "SELECT DID FROM doctor WHERE Name='".$appdoctorname."' AND Surname='".$appdoctorsurname."'";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                                $row5 = $result->fetch_assoc();
                                $did = $row5['DID'];
                        }

                        $timestamp1 = strtotime($appdate." ".$apphour);
                        $date_formated1 = date('Y-m-d H:i:s', $timestamp1);


                        $sql = "DELETE FROM appointment WHERE DID='".$did."' AND Date='".$date_formated1."'";
                        if($conn->query($sql) === TRUE){
                                ?>
                        <div class="links">
                            <a>Appointment Cancelled Successfully!</a><br><br>
                            <a href="/home.php">Continue</a>
                            <a href="/logout.php">Log Out</a>
                       </div>
                            <?php
                        }
                }
        }else{
                echo "Please <a href='/login.php'>login</a> first!";
        } ?>
</body>
</html>
