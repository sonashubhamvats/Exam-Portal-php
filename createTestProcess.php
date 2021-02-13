<?php

    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }

    $gudCount=0;
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $testName=$_POST["tname"];
    $testCode=$_POST["tcode"];
    $tableNameUser=$_SESSION["username"]."TestStatusHead";
    $createTable='create table if not exists '.$tableNameUser.'(testcode varchar(30),status varchar(20),tname varchar(30),tduration varchar(30),Primary key(testcode))';
    if(mysqli_query($con,$createTable))
    {
        $gudCount++;
    }
    else
    {
        echo "<br>Error: ".mysqli_error($con);
    }
    $tocheckForduplicates="select * from ".$tableNameUser." where testcode='".$testCode."'";
    if(mysqli_query($con,$tocheckForduplicates)&&$gudCount==1)
    {
        $result = mysqli_query($con,$tocheckForduplicates);
        $num_rows = mysqli_num_rows($result);
        if($num_rows>0)
        {
            
            echo "<br>The testcode already exists";
            echo "<a href='createTest.php'>Back</a>";
            
        }
        else
        {
            $insert="Insert into ".$tableNameUser."(testcode,status,tname,tduration) values ('".$testCode."','disable','".$testName."','".$_POST["tdura"]."')";
            if (mysqli_query($con, $insert)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $insert . "<br>" . mysqli_error($con);
            } 
            $_SESSION["testname"]=$testName;
            $_SESSION["testcode"]=$testCode;      
            header("location:addQuestionPage.php");
    
        }
    }
    else
    {
        echo "Error: ".mysqli_error($con);
    }

?>    
