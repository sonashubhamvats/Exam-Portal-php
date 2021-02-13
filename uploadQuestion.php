<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
    else
    {
        if(isset($_SESSION["testcode"]))
        {
            header("location:createTest.php");
        }
    
    }
    $number=$_POST["total"];
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    
    $username=$_SESSION["username"];
    $testcode=$_SESSION["testcode"];
    $testname=$_SESSION["testname"];

    $addQuestionTableName=$username."TestQuestions";
    $sel='create table if not exists '.$addQuestionTableName.'(qno varchar(20),testcode varchar(20),
    question varchar(200),optionA varchar(40),optionB varchar(40),optionC varchar(40),optionD varchar(40),
    type varchar(20),rightanswer varchar(10),testname varchar(20),maxmarks varchar(10),Primary key(qno,testcode))';
    if (mysqli_query($con, $sel)) {
        for($i=1;$i<=$number;$i++)
        {
            $check=$i."a";
            $qno="".$i;

            if(isset($_POST[$check]))
            {

                $insert="Insert into ".$addQuestionTableName."(qno,testcode,question,optionA,optionB,optionC,optionD
                ,type,rightanswer,testname,maxmarks) values 
                ('".$qno."','".$testcode."','".$_POST[$qno]."','".$_POST[$i."a"]."','".$_POST[$i."b"]."','".$_POST[$i."c"]."','".$_POST[$i."d"]."'
                ,'mcq','".$_POST[$i."e"]."','".$testname."','".$_POST[$i."m"]."')";
                if(mysqli_query($con,$insert))
                {

                }
                else
                {
                    echo "Error: ".$insert." ".mysqli_error($con);
                }
            }
            else
            {
                $insert="Insert into ".$addQuestionTableName."(qno,testcode,question,type,
                testname,maxmarks) values 
                ('".$qno."','".$testcode."','".$_POST[$qno]."','la','".$testname."','".$_POST[$i."m"]."')";
                if(mysqli_query($con,$insert))
                {

                }
                else
                {
                    echo "Error: ".$insert." ".mysqli_error($con);
                }
            }
        }

    } else {
        echo "Error: ". mysqli_error($con);
    }
    unset($_SESSION["testname"]);
    unset($_SESSION["testcode"]);
    header("location:head.php");
//        $insert="Insert into ".$adQuestionTableName."(name,rollno) values ('".$name."','".$rollno."')";

?>
