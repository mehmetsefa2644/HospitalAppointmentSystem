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
                if(!isset($_POST['fromedit'])){
                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";
                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        $sql = "INSERT INTO brach (BranchName) VALUES ('".$_POST['branchname']."')";

                        if($conn->query($sql) === TRUE){
                                ?>
                        <div class="links">
                            <a>Branch Added Successfully!</a><br><br>
                            <a href="/home.php">Continue</a>
                            <a href="/logout.php">Log Out</a>
                       </div>
                            <?php
                    }else{
                            echo $conn->error;
                    }
                }else{
                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";
                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        $sql = "INSERT INTO brach (BranchName) VALUES ('".$_POST['branchnamefromedit']."')";

                        if($conn->query($sql) === TRUE){
                                $sql = "DELETE FROM brach WHERE BranchName='".$_POST['oldbranch']."'";

                                $conn->query($sql);
                                ?>
                        <div class="links">
                            <a>Branch Editted Successfully!</a><br><br>
                            <a href="/home.php">Continue</a>
                            <a href="/logout.php">Log Out</a>
                       </div>
                            <?php
                }
                }
        }else {
                echo "Please <a href='/login.php'>login</a> first!";
        } ?>
</body>
</html>
