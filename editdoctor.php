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

                        $token = strtok($_POST['doctors'], " ");
                        $doctorName = $token;
                        #echo $doctorName;
                        $token = strtok(" ");
                        $doctorSurname = $token;
                        #echo $doctorSurname;
                        $token = strtok(" ");
                        $token = strtok(" ");
                        $doctorBranch = $token;
                        #echo $doctorBranch;

                        ?>

                        <div class="links" style="position: absolute;
                                            left: 50%;
                                            top: 50%;
                                            text-align: center;
                                            width:546px;
                                            height:265px;
                                            margin-left: -273px;
                                            margin-top: -132px; ">
                                        <a>Edit Doctor</a><br><br>
                                        <form action="adddoctor.php" method="post">
                                                Doctor Name:
                                                <input type="text" name="doctornamefromedit"><br>
                                                Doctor Surname:
                                                <input type="text" name="doctorsurnamefromedit"><br>
                                                Doctor Branch:
                                                <select style="width:85px;" name="doctorbranchfromedit">
                                                <?php
                                                        $dbname = "hospital";
                                                        $server = "localhost";
                                                        $dbusername = "root";
                                                        $dbpass = "";
                                                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                                                        if ($conn->connect_error){
                                                                die("Connection Failed!");
                                                        }

                                                        $sql = "SELECT BranchName FROM brach";

                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0){
                                                                while ($row6 = $result->fetch_assoc()) {
                                                                        echo '<option>'.$row6['BranchName'].'</option>';
                                                                }
                                                        }
                                                ?>
                                                </select><br><br>
                                                <input type="hidden" name="olddoctorname" value="<?php echo $doctorName; ?>">
                                                <input type="hidden" name="olddoctorsurname" value="<?php echo $doctorSurname; ?>">
                                                <input type="hidden" name="olddoctorbranch" value="<?php echo $doctorBranch; ?>">
                                                <input type="submit" value="edit" name="fromedit">
                                        </form><br><br>
                                        <div style="font-size:25px">
                                        <a>Doctor Info to be editted: <?php echo "<br>".$_POST['doctors']; ?> </a>
                                        </div>

                <?php
                }elseif(isset($_POST['remove'])){
                        $token = strtok($_POST['doctors'], " ");
                        $doctorName = $token;
                        #echo $doctorName;
                        $token = strtok(" ");
                        $doctorSurname = $token;
                        #echo $doctorSurname;
                        $token = strtok(" ");
                        $token = strtok(" ");
                        $doctorBranch = $token;
                        #echo $doctorBranch;

                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";
                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        $sql = "DELETE FROM doctor WHERE Name='".$doctorName."' AND Surname='".$doctorSurname."'";

                        if($conn->query($sql) === TRUE){
                                ?>
                        <div class="links">
                            <a>Branch Removed Successfully!</a><br><br>
                            <a href="/home.php">Continue</a>
                            <a href="/logout.php">Log Out</a>
                       </div>
                            <?php
                        }
                }
        }else{
                echo "Please <a href='/login.php'>login</a> first!";
        }  ?>
</body>
</html>
