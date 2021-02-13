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
            form
            {
                width: 100%;
            }
            .ques
            {
                border: 2px solid black;
                width: 40%;
                margin-top: 25px;
                margin-left: 280px;
                padding: 15px;
                background: white;
                border-radius: 30px;
            }
            input,textarea 
            {
            margin: 20px;
            }

            .submit:hover{
                background: saddlebrown;
            }

            .total{
                float: right;
                margin-top: 30px;
                margin-right: 50px;
                border: none;
                padding: 10px;
                border-radius: 5px;
            }

            .ltotal{
                float: right;
                width: 150px;
                font-size: 18px;
                margin-top: 25px;
                font-weight:bold
            }

            label{
                width: 150px;
                font-size: 18px;
                margin-top: 25px;
                font-weight:bold
            }

            .tname{
                
                margin-left: 280px;
                font-weight: bold;
                font-size: 22px;
            }

            .count{
                float:right;
                margin-top:25px;
                margin-right: 20px;
                border: 2px solid black;
                border-radius: 10px;
                padding: 10px;
                width: 80px;
                font-weight: bold;
                font-size: 18px;
            }

            .submit{
                margin-left: 280px;
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
                top: 0;
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
                background-position: center;
                height: 100%;
            }

            .res{
                font-weight:bold;
                font-size:18px;
                margin-left:10px;
                padding:7px;
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
            //username session head kaa hai aur child ke liye $row["username"] kar liyo
            $con = mysqli_connect("127.0.0.1:3307","root","");
            mysqli_select_db($con,"examdb");
            $alltheStudents="select * from ".$_SESSION["username"]."status";
        
            if(mysqli_query($con,$alltheStudents))
            {
                $resultalltheStudents=mysqli_query($con,$alltheStudents);
                while($row=mysqli_fetch_array($resultalltheStudents))
                {
                    if(isset($_POST[$row["username"].$row["testcode"]]))
                    {
                        //a session for the username
                        $_SESSION["applicantUsername"]=$row["username"];
                        $_SESSION["applicanttestcode"]=$row["testcode"];
                        //the code below shows the whole test
                        
                        $questions="select * from ".$_SESSION["username"]."testquestions"." where testcode='".$row["testcode"]."'order by qno";
                        $questionsResult=mysqli_query($con,$questions);
                        //total no questions//
                        $totalNoofquestions=mysqli_num_rows($questionsResult);
                        echo '<input type="text" name="total" id="totalno" class="total" style="width:60px;font-weight:bold" readonly value="'.$totalNoofquestions.'">';
                        echo '<label class="ltotal" for="total">The total no of questions: </label>';
                        $flag=0;
                        echo "<form method='post' action='viewIndiResponseHeadProcess.php'>";
                        while($row1=mysqli_fetch_array($questionsResult))
                        {
                            if($flag==0)
                            {
                                //here i m printing the name 
                                echo '<div class="tname">Test Name : '.$row1["testname"].'</div>';
                                $flag=1;
                            }
                            
                            if($row1["type"]=="la")
                            {
                                $answerGiven="";
                                //finding the answer that the person gave
                                $queryToFindTheAnswer="select * from ".$row["username"]."answer"." 
                                where qno='".$row1['qno']."' and testcode='".$row1['testcode']."' and usernameHead='".$_SESSION["username"]."'";
                                if(mysqli_query($con,$queryToFindTheAnswer))
                                {
                                    $resultToFndTheAnswer=mysqli_query($con,$queryToFindTheAnswer);
                                    while($row2=mysqli_fetch_array($resultToFndTheAnswer))
                                    {
                                        $answerGiven=$row2["answergiven"];
                                    }
                                }
                                else
                                {
                                    echo "Error: ".$queryToFindTheAnswer." ".mysqli_error($con);
                                }
                                
                                //long answer
                                echo '<div id="longans" class="ques"><label style="font-size: 18px;margin: 20px;font-weight:bold" for="descques">Q.'.$row1['qno'].'</label><textarea type="text" id="descriptive" name="descques" rows="4" cols="60" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" readonly>'.$row1['question'].'</textarea><br>';
                                echo '<textarea name="'.$row1['qno'].'" placeholder="No response" rows="7" cols="60" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" readonly>'.$answerGiven.'</textarea>';
                                echo '<div class="res">Maximum marks possible- '.$row1["maxmarks"]."</div>";
                                echo "<label style='margin-left:15px'>Enter the marks - </label><input style='border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;padding:5px;' type=number name='".$row1['qno'].$row1['testcode']."marksgiven"."' required></div></div>";                                
                    
                            }
                            else
                            {
                                //mcq
                                echo '<div id="mcqtype" class="ques"><label style="font-size: 18px;margin: 20px;font-weight:bold" for="mcqques">Q.'.$row1['qno'].'</label><br><textarea type="text" id="mcq" name="mcqques" rows="4" cols="50" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" readonly>'.$row1['question'].'</textarea><br>';
                                echo '<input type="radio" id="options" value="A" name="'.$row1['qno'].'" readonly><label for="A">'.$row1['optionA'].'</label><br>';
                                echo '<input type="radio" id="options" value="B" name="'.$row1['qno'].'" readonly><label for="B">'.$row1['optionB'].'</label><br>';
                                echo '<input type="radio" id="options" value="C" name="'.$row1['qno'].'" readonly><label for="C">'.$row1['optionC'].'</label><br>';
                                echo '<input type="radio" id="options" value="D" name="'.$row1['qno'].'" readonly><label for="D">'.$row1['optionD'].'</label>';        
                                $queryToFindTheAnswer="select * from ".$row["username"]."answer"." where qno='".$row1['qno']."' and testcode='".$row1['testcode']."' and usernameHead='".$_SESSION["username"]."'";
                                if(mysqli_query($con,$queryToFindTheAnswer))
                                {
                                    $resultToFndTheAnswer=mysqli_query($con,$queryToFindTheAnswer);
                                    while($row2=mysqli_fetch_array($resultToFndTheAnswer))
                                    {
                                        echo "<div class='res'>Maximum Marks- ".$row1["maxmarks"]."</div>";
                                        echo "<div class='res'>Answer given Option-".$row2["answergiven"]."</div>";
                                        echo "<div class='res'>Answer correct- Option-".$row1["rightanswer"]."</div>";
                                        if($row2["marksObtained"]==0){
                                            echo "<div class='res' style='color:red'>Marks Given- ".$row2["marksObtained"]."</div></div>";
                                        }
                                        else
                                        {
                                            echo "<div class='res' style='color:green'>Marks Given- ".$row2["marksObtained"]."</div></div>";
                                        }
                                    }
                                }
                                else
                                {
                                    echo "Error: ".$queryToFindTheAnswer." ".mysqli_error($con);
                                }

                            }
                        }
                        echo "<br><input class='submit' type='submit' value='Submit the checked paper'>";
                        echo "</form>";
        
                    
                    }
                }
            }   
            else
            {
                echo "Error: ".$alltheStudents." ".mysqli_error($con);
            } 
            
        ?>
    </section>
</body>
</html>