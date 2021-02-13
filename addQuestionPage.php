<?php
    session_start();
    if($_SESSION["login"]!="true")
    {
        header("location:losi.php");
    }
    else
    {
        if(!isset($_SESSION["testcode"]))
        {
            header("location:createTest.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Head Main</title>
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
        input,select
        {
            margin: 20px;
        }
        button{
            margin-top: 25px;
            margin-bottom: 25px;
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

        .addmcq{
            margin-left: 280px;
        }
        button:hover,.submit:hover{
            background: saddlebrown;
        }

        .total{
            float: right;
            margin-top: 25px;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        label{
            float: right;
            width: 150px;
            font-size: 18px;
            margin-top: 20px;
            font-weight:bold
        }

        .submit{
            float: right;
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
    <script>
        var count=0;
        function onInsertLong()
        {
            count++;
            var formm=document.getElementById("questionPage");
            var questionNo=document.createTextNode("Q"+count+" (Long AnswerType)");
            var breakk=document.createElement("BR");
            var divv=document.createElement("div");
            divv.setAttribute("class","ques");
            var spann=document.createElement("span");
            spann.innerHTML="<br>";
            var inputfield=document.createElement("input");
            inputfield.setAttribute("type","text");
            inputfield.setAttribute("name",count);
            inputfield.setAttribute("style","width:85%;height:70px; border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            inputfield.setAttribute("placeholder","Enter ur question");
            inputfield.setAttribute("required","required");

            var marks=document.createElement("input");
            marks.setAttribute("type","text");
            marks.setAttribute("name",count+"m");
            marks.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            marks.setAttribute("placeholder","Enter Max Marks");
            marks.setAttribute("required","required");

            divv.appendChild(questionNo);
            divv.appendChild(spann);
            divv.appendChild(inputfield);
            divv.appendChild(marks);
            formm.appendChild(divv);
            
            document.getElementById("totalNo").value=count;

        }
        function onInsertMcq()
        {
            count++;
            var formm=document.getElementById("questionPage");
            var questionNo=document.createTextNode("Q"+count+" (MCQ)");
            var breakk=document.createElement("BR");
            var divv=document.createElement("div");
            divv.setAttribute("class","ques");
            var spann=document.createElement("span");
            spann.innerHTML="<br>";
            var inputfield=document.createElement("input");
            inputfield.setAttribute("type","text");
            inputfield.setAttribute("name",count);
            inputfield.setAttribute("style","width:85%;height:50px;border:2px solid black;border-radius: 10px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            inputfield.setAttribute("placeholder","Enter ur question");
            inputfield.setAttribute("required","required");

            var optionA=document.createElement("input");
            optionA.setAttribute("type","text");
            optionA.setAttribute("name",count+"a");
            optionA.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            optionA.setAttribute("placeholder","Option A");
            optionA.setAttribute("required","required");
            
            var optionB=document.createElement("input");
            optionB.setAttribute("type","text");
            optionB.setAttribute("name",count+"b");
            optionB.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            optionB.setAttribute("placeholder","Option B");
            optionB.setAttribute("required","required");

            var optionC=document.createElement("input");
            optionC.setAttribute("type","text");
            optionC.setAttribute("name",count+"c");
            optionC.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            optionC.setAttribute("placeholder","Option C");
            optionC.setAttribute("required","required");

            var optionD=document.createElement("input");
            optionD.setAttribute("type","text");
            optionD.setAttribute("name",count+"d");
            optionD.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            optionD.setAttribute("placeholder","Option D");
            optionD.setAttribute("required","required");

            var list=document.createElement("SELECT");
            list.setAttribute("name",count+"e");
            list.setAttribute("id",count+"E");

            var optioncorrect=document.createElement("option");
            optioncorrect.setAttribute("value","null");
            var t=document.createTextNode("Correct Option");
            optioncorrect.appendChild(t);
            list.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;color:grey;font-weight:bold;font-size:16px;");

            var A=document.createElement("option");
            A.setAttribute("value","A");
            var a=document.createTextNode("Option A");
            A.appendChild(a);
            list.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;color:grey;font-weight:bold;font-size:16px;");

            var B=document.createElement("option");
            B.setAttribute("value","B");
            var b=document.createTextNode("Option B");
            B.appendChild(b);
            list.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;color:grey;font-weight:bold;font-size:16px;");

            var C=document.createElement("option");
            C.setAttribute("value","C");
            var c=document.createTextNode("Option C");
            C.appendChild(c);
            list.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;color:grey;font-weight:bold;font-size:16px;");

            var D=document.createElement("option");
            D.setAttribute("value","D");
            var d=document.createTextNode("Option D");
            D.appendChild(d);
            list.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;color:grey;font-weight:bold;font-size:16px;");

            var marks=document.createElement("input");
            marks.setAttribute("type","number");
            marks.setAttribute("name",count+"m");
            marks.setAttribute("style","width:30%;height:30px;border:2px solid black;border-radius: 6px;box-shadow:6px 6px 7px grey;font-weight:bold;font-size:16px;");
            marks.setAttribute("placeholder","Enter Max Marks");
            marks.setAttribute("required","required");

            divv.appendChild(questionNo);
            divv.appendChild(spann);
            divv.appendChild(inputfield);
 
            divv.appendChild(optionA);
            divv.appendChild(optionB);

            divv.appendChild(optionC);
            divv.appendChild(optionD);

            divv.appendChild(list);
            divv.appendChild(marks);

            formm.appendChild(divv);

            document.getElementById(count+"E").appendChild(optioncorrect);
            document.getElementById(count+"E").appendChild(A);
            document.getElementById(count+"E").appendChild(B);
            document.getElementById(count+"E").appendChild(C);
            document.getElementById(count+"E").appendChild(D);
            document.getElementById("totalNo").value=count;
            
        }
        function ondelete()
        {
            var formm=document.getElementById("questionPage");
            var countt=formm.childElementCount;
            
            if(countt>3)
            {
                formm.removeChild(formm.lastElementChild);
                count-=1;
            }
            
            document.getElementById("totalNo").value=count;
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
            <li><a href="backFromCreateTest.php">Back</a></li>
        </ul>
    </div>
    <section>
    <form action="uploadQuestion.php" method="POST" id="questionPage">
        
        <input class="submit" type="submit" value="Submit">
        <input class="total" type="text" id="totalNo" name="total" style="width: 50px;font-weight:bold" readonly>
        <label for="total">The total no of questions added: </label>

    </form>
    <button class="addmcq" onclick="onInsertMcq()">
        Add MCQ 
    </button>
    &nbsp;&nbsp;&nbsp;
    <button onclick="onInsertLong()">
        Add LongAnswer
    </button>
    &nbsp;&nbsp;&nbsp;
    <button onclick="ondelete()">
        Delete
    </button>
    </section>
</body>
</html>