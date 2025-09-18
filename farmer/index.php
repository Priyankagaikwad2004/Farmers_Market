<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Farming Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
    background: #eaeaea;
    overflow-x: hidden; /* Prevent horizontal scroll */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Make container responsive */
.container {
    position: relative;
    width: 100%;
    min-height: 100vh;
    background: #f5f5f5;
    box-shadow: 0 30px 50px #dbdbdb;
    padding-top: 80px; /* to make space for navbar */
    overflow: hidden;
}


        body {
            background: #eaeaea;
            overflow: hidden;
        }

        /* Navbar Styling */
        .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    display: flex;
    justify-content: space-between; /* Spreads elements with equal space around them */
    align-items: center; /* Aligns items vertically in the center */
    padding: 20px ; /* Adjust padding as needed */
    backdrop-filter: blur(10px);
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.logo{
    margin-left: 100px;
    right: 20px;
}


        .nav-links {
            list-style: none;
            display: flex;
            justify-content: left;
            gap: 15px;
        }

        .nav-links li {
            display: inline-block;
        }

        .nav-links a {
            text-decoration: none;
            color: black; /* Text color */
            font-size: 18px;
            padding: 8px 16px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #ddd; /* Changes color on hover */
            background-color: black;
            border-radius: 25px;
            transform: scale(1.2); /* Zoom in effect */
            box-shadow: 0 8px 16px rgb(255, 255, 255); /* Add a shadow effect on hover */
        }
                /* Hamburger Icon */
        .hamburger {
            display: none;
            font-size: 24px;
            margin-right: 20px;
            cursor: pointer;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.95);
                position: absolute;
                top: 60px;
                right: 20px;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            }

            .nav-links.show {
                display: flex;
            }

            .hamburger {
                display: block;
            }

            .logo {
                margin-left: 20px;
            }

            .nav-links a {
                font-size: 20px;
                padding: 15px;
                width: 100%;
                text-align: center;
            }

            .container {
                padding-top: 80px;
                height: auto;
            }

            .item .content {
                left: 10%;
                width: 80%;
            }

            .content .name {
                font-size: 24px;
            }

            .content .des {
                font-size: 16px;
            }

            .content button {
                font-size: 16px;
            }

            .button {
                bottom: 10px;
            }
            
        }


        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 100vh;
            background: #f5f5f5;
            box-shadow: 0 30px 50px #dbdbdb;
        }

        .container .slide .item {
    width: 200px;
    height: 300px;
    max-width: 100%;
    position: absolute;
    top: 50%;
    transform: translate(0, -50%);
    border-radius: 20px;
    box-shadow: 0 30px 50px #505050;
    background-position: center;
    background-size: cover;
    display: inline-block;
    transition: 0.5s;
}


        .slide .item:nth-child(1),
        .slide .item:nth-child(2) {
            top: 0;
            left: 0;
            transform: translate(0, 0);
            border-radius: 0;
            width: 100%;
            height: 100%;
        }
        

        .slide .item:nth-child(3) {
            left: calc(50% + 220px);
        }

        .slide .item:nth-child(4) {
            left: calc(50% + 440px);
        }

        .slide .item:nth-child(5) {
            left: calc(50% + 660px);
        }

        /* here n = 0, 1, 2, 3,... */
        .slide .item:nth-child(n + 6) {
            left: calc(50% + 880px);
            opacity: 0;
        }

        .item .content {
            position: absolute;
            top: 50%;
            left: 100px;
            width: 300px;
            text-align: left;
            color: #eee;
            transform: translate(0, -50%);
            font-family: system-ui;
            display: none;
        }
        @media (max-width: 768px) {
    .item .content {
        left:30px;
    }
}


        .slide .item:nth-child(2) .content {
            display: block;
        }

        .content .name {
            font-size: 40px;
            text-transform: uppercase;
            font-weight: bold;
            opacity: 0;
            animation: animate 1s ease-in-out 1 forwards;
        }

        .content .des {
            margin-top: 10px;
            margin-bottom: 20px;
            opacity: 0;
            animation: animate 1s ease-in-out 0.3s 1 forwards;
        }

        .content button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            opacity: 0;
            animation: animate 1s ease-in-out 0.6s 1 forwards;
        }

        @keyframes animate {
            from {
                opacity: 0;
                transform: translate(0, 100px);
                filter: blur(33px);
            }

            to {
                opacity: 1;
                transform: translate(0);
                filter: blur(0);
            }
        }

        .button {
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 20px;
        }

        .button button {
            width: 40px;
            height: 35px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin: 0 5px;
            border: 1px solid #000;
            transition: 0.3s;
        }

        .button button:hover {
            transform: scale(1.2); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); 
        }

        .pro {
    background-color: #4CAF50; /* Green background */
    border: none;              /* Remove borders */
    color: white;              /* White text */
    padding: 15px 32px;        /* Padding for size */
    text-align: center;        /* Center the text */
    text-decoration: none;     /* Remove underline */
    display: inline-block;     /* Inline block for spacing */
    font-size: 16px;           /* Increase font size */
    margin: 4px 2px;           /* Small margin around the button */
    cursor: pointer;           /* Pointer cursor on hover */
    border-radius: 12px;       /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition */
}

.pro:hover {
    background-color: black;
    box-shadow: 0 8px 16px rgb(255, 255, 255);
}


    </style>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar">
    <div class="logo"><a href="index.php"><img src="logo.png" alt="logo" width="100"></a></div>

    <div class="hamburger" id="hamburger">
        <i class="fas fa-bars"></i>
    </div>

    <ul class="nav-links" id="nav-links">
        <li><a href="index.php">Home</a></li>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<li><a href="sell.php">Sell</a></li>
                  <li><a href="partil/user_profil.php">Profile</a></li>';
        } else {
            echo '<li><a href="sell.php">Sell</a></li>
                  <li><a href="user_login.html">Login</a></li>';
        }
        ?>
    </ul>
</nav>


    <div class="container">
        <div class="slide">
            <div class="item" style="background-image: url(https://img.freepik.com/free-photo/green-tea-bud-leaves-green-tea-plantations-morning_335224-955.jpg?w=826&t=st=1726045025~exp=1726045625~hmac=9f03f4e085442412e1a503a18239d315d2b230ac2222e2f9b8ac42674e195cb7)">
                <div class="content">
                    <div class="name">Welcome</div>
                    <div class="des">Discover fresh, organic produce directly from Indian farmers. Support local agriculture and enjoy high-quality food items.</div>
                        <div class="butn">
                            <button class="home">Home</button>
                        </div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://getwallpapers.com/wallpaper/full/5/3/3/1289759-amazing-farm-wallpaper-1920x1200-lockscreen.jpg);">
                <div class="content">
                    <div class="name">Our Products</div>
                    <div class="des">Explore a wide range of organic products grown by Indian farmers. From vegetables to fruits, find everything you need.</div>
                    <a href="partil/display_product_to_user.php"><button class="pro">Products</button></a>
                </div>
            </div>
            <div class="item" style="background-image: url(https://img.freepik.com/premium-photo/hand-nurturing-young-plant-rich-soil_327191-12552.jpg?w=1380);">
                <div class="content">
                    <div class="name">Farms in India</div>
                    <div class="des">See the beautiful farms across India where our organic produce is grown. Learn about our farming practices and commitment to quality.</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://img.freepik.com/premium-photo/harvesting-fresh-lettuce-morning-sunlight_1040433-18966.jpg?w=996);">
                <div class="content">
                    <div class="name">Sustainable Farming</div>
                    <div class="des">Learn about our sustainable farming methods that help conserve the environment while producing high-quality organic food.</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://img.freepik.com/premium-photo/planting-sapling-sunset-fertile-soil_1213709-5365.jpg?w=900);">
                <div class="content">
                    <div class="name">Customer Favorites</div>
                    <div class="des">Discover the most popular organic products among our customers. Freshness and taste guaranteed!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://img.freepik.com/free-photo/front-view-woman-living-healthy-life_23-2151201998.jpg?t=st=1726045640~exp=1726049240~hmac=433aba748e28257f88c07b18cc975375187e7678bac277b420c69fb8678a3c63&w=996);">
                <div class="content">
                    <div class="name">Support Farmers</div>
                    <div class="des">Support Indian farmers by buying directly from them. Your purchase helps sustain their livelihoods and promotes local agriculture.</div>
                    <button>See More</button>
                </div>
            </div>
        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>

    <script>
        let next = document.querySelector('.next')
        let prev = document.querySelector('.prev')
        let home = document.querySelector('.home')
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('nav-links');

        next.addEventListener('click', function(){
            let items = document.querySelectorAll('.item')
            document.querySelector('.slide').appendChild(items[0])
        })

        prev.addEventListener('click', function(){
            let items = document.querySelectorAll('.item')
            document.querySelector('.slide').prepend(items[items.length - 1])
        })

        home.addEventListener('click', function(){
            window.location.href ="index.html";
        })

        hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('show');
    });

    // Optional: Close menu when a link is clicked
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('show');
        });
    });
    </script>

</body>
</html>
