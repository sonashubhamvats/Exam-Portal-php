<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
    $applicantUsername=$_SESSION["applicantUsername"];
    $testcodetemp=$_SESSION["applicanttestcode"];
    unset($_SESSION["applicantUsername"]);
    unset($_SESSION["applicanttestcode"]);
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $selectTheAnswers="select * from ".$applicantUsername."answer";
    $tempMarks=0;

    $selectTheMcqsQuery="select sum(marksObtained) as sumMCQ from ".$applicantUsername."answer"." where type='mcq' and testcode='".$testcodetemp."' and usernameHead='".$_SESSION["username"]."'";
    if(mysqli_query($con,$selectTheMcqsQuery))
    {
        $resultSelectTheMcq=mysqli_query($con,$selectTheMcqsQuery);
        while($row=mysqli_fetch_array($resultSelectTheMcq))
        {
            $tempMarks=$row["sumMCQ"];
        }
    }
    else
    {
        echo "Error: ".$selectTheMcqsQuery." ".mysqli_error($con);
    }

    $updateTheCurrentTempMarks="update ".$applicantUsername."marks"." set marksObtained='".$tempMarks."' where testcode='".$testcodetemp."' and usernameHead='".$_SESSION["username"]."'";
    if(mysqli_query($con,$updateTheCurrentTempMarks))
    {
        
    }
    else
    {
        echo "Error: ".$updateTheCurrentTempMarks." ".$updateTheCurrentTempMarks;
    }
    
    
    if(mysqli_query($con,$selectTheAnswers))
    {
        $resultSelectAnswers=mysqli_query($con,$selectTheAnswers);
        
        while($row=mysqli_fetch_array($resultSelectAnswers))
        {

            if(isset($_POST[$row['qno'].$row['testcode']."marksgiven"]))
            {
                $marksGiven=$_POST[$row['qno'].$row['testcode']."marksgiven"];
                $tempMarksA=0;
                //seleting the tempMarks in the marks table
                $findtheCurrentTempMarks="select * from ".$applicantUsername."marks"." where testcode='".$row['testcode']."' and usernameHead='".$_SESSION["username"]."'";
                if(mysqli_query($con,$findtheCurrentTempMarks))
                {

                    $resultFindCurrentTempMarks=mysqli_query($con,$findtheCurrentTempMarks);
                    while($row1=mysqli_fetch_array($resultFindCurrentTempMarks))
                    {
                        $marksObtained=$row1["marksObtained"];
                        $tempMarksA=(int)$marksObtained;
                        $tempMarksA+=(int)$marksGiven;
                        //updating marksobtained multiple times
                        $updateMarksQuery="update ".$applicantUsername."marks"." set marksObtained='".$tempMarksA."' 
                        where testcode='".$row['testcode']."' and usernameHead='".$_SESSION["username"]."'";
                        if(mysqli_query($con,$updateMarksQuery))
                        {
                            
                        }
                        else
                        {
                            echo "Error: ".$updateMarksQuery." ".mysqli_error($con);
                        }
                    }
                    
                }
                else
                {
                    echo "Error: ".$findtheCurrentTempMarks." ".mysqli_error($con);
                }
                //updating the answer table
                $updateMarksOneQuery="update ".$applicantUsername."answer"." set marksObtained='".$marksGiven."'
                where qno='".$row['qno']."' and testcode='".$row['testcode']."' and usernameHead='".$_SESSION["username"]."'";
                if(mysqli_query($con,$updateMarksOneQuery))
                {
                   
                }
                else
                {
                    echo "Error: ".$updateMarksOneQuery." ".mysqli_error($con);
                }
                
            }
        }
        //updating temp marks finally
        if($tempMarksA>0)
        {
            $tM=""+$tempMarksA;
        }
        else
        {
            $tM=$tempMarks;
        }
        $updateMarksQuery="update ".$applicantUsername."marks"." set marksObtained='".$tM."',status='checked' 
        where testcode='".$testcodetemp."' and usernameHead='".$_SESSION["username"]."'";
        if(mysqli_query($con,$updateMarksQuery))
        {
            
        }
        else
        {
            echo "Error: ".$updateMarksQuery." ".mysqli_error($con);
        }

    }
    else
    {
        echo "Error: ".$selectTheAnswers." ".mysqli_error($con);
    }
    header("location:viewResultsHead.php");

?>