<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
         body{
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(https://wallpaperset.com/w/full/0/d/3/363642.jpg);
            background-size: cover;
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
            border-bottom: 5px solid #9b1616;
            padding: 10px 0;
            font-size:40px;
            font-weight:bold;
            color:white;
        }

        .add{
            font-size:20px;
            color:white;
        }
    </style>
    <script>
        var valid=0;
        function checkTheRole()
        {
            var role=document.getElementById("role").value;
            if(role=="Applicant")
            {
                var table=document.getElementById("signUpTable");
           
                var row_count=table.rows.length;
                
                row_count-=1;
                if(row_count==6)
                {                
                    var row=table.insertRow(row_count);

                    var cell1=row.insertCell(0);
                    cell1.innerHTML="Applicant-Common-Password- ";
                    cell1.setAttribute("id","ctext");
                    var cell2=row.insertCell(1);
                    var input=document.createElement("input");
                    input.setAttribute("type","password");
                    input.setAttribute("name","cpassword");
                    input.setAttribute("id","cpassword");
                    cell2.appendChild(input);
                    document.getElementById("ctext").style.color="white";                    
                    document.getElementById("ctext").style.fontSize="20px";
                }
                else
                {

                    document.getElementById("ctext").innerHTML="Applicant-Common-Password- ";
                                       
                }
            }
            else if(role=="Head")
            {
                var table=document.getElementById("signUpTable");
           
                var row_count=table.rows.length;
                
                row_count-=1;
                if(row_count==6)
                {
                    
                    var row=table.insertRow(row_count);

                    var cell1=row.insertCell(0);
                    cell1.innerHTML="Head-Common-Password- ";
                    cell1.setAttribute("id","ctext");
                    var cell2=row.insertCell(1);
                    var input=document.createElement("input");
                    input.setAttribute("type","password");
                    input.setAttribute("name","cpassword");
                    input.setAttribute("id","cpassword");
                    cell2.appendChild(input);
                    document.getElementById("ctext").style.color="white";
                    document.getElementById("ctext").style.fontSize="20px";
                }
                else
                {
                    document.getElementById("ctext").innerHTML="Head-Common-Password- ";
                                       

                }
            }
            else
            {
                var table = document.getElementById("signUpTable");
			    var row_count = table.rows.length;
                row_count-=2;
                
                table.deleteRow(row_count);
            }
        }
        function signIn()
        {
            var form=document.getElementById("forms1");
            var table=document.getElementById("signUpTable");           
            var row_count=table.rows.length;
            var name=document.getElementById("name").value;
            var username=document.getElementById("username").value;
            var password=document.getElementById("password").value;
            var role=document.getElementById("role").value;
            var company=document.getElementById("company").value;
            if(row_count==7)
            {
                alert("Enter all the details");
                valid=0;
                return;
            }
            else
            {
                var regex = /^[A-Za-z][A-Za-z0-9]+$/;
                var isValid = regex.test(username);
                if(!isValid)
                {
                    alert("Invalid Username-cant include any special characters or starting with a number")
                    valid=0;
                    return;
                }
                
                var commonPassword=document.getElementById("cpassword").value;
                if(name.length<1)
                {
                    alert("Fill In the Name");
                    valid=0;
                    return;
                }
                if(password.length<1)
                {
                    alert("Fill in the password");
                    valid=0;
                    return;
                }
                if(role=="Select")
                {
                    alert("Select ur role smh");
                    valid=0;
                    return;
                }
                if(company=="Choose")
                {
                    alert("Choose ur Organization");
                    valid=0;
                    return;
                }
                if(commonPassword.length<1)
                {
                    alert("Fill in the common password");
                    valid=0;
                    return;
                }
                action="signUpProcess.php";
                valid=1;
                form.action=action;
                form.submit();
            }
        }
    </script>
</head>
<body>

    <form id="forms1" method="post">
        <table style="margin-top:5%;" class="middle" id="signUpTable">
            <tr>
                <td colspan="2" align="center"><span class="heading">SignUp</span></td>
            </tr>
            <tr>
                <td class="add">Name</td>
                <td><input class="textbox" id="name" type="text" name="name"></td>
            </tr>

            <tr>
                <td class="add">Choose your username</td>
                <td><input class="textbox" id="username" type="text" name="username"></td>
            </tr>
            <tr>
                <td class="add">Choose your password</td>
                <td><input class="textbox" id="password" type="password" name="password"></td>
            </tr>
            <tr>
                <td class="add">Choose your role-</td>
                <td>
                    <select class="textbox" name="rolee" id="role" onchange="checkTheRole()">
                        <option value="Select">Select Ur role..</option>
                        <option value="Applicant">Applicant</option>
                        <option value="Head">Head</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="add">Enter your Organization Name-</td>
                <td>
                    <select class="textbox" id="company" name="company">
                        <option value="Choose">Choose your Organization</option>
                        <?php
                            $con = mysqli_connect("127.0.0.1:3307","root","");
                            mysqli_select_db($con,"examdb");
                            $sel='select Organization from passwords';
                            
                            $sq=mysqli_query($con,$sel);
                            while ($row=mysqli_fetch_array($sq))
                            {
                                echo "<option value=".$row['Organization'].">".$row['Organization']."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center" ><button class="reg" onclick="signIn()">Sign In</button></td>
            </tr>
        </table>
    </form>
</body>
</html>