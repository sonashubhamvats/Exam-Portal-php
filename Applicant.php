<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Main</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        *{
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
        }

        .sidebar{
            position: fixed;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: brown;
        }

        .sidebar .head{
            font-size: 22px;
            color: white;
            text-align: center;
            line-height: 80px;
            background-color: saddlebrown;
            user-select: none;
        }

        .sidebar ul a{
            display: block;
            height: 100%;
            width: 100%;
            line-height: 70px;
            font-size: 20px;
            color: white;
            padding-left: 40px;
            box-sizing: border-box;
            border-top: 1px solid rgba(255,255,255,0.1);
            border-bottom: 1px solid black;
            transition: 0.5s ease;
        }
        ul li:hover a{
            padding-left: 50px;
        }

        section{
            background: url(https://cache.careers360.mobi/media/presets/860X430/article_images/2020/5/5/NITIE-Online-Test.jpg) no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
        }

        .profile{
            margin-right: 50px;
            float: right;
        }

        .icons{
            margin-top: 15px;
        }

        img{
            width: 70px;
            border: 2px solid black;
            border-radius:50%;
        }

        .status{
            margin-right: 50px;
            margin-top: 50px;
            background: white;
            color: black;
            width: 300px;
            border: 2px solid black;
            border-radius: 15px;
            display: none;
            padding: 15px;
            box-shadow:6px 6px 7px grey;
        }

        .profile:hover .status{
            display: block;
        }
        
        .profile:hover .icons{
            float: right;
        }

        .disp{
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div id="hello" class="head">Hello 
        <?php 
            $name=$_SESSION["name"];
            if(strlen($name)>7)
            {
                $tempName="";
                for($i=0;$i<9;$i++)
                {
                    $tempName=$tempName.$name[$i];
                }
                $tempName=$tempName."...";
            }
            echo $tempName;?>
        </div>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="viewTest.php">View Tests</a></li>
            <li><a href="viewResultsApplicant.php">View Results</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </div>
    <section>
        <?php
            echo '<div class="profile">';
            echo '<div class="icons"><img src="https://www.pinclipart.com/picdir/middle/355-3553881_stockvader-predicted-adig-user-profile-icon-png-clipart.png"></div>';
            echo '<div class=status>';
            echo '<div class="disp">Username- '.$_SESSION["username"].'</div>';
            echo '<div class="disp">Name- '.$_SESSION["name"].'</div>';
            echo '<div class="disp">Organization- '.$_SESSION["Org"].'</div>';
            echo '<div class="disp">Role- '.$_SESSION['role'].'</div>';
            echo '</div></div>';
        ?>
    </section>
</body>
</html>