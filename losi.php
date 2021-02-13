<?php
    session_start();
    $_SESSION["login"]="false";
    if(isset($_SESSION["allowTest"]))
    {
        unset($_SESSION["allowTest"]);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to SVDM Online Examination Solutions</title>
    <style>

        @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";
        ::placeholder {
        color: white;
        }
        body{
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: url(https://wallpaperset.com/w/full/0/d/3/363642.jpg);
        background-size: cover;
        }
        .login-box{
        width: 280px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: white;
        }
        .login-box h1{
        float: center;
        text-align: center;
        font-size: 40px;
        border-bottom: 6px solid #9b1616;
        margin-bottom: 50px;
        padding: 13px 0;
        }
        .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 1px solid #9b1616;
        }
        .textbox i{
        width: 26px;
        float: left;
        text-align: center;
        }
        .textbox input{
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px;
        }
        .btn{
        width: 100%;
        background: none;
        border: 2px solid #9b1616;
        border-radius: 10px;
        color: white;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
        }

        .btn:hover{
        background-color: black;
        color: white;
        }
    </style>
    <script>
        function onclicks(action)
        {
            var form=document.getElementById("forms1");
            var username=document.getElementById("username").value;
            var password=document.getElementById("password").value;
            if(action=='loginUpProcess.php')
            {
                if(username.length<1)
                {
                    alert("Enter the username");
                    return;
                }
                if(password.length<1)
                {
                    alert("Enter the password");
                    return;
                }
                form.action=action;
                form.submit();
            }
            else
            {

                form.action=action;
                form.submit();

            }
        }
    </script>
</head>
<body>
    <form id="forms1" method="post">
        <div class="login-box">
            <h1>Login</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input id="username" name="username" type="text" placeholder="Username">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input id="password" name="password" type="password" placeholder="Password">
            </div>
            <button class="btn" onclick="onclicks('loginUpProcess.php')">Login</button>
            Dont have an id??<button class="btn" onclick="onclicks('signUp.php')">Sign Up</button>
            <button class="btn" style="width: 40%;margin-left:60%" onclick="onclicks('main_page.php')">Back</button>
        </div>
    </form>
</body>
</html>