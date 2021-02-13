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
    <style>
        fieldset
        {
            display: inline-block;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: lightsalmon;
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
            top:0;
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

        form{
            width: 100%;
        }

        section{
            background-position: center;
            background-size: cover;
            height: 100vh;
        }

        .ques
        {
            border: 2px solid black;
            width: 30%;
            margin-top: 25px;
            margin-left: 280px;
            padding: 15px;
            background: white;
            border-radius: 30px;
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

        .submit{
            margin: 5px;
            width: 200px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: 0.6s ease;
            font-size: 16px;
        }

        .enable{
            margin: 5px;
            width: 200px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: 0.6s ease;
            font-size: 16px;
        }

        .disable{
            margin: 5px;
            width: 200px;
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

        .enable:hover{
            background: green;
        }

        .disable:hover{
            background: red;
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
                    }
                ?> 
            </div>
            <ul>
                <li><a href="Head.php">Dashboard</a></li>
                <li><a href="createTest.php">Create Test</a></li>
                <li><a href="viewTestHead.php">View Tests</a></li>
                <li><a href="viewResultsHead.php">View Results</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
    </div>
    <section>
        <?php
            
            $con = mysqli_connect("127.0.0.1:3307","root","");
            mysqli_select_db($con,"examdb");
            echo "<form method='post' action='viewTestHeadProcess.php'>";
            $selectQueryForAllExams="select * from ".$_SESSION["username"]."testStatusHead";
            if(mysqli_query($con,$selectQueryForAllExams))
            {
                $result=mysqli_query($con,$selectQueryForAllExams);
                while($row=mysqli_fetch_array($result))
                {
                    echo '<div class="ques" id="box">';
                    echo "<div class='tc'>Test code- ".$row["testcode"]."<br>Test name- ".$row["tname"]."</div>";
                    if($row["status"]=="enable")
                    {
                        //printng the current status of the exam
                        echo "<div class='tc' style='color:green' >Exam enabled and live</div>";
                        echo "<input class='disable' type='submit' value='Disable' name='".$row["testcode"]."disable"."'>";
                        echo "&nbsp;&nbsp;&nbsp;<input class='submit' type='submit' value='Delete' name='".$row["testcode"]."Delete"."'>";
                    }        
                    else
                    {
                        echo "<div class='tc' style='color:red'>Exam disabled</div>";
                        echo "<input class='enable' type='submit' value='Enable' name='".$row["testcode"]."enable"."'>";
                        echo "&nbsp;&nbsp;&nbsp;<input class='submit' type='submit'  value='Delete' name='".$row["testcode"]."Delete"."'>";
                    }
                    echo '</div>';
                }
            }
            else
            {
                //echo "<div class='tc'>Error : ".mysqli_error($con);
                echo "<br><div class='err'>Maybe u havent uploaded any exams yet</div>";
            }
            echo "</form>";
        ?> 
    </section>   
</body>
</html>