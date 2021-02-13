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

        .avg{
            font-size: 22px;
            margin:5px;
            background-color: #ff3721;
            font-weight:bold;
            width: 40%;
            transition: 0.6s ease;
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
            width: 400px;
            margin-top: 20px;
            margin-left: 6px;
            padding: 15px;
            background: white;
            border-radius: 30px;
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
                }
            ?> 
        </div>
        <ul>
            <li><a href="head.php">Dashboard</a></li>
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
        $alltheTestcodes="select * from ".$_SESSION["username"]."teststatushead";
        echo "<form action='viewIndiResponseHead.php' method='post'>";
        if(mysqli_query($con,$alltheTestcodes))
        {
            $resultAllTheTestCodes=mysqli_query($con,$alltheTestcodes);
            while($row=mysqli_fetch_array($resultAllTheTestCodes))
            {
                if($row["status"]=='disable')
                {
                    $totalMarks=0;
                    $totalStudents=0;        
                    echo "<div class='ques'>";
                    echo "<div class='tc'>Test code- ".$row["testcode"]."</div>";
                    echo "<div class='tc' style='color:red'>The test is disabled for now</div>";
                    $allTheStudents="select * from ".$_SESSION["username"]."status where testcode='".$row["testcode"]."'";
                    if(mysqli_query($con,$allTheStudents))
                    {
                        $resultAllofTheStudents=mysqli_query($con,$allTheStudents);
                        $num=mysqli_num_rows($resultAllofTheStudents);
                        if($num>0)
                        {
                            while($row1=mysqli_fetch_array($resultAllofTheStudents))
                            {
                                echo "<div class='ques1'>";
                                echo "<div class='tc'>Student username- ".$row1["username"],"</div>";
                                if($row1["status"]=="inExam")
                                {
                                    echo " <div class='tc'>The attendee is still attempting the exam</div>";
                                }
                                else
                                {
                                    echo "<div class='tc'>Attempted- </div>";
                                    $allTheUncheckedandChecked="select * from ".$row1["username"]."marks"." where testcode='".$row1["testcode"]."' and usernameHead='".$_SESSION["username"]."'";
                                    if(mysqli_query($con,$allTheUncheckedandChecked))
                                    {
                                        $resultAllUncheckedAndChecked=mysqli_query($con,$allTheUncheckedandChecked);
                                        while($row2=mysqli_fetch_array($resultAllUncheckedAndChecked))
                                        {
                                            if($row2["status"]=='notChecked')
                                            {
                                                echo "<input class='submit' type='submit' value='See Response' name='".$row1["username"].$row1["testcode"]."'> ";
                                                echo "<div class='tc'>Not evaluated!!</div><br>";
    
                                            }
                                            else if($row2["status"]=="checked")
                                            {
                                                echo "<input class='submit 'type='submit' value='See Response' name='".$row1["username"].$row1["testcode"]."'> ";
                                                echo "<div class='tc'>Already evaluated!! "."Marks given- ".$row2["marksObtained"]."</div><br>";
                                                $totalMarks+=$row2['marksObtained'];
                                                $totalStudents++;
                                            }
                                        }
                                    }
                                    
                                }
                                echo "</div>";
                                
                            }
                            if($totalStudents==0)
                            {
                                $totalStudents++;
                            }

                            echo "<div class='avg'>Average ".round($totalMarks/$totalStudents,2)."</div>";
                        }
                        else
                        {
                            echo "<div class='err'>No submissions till now</div>";
                        }
                    }
                    else
                    {
                        echo "<div class='err'>No submissions till now</div>";
                    }
                    echo "</div>";

                }
                if($row["status"]=='enable')
                {
                    $totalMarks=0;
                    $totalStudents=0;        
                    echo "<div class='ques'>";
                    echo "<div class='tc'>Test code- ".$row["testcode"]."</div>";
                    echo "<div class='tc'>The test is Live!!</div>";
                    $allTheStudents="select * from ".$_SESSION["username"]."status where testcode='".$row["testcode"]."'";
                    if(mysqli_query($con,$allTheStudents))
                    {
                        $resultAllofTheStudents=mysqli_query($con,$allTheStudents);
                        $num=mysqli_num_rows($resultAllofTheStudents);
                        if($num>0)
                        {
                            while($row1=mysqli_fetch_array($resultAllofTheStudents))
                            {
                                echo "<div class='ques1'>";
                                echo "<div class='tc'>Student username- ".$row1["username"]."</div>";
                                if($row1["status"]=="inExam")
                                {
                                    echo " <div class='tc'>The attendee is still attempting the exam</div>";
                                }
                                else
                                {
                                    echo "<div class='tc'>Attempted- </div>";
                                    $allTheUncheckedandChecked="select * from ".$row1["username"]."marks"." where testcode='".$row1["testcode"]."' and usernameHead='".$_SESSION["username"]."'";
                                    if(mysqli_query($con,$allTheUncheckedandChecked))
                                    {
                                        $resultAllUncheckedAndChecked=mysqli_query($con,$allTheUncheckedandChecked);
                                        while($row2=mysqli_fetch_array($resultAllUncheckedAndChecked))
                                        {
                                            if($row2["status"]=='notChecked')
                                            {
                                                echo "<input class='submit' type='submit' value='See Response' name='".$row1["username"].$row1["testcode"]."'> ";
                                                echo "<div class='tc'>Not evaluated!!</div><br>";
    
                                            }
                                            else if($row2["status"]=="checked")
                                            {
                                                echo "<input class='submit' type='submit' value='See Response' name='".$row1["username"].$row1["testcode"]."'> ";
                                                echo "<div class='tc'>Already evaluated!! "."Marks given- ".$row2["marksObtained"]."</div><br>";
                                                $totalMarks+=$row2['marksObtained'];
                                                $totalStudents++;                                                
                                            }
                                        }
                                    }

                                    
                                }
                                echo "</div>";
                               
                            }
                            if($totalStudents==0)
                            {
                                $totalStudents++;
                            }
                            echo "<div class='avg'>Average ".round($totalMarks/$totalStudents,2)."</div>";
                        }
                        else
                        {
                            echo "<div class='err'>No submissions till now</div>";
                            
                        }
                    }
                    else
                    {
                        echo "<div class='err'>No submissions till now</div>";
                    }

                    echo "</div>";
                }
                echo "<br><br>";
            }
        }
        else
        {
            echo "<div class='err'>No submissions till now</div>";
        }
        echo "</form>";
        
    ?>    
    </section>
</body>
</html>