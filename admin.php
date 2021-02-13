<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="table.css">
    <style>
        body{
            background-image: url(https://wallpaperset.com/w/full/0/d/3/363642.jpg);
        }
        td
        {
            padding: 20px;
        }
        .middle
        {
            margin-top: 12%;
            margin-right: auto;
            margin-left: auto;
        }

        *{
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .reg{
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px 30px;
            color: black;
            text-decoration: none;
            font-size: 25px;
            font-weight: bold;
            transition: 0.6s ease;
        }

        .reg:hover{
            background-color: black;
            color: white;
        }

        .heading{
            font-size:50px;
            font-weight:bold;
            color:white;
        }

        .add{
            font-size:20px;
            color:white;
        }

    </style>
</head>
<body>
    <form id="forms1" method="post" action="admin.php">
        <table  class="middle" id="signUpTable">
            <tr>
                <td align="center" colspan="2"><span class="heading">Admin<span></td>
            </tr>
            <tr>
                <td class="add">Add Organization</td>
                <td><input class="textbox" type="text" name="organization"></td>
            </tr>

            <tr>
                <td class="add">Add Head Password</td>
                <td><input class="textbox" type="text" name="hpassword"></td>
            </tr>
            <tr>
                <td class="add">Add Applicant Password</td>
                <td><input class="textbox" type="text" name="apassword" require></td>
            </tr>

            <tr>
                <td colspan="2" style="text-align:center"><input class="reg" type="submit" value="Register"></td>
            </tr>
        </table>
    </form>
    <?php
       if($_POST)
       {
            if($_POST["organization"]!=""&&$_POST["hpassword"]!=""&&$_POST["apassword"]!="")
            {
                $organization_name=$_POST["organization"];
                $hpassword=$_POST["hpassword"];
                $apassword=$_POST["apassword"];
                $con = mysqli_connect("127.0.0.1:3307","root","");
                mysqli_select_db($con,"examdb");
                $sel='select Organization from passwords';
                $flag=0;
                $sq=mysqli_query($con,$sel);
                while ($row=mysqli_fetch_array($sq))
                {
                    if($row['Organization']==$organization_name)
                    {
                        $flag=1;
                    }
                }
                if($flag==1)
                {
                    echo "<h3 style='text-align:center'>Organization is already registered!!</h3>";
                }
                else
                {
                    $sel="insert into passwords (Organization,HPassword,APassword) values ('$organization_name','$hpassword','$apassword')";
                    $sq=mysqli_query($con,$sel);
                    echo mysqli_error($con);
                    
                }
                
            }
       }
    ?>
</body>
</html>