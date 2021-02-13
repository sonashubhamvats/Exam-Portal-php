<?php                        
    $name=$_POST["name"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $role=$_POST["rolee"];
    $company=$_POST["company"];
    $cpassword=$_POST["cpassword"];
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $sel='select * from passwords';
    $flag=0;
    $sq=mysqli_query($con,$sel);
    while ($row=mysqli_fetch_array($sq))
    {
        if($company==$row['Organization'])
        {
            if($role=="Applicant")
            {
                if($cpassword!=$row['APassword'])
                {
                    $flag=1;
                    echo "<h3>The Common Password used in the sign in is not correct contact ur head or try again</h3>";
                }
            }
            else
            {
                if($cpassword!=$row['HPassword'])
                {
                    $flag=1;
                    echo "<h3>The Common Password used in the sign in is not correct contact ur admin or try again</h3>";
                }

            }
        }
    }
    if($flag==0)
    {
        
        $sqq="select * from entity where Username='$username'";
        $sq=mysqli_query($con,$sqq);
        $num_rows = mysqli_num_rows($sq);
        if($num_rows>0)
        {
            $flag=1;
            echo "The username already exists try something other";
        }
        if($flag==0)
        {
            $sel="insert into entity (Name,Username,Password,Role,Organization) values ('$name','$username','$password','$role','$company')";
            $sq=mysqli_query($con,$sel);
            if(!mysqli_error($con))
            {
                header("Location:losi.php");   
                exit();
            }
        }
    }
?>
