<!DOCTYPE html>
<html>
<head><title>Main Page</title>
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .myslides{
        display: block;
    }

    img {
        height: 100vh;
        width: 100%;
        background-position: center;
        background-size: cover;
        display: block;
    }

    /* Slideshow container */
    .slideshow-container {
    height: 100%;
    width: 100%;
    background-position: center;
    background-size: cover; 
    }
    ul{
        float: right;
        list-style-type:none;
        margin-top: 25px;
    }

    ul li{
        display: inline-block;
    }
    ul li a{
        text-decoration: none;
        color: black;
        padding: 5px 20px;
        border: 1px solid transparent;
        border-radius: 10px;
        transition: 0.6s ease;
    }

    ul li a:hover{
        background-color: black;
        color: white;
    }

    .b{
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .nav{
        font-size: 25px;
    }

    .b h1{
        color: black;
        font-size: 58px;
    }

    .main{
        position: absolute;
        top: 10%;
        left: 74%;
        transform: translate(-8%,-130%);
    }

    .button{
        position: absolute;
        top: 53%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .btn{
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px 30px;
        color: black;
        text-decoration: none;
        font-size: 25px;
        font-weight: bold;
        transition: 0.6s ease;
        background: transparent;
    }

    .btn:hover{
        background-color: black;
        color: white;
    }

    /* Fading animation */
    .fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 4s;
    animation-name: fade;
    animation-duration: 4s;
    }

    @-webkit-keyframes fade {
    from {opacity: 0.4} 
    to {opacity: 1}
    }

    @keyframes fade {
    from {opacity: 0.4} 
    to {opacity: 1}
    }

    </style>
</head>
<body>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60">
            <div class="main">
                <ul class="nav">
                <li><a href="#">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact</a></li>
                </ul>
            </div>
            <div class="b"><h1>Online Examination System</h1></div>
                <div class="button">
                    <button class="btn" onclick="to_login()">Login</button>
                    &nbsp;
                    <button class="btn" onclick="to_signup()">SignUp</button>
                </div>
            </div>
        </div>
        <div class="mySlides fade">
            <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60">
            <div class="main">
                <ul class="nav">
                <li><a href="#">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact</a></li>
                </ul>
            </div>
            <div class="b"><h1>Online Examination System</h1></div>
                <div class="button">
                    <button class="btn" onclick="to_login()">Login</button>
                    &nbsp;
                    <button class="btn" onclick="to_signup()">SignUp</button>
                </div>
            </div>
        </div>
        <div class="mySlides fade">
            <img src="https://factorialist.com/wp-content/uploads/2018/04/slide_2.jpg">
            <div class="main">
                <ul class="nav">
                <li><a href="#">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact</a></li>
                </ul>
            </div>
            <div class="b"><h1>Online Examination System</h1></div>
                <div class="button">
                    <button class="btn" onclick="to_login()">Login</button>
                    &nbsp;
                    <button class="btn" onclick="to_signup()">SignUp</button>
                </div>
            </div>
        </div>
        <div class="mySlides fade">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTDim4BFPU0KbkebRWvsGXkmshN--OoihWPeQ&usqp=CAU">
            <div class="main">
            <ul class="nav">
                <li><a href="#">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.html">Contact</a></li>
            </ul>
            </div>
            <div class="b"><h1>Online Examination System</h1></div>
                <div class="button">
                <button class="btn" onclick="to_login()">Login</button>
                &nbsp;
                <button class="btn" onclick="to_signup()">SignUp</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var slideIndex = 0;
        showSlides();
        function showSlides() 
        {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 6000); 
            }
        function to_login()
        {
            location.replace("losi.php");
        }
        function to_signup()
        {
            location.replace("signUp.php");
        }      
    </script>
</body>
</html>