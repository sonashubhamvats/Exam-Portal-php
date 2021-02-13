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
    <title>Document</title>
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
            margin:5px;
            font-weight:bold;
            transition: 0.6s ease;
        }

        .tc:hover{
            font-size:25px;
        }

        .submit{
            margin-left: 15px;
            margin-top: 25px;
            width: 250px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: 0.6s ease;
            font-size: 16px;
        }

        .submit:hover{
            background: saddlebrown;
        }

        .ques{
            border: 2px solid black;
            width: 40%;
            margin-top: 25px;
            margin-left: 280px;
            padding: 15px;
            background: white;
            border-radius: 30px;
        }

        .ques1{
            border: 2px solid black;
            width: 450px;
            margin-top: 25px;
            margin-left: 15px;
            padding: 15px;
            background: white;
            border-radius: 30px;
        }
        .err{
            font-size: 22px;
            margin-left:280px;
            color: red;
            font-weight:bold;
            transition: 0.6s ease;
        }

        .err:hover{
            font-size:25px;
        }

    </style>
</head>
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
            $con = mysqli_connect("127.0.0.1:3307","root","");
            mysqli_select_db($con,"examdb");
            $selectTheStatusMarks="select  count(*),usernameHead from ".$_SESSION["username"]."marks group by usernameHead";
            echo "<form method='post' action='viewResultApplicantReview.php'>";
            if(mysqli_query($con,$selectTheStatusMarks))
            {
                $resultSelectTheStatus=mysqli_query($con,$selectTheStatusMarks);
                
                while($row=mysqli_fetch_array($resultSelectTheStatus))
                {
                    $flag=0;
                    echo "<div class='ques'>";
                    if($flag==0)
                    {
                        echo "<div class='tc'> The tests under the Organizer- ".$row["usernameHead"]."</div>";
                        $flag=1;
                    }

                    $selectTheStatusMarksforAOrganizer="select  * from ".$_SESSION["username"]."marks".
                    " where usernameHead='".$row["usernameHead"]."'";
                    if(mysqli_query($con,$selectTheStatusMarksforAOrganizer))
                    {
                        $resultSelectTheStatusMarksforaOrganizer=mysqli_query($con,$selectTheStatusMarksforAOrganizer);
                        while($row2=mysqli_fetch_array($resultSelectTheStatusMarksforaOrganizer))
                        {
                            echo "<div class='ques1'>";
                            if($row2["status"]=="checked")
                            {
                                echo "<div class='tc'>The test with test code- ".$row2["testcode"]."</div>";
                                echo "<div class='tc'>Your paper has been evaluated- </div>";
                                if($row2["marksObtained"]==0)
                                {
                                    echo "<div class='tc' style='color:red;'>Marks Obtained- ".$row2["marksObtained"]."</div>";
                                }
                                else
                                {
                                    echo "<div class='tc' style='color:green;'>Marks Obtained- ".$row2["marksObtained"]."</div>";
                                }
                                echo "<input class='submit' type='submit' name='".$row2["usernameHead"].$row2["testcode"]."' value='Review'><br><br>";
                            }
                            else
                            {
                                echo "<div class='tc'>The test with test code- ".$row2["testcode"]."</div>";
                                echo "<div class='tc'>Your paper is being evaluated- </div>";
                            }
                            echo "</div>";
                        }
                    }
                    else
                    {
                        echo "<div class='err'>Error u havent given any exams yet</div>";
                    }
                    echo "</div>";
                }
            }
            else
            {
                echo "<div class='err'>Error u havent given any exams yet</div>";
            }
            echo "</form>";
        ?>
</body>
</html>