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
        </style>
        <script type="text/javascript">
            function submitForm(action) {
                var form = document.getElementById('form1');
                form.action = action;
                form.submit();
            }
            document.addEventListener("visibilitychange",function(){
                if(document.hidden){
                    submitForm('examWindowProcess.php');
                }
            });

            var seconds = <?php
                                $minutesTime=$_SESSION["tdura"];
                                $dbSessionDurationTime = $minutesTime*60;
                                echo $dbSessionDurationTime;
                            ?>;
            //echo statements are allowed in javascript devansh!! yipeeee


            function displaytimer(){
                var hours = Math.floor(seconds/3600),
                    mins = Math.floor(seconds%3600/60),
                    secs = Math.floor((seconds % 60));
                    tempsecs=secs;
                    if(secs==0&&hours==0&&mins==0)
                    {
                        //go to other page "test completion"
                        submitForm('examWindowProcess.php');
                    }
                    if(secs<10)
                    {
                        tempsecs="0"+secs;
                    }
                    if(hours<10)
                    {
                        hours="0"+hours;
                    }
                    if(mins<10)
                    {
                        mins="0"+mins;
                    }
                    

                    //Here, the DOM that the timer will appear using jQuery
                    document.getElementById("count").innerHTML=hours+':'+mins+':'+tempsecs;  
            }

            setInterval(function(){
                seconds -= 1;
                displaytimer();
            }, 1000);
        </script>
    </head>
    <body onload="displaytimer()">
    <div class="sidebar">
        <div class="head">Welcome <?php 
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
        }
        echo $tempName;?></div>
        </div>
        <section>
            <div id="count" class="count"></div>
            <?php
                $testCode=$_SESSION["testcodeapp"];
                $organizer=$_SESSION["organizer"];
                //test code and status to be checked from here not making this part right
                //now

                $con = mysqli_connect("127.0.0.1:3307","root","");
                mysqli_select_db($con,"examdb");
                echo '<form id="form1" method="post">';
                $questions="select * from ".$organizer."testquestions"." where testcode='".$testCode."'order by qno";
                $questionsResult=mysqli_query($con,$questions);
                //total no questions//
                $totalNoofquestions=mysqli_num_rows($questionsResult);
                echo '<input type="text" name="total" id="totalno" class="total" style="width:60px;font-weight:bold" readonly value="'.$totalNoofquestions.'">';
                echo '<label class="ltotal" for="total">The total no of questions: </label>';
                $flag=0;
                while($row=mysqli_fetch_array($questionsResult))
                {
                    if($flag==0)
                    {
                        //here i m printing the name 
                        echo '<div class="tname">Test Name : '.$row["testname"].'</div>';
                        $flag=1;
                    }
                    
                    if($row["type"]=="la")
                    {
                        //long answer
                        echo '<div id="longans" class="ques"><label style="font-size: 18px;margin: 20px;font-weight:bold" for="descques">Q.'.$row['qno'].'</label><textarea type="text" id="descriptive" name="descques" rows="4" cols="60" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" readonly>'.$row['question'].'</textarea><br>';
                        echo '<textarea name="'.$row['qno'].'" placeholder="Write ur ans here" rows="7" cols="60" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" required></textarea></div>';
                        
            
                    }
                    else
                    {
                        //mcq
                        echo '<div id="mcqtype" class="ques"><label style="font-size: 18px;margin: 20px;font-weight:bold" for="mcqques">Q.'.$row['qno'].'</label><br><textarea type="text" id="mcq" name="mcqques" rows="4" cols="50" style="border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;resize:none" readonly>'.$row['question'].'</textarea><br>';
                        echo '<input type="radio" id="options" value="A" name="'.$row['qno'].'" required><label for="A">'.$row['optionA'].'</label><br>';
                        echo '<input type="radio" id="options" value="B" name="'.$row['qno'].'" required><label for="B">'.$row['optionB'].'</label><br>';
                        echo '<input type="radio" id="options" value="C" name="'.$row['qno'].'" required><label for="C">'.$row['optionC'].'</label><br>';
                        echo '<input type="radio" id="options" value="D" name="'.$row['qno'].'" required><label for="D">'.$row['optionD'].'</label></div>';        
                    }
                }
                echo '</form>';
            ?>
            <input type="submit" class="submit" onclick="submitForm('examWindowProcess.php')" value="Submit">
        </section> 
    <body>
</html>