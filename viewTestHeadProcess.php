<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $selectQueryForAllExams="select * from ".$_SESSION["username"]."testStatusHead";
    if(mysqli_query($con,$selectQueryForAllExams))
    {
        $result=mysqli_query($con,$selectQueryForAllExams);
        while($row=mysqli_fetch_array($result))
        {
            
            if(isset($_POST[$row["testcode"]."enable"]))
            {
                
                $updateQuery="update ".$_SESSION["username"]."teststatushead"." set status='enable' where testcode='".$row["testcode"]."'";
                if(mysqli_query($con,$updateQuery))
                {
                    header("location:viewTestHead.php");
                }
                
                
            }        
            else if(isset($_POST[$row["testcode"]."disable"]))
            {
                
                $updateQuery="update ".$_SESSION["username"]."teststatushead"." set status='disable' where testcode='".$row["testcode"]."'";
                if(mysqli_query($con,$updateQuery))
                {
                    header("location:viewTestHead.php");
                }
            }
            else if(isset($_POST[$row["testcode"]."Delete"]))
            {
                $headUsername=$_SESSION["username"];
                $testCode=$row["testcode"];
                $selectQueryForExamOfTestcode="select * from ".$_SESSION["username"]."status where testcode='".$testCode."'";
                if(mysqli_query($con,$selectQueryForExamOfTestcode))
                {
                    $resultSelectQueryForExamsOfTestCode=mysqli_query($con,$selectQueryForExamOfTestcode);
                    while($row1=mysqli_fetch_array($resultSelectQueryForExamsOfTestCode))
                    {
                        $usernameApplicant=$row1["username"];
                        //delete from answer
                        $deleteFromAnswer="delete from ".$usernameApplicant."answer"." where testcode='".$testCode."' and
                        usernameHead='".$headUsername."'";
                        //delete from marks
                        $deleteFromMarks="delete from ".$usernameApplicant."marks"." where testcode='".$testCode."' and 
                        usernameHead='".$headUsername."'";

                        if(mysqli_query($con,$deleteFromAnswer))
                        {

                        }
                        else
                        {
                            echo "Error: ".$deleteFromAnswer." ".mysqli_error($con);
                        }
                        if(mysqli_query($con,$deleteFromMarks))
                        {

                        }
                        else
                        {
                            echo "Error: ".$deleteFromMarks." ".mysqli_error($con);
                        }

                    }
                    //delete from test questions
                    $delFromTestQuestions="delete from ".$headUsername."testquestions"." where testcode='".$testCode."'";
                    //delete from status
                    $deleteFromStatus="delete from ".$headUsername."status where testcode='".$testCode."'";
                    //delete from testHeadStatus
                    $deleteFromTestHeadStatus="delete from ".$headUsername."teststatushead where testcode='".$testCode."'";
                    if(mysqli_query($con,$delFromTestQuestions))
                    {

                    }
                    else
                    {
                        echo "Error: ".$delFromTestQuestions." ".mysqli_error($con);
                    }
                    
                    if(mysqli_query($con,$deleteFromStatus))
                    {

                    }
                    else
                    {
                        echo "Error: ".$deleteFromStatus." ".mysqli_error($con);
                    }
                    
                    if(mysqli_query($con,$deleteFromTestHeadStatus))
                    {

                    }
                    else
                    {
                        echo "Error: ".$deleteFromTestHeadStatus." ".mysqli_error($con);
                    }



                }
                else
                {
                    echo "Error: ".$selectQueryForExamOfTestcode." ".mysqli_error($con);
                }
                header("location:viewTestHead.php");

            }
        }
    }
    else
    {
        echo "Error : ".mysqli_error($con);
        echo "<br>Maybe u havent uploaded any exams yet";
    }
?>