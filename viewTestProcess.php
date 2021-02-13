<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <style>
        body{
            background: lightsalmon;
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
            top: 0;
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
            background-position: center;
            background-size: cover;
            height: 100vh;
        }

        .tc{
            font-size: 22px;
            margin-left:280px;
            color: red;
            font-weight:bold;
            transition: 0.6s ease;
        }

        .tc:hover{
            font-size:25px;
        }
    </style>    
<body>
    <div class="sidebar">
        <div class="head">Welcome 
            <?php 
            $name=$_SESSION["name"];
            if(strlen($name)>7)
            {
                $tempName="";
                $i=0;
                for($i=0;$i<9;$i++)
                {
                    $tempName=$tempName.$name[$i];
                }
                $tempName=$tempName."...";
                echo $tempName;
            }?>
        </div>
        <ul>
            <li><a href="applicant.php">Dashboard</a></li>
            <li><a href="viewTest.php">View Tests</a></li>
            <li><a href="viewResultsApplicant.php">View Results</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </div>
    <section>
        <?php
        
            $organizer=$_POST["teacher"];
            $testCode=$_POST["testcode"];    
            
            $con = mysqli_connect("127.0.0.1:3307","root","");
            mysqli_select_db($con,"examdb");
            $flag=0;
            $checkIfQuizenabled="select * from ".$organizer."teststatushead"." where testcode='".$testCode."'";
            if(mysqli_query($con,$checkIfQuizenabled))
            {
                $result=mysqli_query($con,$checkIfQuizenabled);
                while($row=mysqli_fetch_array($result))
                {
                    if($row["status"]=="disable")
                    {
                        $flag=1;
                        //devansh print here
                        echo "<div class='tc'>The test is disabled for now contact your organizer</div>";
                    }
                }
            }
            if($flag==0)
            {
                $statusTable='create table if not exists '.$organizer."status".'
                (username varchar(30),status varchar(30),testcode varchar(30)
                ,Primary key(username,testcode))';
                
                $statusInsert="insert into ".$organizer."status"."
                (username,status,testcode) values('".$_SESSION["username"]."','inExam','".$testCode."')";
            
                $checkFirst="select * from ".$_SESSION["username"]."answer"." where testcode='".$testCode."' and usernameHead='".$organizer."'";
                if(mysqli_query($con,$checkFirst))
                {
                $result=mysqli_query($con,$checkFirst);
                $totalNoofrows=mysqli_num_rows($result);
                if($totalNoofrows>0)
                {
                    $flag=1;
                    //devansh print here
                    echo "<div class='tc'>U cannot give the exam again</div>";
                }
                }
                else
                {
                    //echo "<div class='tc'>Error: ".mysqli_error($con)."</div>";
                }
                if($flag==0)
                {
                    $check="select * from ".$organizer."teststatushead"." where testcode=".$testCode;
                    if(mysqli_query($con,$check))
                    {
                        $result=mysqli_query($con,$check);
                        $num_rows=mysqli_num_rows($result);
                        if($num_rows>0)
                        {
                            $_SESSION["organizer"]=$organizer;
                            $_SESSION["testcodeapp"]=$testCode;        
                            $_SESSION["allowTest"]="true";
                            //using this script i will be taking in the time from a session variable calle time leave it as it is for now
                            $con = mysqli_connect("127.0.0.1:3307","root","");
                            mysqli_select_db($con,"examdb");
                            $query="select * from ".$_SESSION["organizer"]."teststatushead where testcode='".$_SESSION["testcodeapp"]."'";
                            $resultquery=mysqli_query($con,$query);
                            if(!$resultquery)
                            {
                                echo "<div class='tc'>Error: ".mysqli_error($con)."</div>";
                            }
                            while($row=mysqli_fetch_array($resultquery))
                            {
                                $_SESSION["tdura"]=$row["tduration"];
                                if(mysqli_query($con,$statusTable))
                                {
            
                                }
                                else
                                {
                                    echo "<div class='tc'>Error: ".$statusTable.mysqli_error($con)."</div>";
                                }
                                mysqli_query($con,$statusInsert);
                                
                                header("location:examWindow.php");
                            }
            
                        }
                        else
                        {
                            //devansh print here
                            echo "<div class='tc'>Invalid testid</div>";
                        }
                        
                    }
                    else
                    {
                        //devansh print here
                        echo "<div class='tc'>Something is wrong has ur admin uploaded the test yet??</div>";
                    }
                }         
            }
        ?>
    </section>
</body>
</html>