<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
    else
    {
        if(!isset($_SESSION["allowTest"]))
        {
            header("location:viewTest.php");
        }
        else
        {
            if($_SESSION["allowTest"]=="false")
            {
                header("location:viewTest.php");
            }
        }
    }
    $testCode=$_SESSION["testcodeapp"];
    $organizer=$_SESSION["organizer"];
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $questions="select * from ".$organizer."testquestions"." where testcode='".$testCode."' order by qno";
    $questionsResult=mysqli_query($con,$questions);
    if($questionsResult)
    {

    }
    else
    {
        echo "Error: ".$questions." ".mysqli_error($con);
    }
    //total no questions//
    $totalNoofquestions=mysqli_num_rows($questionsResult);
    $studentNameAnswerTable=$_SESSION["username"]."answer";
    $sel='create table if not exists '.$studentNameAnswerTable.'
    (qno varchar(10), testcode varchar(30), type varchar(20), answergiven varchar(40),status varchar(20),marksObtained varchar(10)
    ,usernameHead varchar(30),Primary key(qno,testcode,usernameHead))';
    
    $insertStatus="Update ".$_SESSION["organizer"]."status"." set status='doneExam' where 
    username='".$_SESSION["username"]."' and testcode='".$testCode."'";
    mysqli_query($con,$insertStatus);
    
    $markstable="create table if not exists ".$_SESSION["username"]."marks"."(
        testcode varchar(30),usernameHead varchar(30),marksObtained varchar(20),status varchar(20),
        Primary key(testcode,usernameHead))";
    
    if(mysqli_query($con, $sel))
    {

    }
    else
    {
        echo "Error: ".mysqli_error($con);
    }
    if(mysqli_query($con, $markstable))
    {

    }
    else
    {
        echo "Error: ".$markstable.mysqli_error($con);
    }
    $temp_marks=0;
    while($row=mysqli_fetch_array($questionsResult))
    {

        if($row['type']=="la")
        {
            //la
            if(isset($_POST[$row['qno']]))
            {
                $insertla="insert into ".$studentNameAnswerTable."(qno,testcode,type,answergiven,status,marksObtained,usernameHead)
                values ('".$row["qno"]."','".$testCode."','la','".$_POST[$row["qno"]]."','NA','0','".$organizer."')";
                mysqli_query($con,$insertla);
    
            }
            else
            {
                $insertla="insert into ".$studentNameAnswerTable."(qno,testcode,type,answergiven,status,marksObtained,usernameHead)
                values ('".$row["qno"]."','".$testCode."','la','@null@','NA','0','".$organizer."')";
                mysqli_query($con,$insertla);
            }

        }
        else
        {
            //mcq
            $status="";
            $selectRightAnswer="select * from ".$_SESSION["organizer"]."testquestions"." where qno='".$row["qno"]."'
             and testcode='".$testCode."'";
            if(mysqli_query($con,$selectRightAnswer))
            {
                $rightans=mysqli_query($con,$selectRightAnswer);
                
                while($row1=mysqli_fetch_array($rightans))
                {
                    echo $_POST[$row["qno"]];
                    
                    if(isset($_POST[$row["qno"]]))
                    {
                        echo "here1";
                        
                        if($_POST[$row["qno"]]==$row1["rightanswer"])
                        {
                            echo "here";
                            $status="correct";
                            $temp_marks+=(int)$row1["maxmarks"];
                            $insertmcq="insert into ".$studentNameAnswerTable."(qno,testcode,type,answergiven,status,marksObtained,usernameHead)
                            values ('".$row["qno"]."','".$testCode."','mcq','".$_POST[$row["qno"]]."','".$status."','".$row1["maxmarks"]."','".$organizer."')";
                            mysqli_query($con,$insertmcq);
        
                        }
                        else
                        {
                            echo "here2";
                            $status="notCorrect";
                            $insertmcq="insert into ".$studentNameAnswerTable."(qno,testcode,type,answergiven,status,marksObtained,usernameHead)
                            values ('".$row["qno"]."','".$testCode."','mcq','".$_POST[$row["qno"]]."','".$status."','0','".$organizer."')";
                            mysqli_query($con,$insertmcq);
        
                        }
    
                    }
                    else
                    {
                        $status="notCorrect";
                        $insertmcq="insert into ".$studentNameAnswerTable."(qno,testcode,type,answergiven,status,marksObtained,usernameHead)
                        values ('".$row["qno"]."','".$testCode."','mcq','@null@','".$status."','0','".$organizer."')";
                        mysqli_query($con,$insertmcq);

                    }
                }
            }
            else
            {
                echo "Error: ".$selectRightAnswer.mysqli_error($con);
            }
            //calculate the marks
        }
    }
    unset($_SESSION["allowTest"]);
    $insertIntoMarks="insert into ".$_SESSION["username"]."marks"."(testcode,usernameHead,marksObtained,status) 
    values('".$testCode."','".$organizer."','".$temp_marks."','notChecked')";
    if(mysqli_query($con,$insertIntoMarks))
    {

    }
    else
    {
        echo "Error: ".$insertIntoMarks." ".mysqli_error($con);
    }
    header("location:viewTest.php");
?>