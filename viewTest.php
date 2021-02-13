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
    <title>Student Main</title>
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

        .teacher{
            margin-left: 280px;
            margin-top: 25px;
            width: 190px;
            height:30px;
            border:2px solid black;
            border-radius: 6px;
            box-shadow:6px 6px 7px grey;
            color:grey;
            font-weight:bold;
            font-size:16px;
        }

        .showtest{
            border: 2px solid black;
            width: 40%;
            margin-top: 25px;
            margin-left: 280px;
            padding: 15px;
            background: white;
            border-radius: 30px;
        }
    </style>
    <script>
        var count=0;
        function disp()
        {   
            var formm=document.getElementById("displaytest");
            var br=document.createElement("BR");
            var br1=document.createElement("BR");
            var teacher=document.getElementById("teacher").value;
            if(teacher!="Select Organizer")
            {
                if(count==0){
                    var testcode=document.createElement("input");
                    testcode.setAttribute("type","text");
                    testcode.setAttribute("id","tc");
                    testcode.setAttribute("name","testcode");
                    testcode.setAttribute("style","width:150px;margin-left:280px;height:50px;border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
                    testcode.setAttribute("placeholder","Enter the test code");
                    testcode.setAttribute("required","required");

                    var testsumbit=document.createElement("button");
                    testsumbit.setAttribute("value","Submit");
                    var submit=document.createTextNode("Submit");
                    testsumbit.appendChild(submit);
                    testsumbit.setAttribute("style","margin-left:280px;width: 150px;background: black;color: white;border: none;cursor: pointer;padding: 10px;border-radius: 5px;transition: 0.6s ease;font-size: 16px;");
                    formm.appendChild(testcode);
                    formm.appendChild(br);
                    formm.appendChild(br1);
                    formm.appendChild(testsumbit);
                    count=count+1;
                }
            }
            else {
                formm.removeChild(testsumbit);
            }
            
        }
    </script>
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
                echo "$tempName";
            }?>
        </div>
        <ul>
            <li><a href="applicant.php">Dashboard</a></li>
            <li><a href="viewtest.php">View Tests</a></li>
            <li><a href="viewResultsApplicant.php">View Results</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </div>
    <section>
        <form action="viewTestProcess.php" method="post" id="displaytest">
            <select  class="teacher" id="teacher" name="teacher" onchange="disp()">
                <option selected disabled value="null">Select Organizer</option>
                <?php
                    $con = mysqli_connect("127.0.0.1:3307","root","");
                    mysqli_select_db($con,"examdb");
                    $sqlQuery="select * from entity where 
                    Role='Head' and Organization='".$_SESSION["Org"]."'";
                    $sq=mysqli_query($con,$sqlQuery);
                    while($row=mysqli_fetch_array($sq))
                    {
                        echo "<option value='".$row['Username']."'>".$row['Username']."</option>";
                    }
                ?>
            </select>
            <br><br>
        </form>
    </section>
</body>
</html>