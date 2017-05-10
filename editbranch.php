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
                if(isset($_POST['edit'])){ ?>

                        <div class="links" style="position: absolute;
                                            left: 50%;
                                            top: 50%;
                                            text-align: center;
                                            width:546px;
                                            height:265px;
                                            margin-left: -273px;
                                            margin-top: -132px; ">
                                        <a>Edit Branch</a><br><br>
                                        <form action="addbranch.php" method="post">
                                                Branch Name:
                                                <input type="text" name="branchnamefromedit">
                                                <input type="hidden" name="oldbranch" value="<?php echo $_POST['branches']; ?>">
                                                <input type="submit" value="edit" name="fromedit">
                                        </form><br><br>
                                        <div style="font-size:25px">
                                        <a>Branch to be editted:Branch Name: <?php echo $_POST['branches']; ?> </a>
                                        </div>

                <?php
                }elseif(isset($_POST['remove'])){

                        $dbname = "hospital";
                        $server = "localhost";
                        $dbusername = "root";
                        $dbpass = "";
                        $conn = new mysqli($server, $dbusername, $dbpass, $dbname);

                        $sql = "DELETE FROM brach WHERE BranchName='".$_POST['branches']."'";

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
