<?php
        session_start();
        if($_POST)
        {
            if($_POST["username"]!=""&&$_POST["password"]!="")
            {
                $username=$_POST["username"];
                $password=$_POST["password"];
                $organization="";
                $role="";
                $name="";
                $con = mysqli_connect("127.0.0.1:3307","root","");
                mysqli_select_db($con,"examdb");
                $sel="select Name,Username,Password,Role,Organization from entity";
                $flag=0;
                $sq=mysqli_query($con,$sel);
                while ($row=mysqli_fetch_array($sq))
                {
                    if($row['Username']==$username)
                    {
                        if($row['Password']==$password)
                        {
                            $flag=1;
                            $role=$row['Role'];
                            $name=$row['Name'];
                            $organization=$row['Organization'];
                            echo $organization;
                        }
                    }
                }
                if($flag==0)
                {
                    echo "<h3 style='text-align: center'>Either username or password is not correct</h3>";
                }
                else
                {
                    $_SESSION["login"]="true";
                    $_SESSION["username"]=$username;
                    $_SESSION["name"]=$name;
                    $_SESSION["Org"]=$organization;
                    $_SESSION['role']=$role;
                    $_SESSION["testname"]="null";
                    $_SESSION["testcode"]="null";
                    header("location:$role.php");
                    //?$username-$name
                }
            }
        }
    ?>
