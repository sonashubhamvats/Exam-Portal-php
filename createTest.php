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
    <title>Head Create</title>
    <style>
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

        .tname{
            margin-left: 80px;
            margin-top: 25px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow:6px 6px 7px grey;
            font-weight:bold;
            font-size: 20px;
            width: 200px;
        }

        .tcode{
            margin-left: 87px;
            margin-top: 25px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow:6px 6px 7px grey;
            font-weight:bold;
            font-size: 20px;
            width: 200px;
        }

        .tdura{
            margin-left: 47px;
            margin-top: 25px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow:6px 6px 7px grey;
            font-weight:bold;
            font-size: 20px;
            width: 200px;
        }

        label{
            margin-left: 280px;
            width: 150px;
            font-size: 22px;
            margin-top: 20px;
            font-weight:bold
        }

        .submit{
            margin-left: 533px;
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

        .submit:hover{
            background: saddlebrown;
        }
    </style>
    <script>
        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
</head>
<body>
    
    <div class="sidebar">
        <div class="head">Hello <?php 
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
        <ul>
            <li><a href="head.php">Dashboard</a></li>
            <li><a href="createTest.php">Create Test</a></li>
            <li><a href="viewTestHead.php">View Tests</a></li>
            <li><a href="viewResultsHead.php">View Results</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </div>
    <section>
        <form action="createTestProcess.php" method="POST" id="questionPage">
            <label for="tname">Enter Test Name </label>
            <input class="tname" type="text" id="testname" name="tname" required>
            <br><br>
            <label for="tcode">Enter Test Code </label>
            <input class="tcode" type="text" id="testcode" name="tcode" required><br><br>
            <br><br>
            <label for="tdura">Enter Test Duration</label>
            <input class="tdura" type="text" id="testdura" name="tdura" placeholder="In minutes()" required><br><br>

            <input class="submit" type="submit" value="Submit">
        </form>
    </section>
</body>
</html>