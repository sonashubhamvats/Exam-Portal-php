<?php
    $to = "kumar.vikram07@gmail.com";
    $from = $_POST["email"];
    $message = $_POST["feed"];
    $res=mail($to, $from, $message);
    if($res) 
    {
        header("location:contactus.html");
        echo '<div style="color:red;font-size:22px;">Email sent successfully!</div>';
    } 
    else 
    {
        echo '<div style="color:red;font-size:22px;">Failure in sending email</div>';
    }

?>
