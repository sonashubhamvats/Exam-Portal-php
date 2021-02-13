<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us</title>
    <style>
        body{
            padding: 0px;
            margin: 0px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main{
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url("https://images.pexels.com/photos/326311/pexels-photo-326311.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500");
            background-size: cover;
            background-position: center;
        }

        .container{
            position: absolute;
            border: 2px solid black;
            width: 50%;
            top: 30%;
            left: 50%;
            padding: 40px;
            transform: translate(-50%,-50%);
            background: rgba(0,0,0,0.7);
            border-radius: 30px;
            max-width: 800px;
            text-align: center;
        }
        
        h2{
            margin-top: 1px;
            font-size: 44px;
            font-weight: 500;
            color: white;
        }

        p{
            text-align: justify;
            font-weight: 300;
            color: white;
        }

        .image{
            position: absolute;
            text-align: center;
            top: 70%;
            left: 50%;
            transform: translate(-50%,-50%);
            background: transparent;
        }

        img{
            width: 25%;
            margin: 60px;
            border: 2px solid black;
            border-radius: 50%;
        }
        .names{
            width: 50%;
            display: flex;
            font-size: 24px;
            font-weight: 550;
            color: white;
            transform: translate(535px,620px);
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="container">
            <h2>About Us</h2>
            <p>Please feel free to contact us for any queries.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores quas sed unde suscipit labore ex, neque eius, nostrum dicta, placeat minus eaque! Quis cupiditate optio nisi, sed illo obcaecati reprehenderit.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia sapiente deleniti ipsam rerum, quos cumque doloribus architecto, esse, soluta veritatis odit alias adipisci voluptatem ac cusamus pariatur commodi corrupti magnam vero?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim ad architecto officiis doloribus nulla ipsam delectus porro at eius voluptate quos, consectetur illum a veritatis quibusdam quisquam! Impedit, saepe. Earum.
            </p>
        </div>
        <div class="image">
            <img src="https://instagram.fnag2-1.fna.fbcdn.net/v/t51.2885-19/s320x320/26157992_159656174668114_8152239671775068160_n.jpg?_nc_ht=instagram.fnag2-1.fna.fbcdn.net&_nc_ohc=L3Klpps8aooAX-D8Nt0&oh=323a87111cd5ae9a3e52cd5afe122804&oe=5FC8C8F5" alternate="profile">
            <img src="projectprofile.jpg" alternate="profile">
        </div>
        <div class="names">
        <div >Devansh Mehra</div> 
            <div style="margin-left: 100px;">Sona Shubham Vats</div>
        </div>
    </div>
</body>
</html>