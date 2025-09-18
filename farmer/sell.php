<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell - Farmer's Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('https://img.freepik.com/free-photo/still-life-various-plant-soil_23-2148198715.jpg?t=st=1736411249~exp=1736414849~hmac=c81a81a49d339456d33c1908ea0bfb6719dd6eeccd0e7a7ac0b84708e06b1a9f&w=996');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden; /* Prevents scrolling */
        }

        /* Styling for Smaller Home and Account Buttons */
        .main-buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            animation: slideIn 1.5s ease;
            justify-content: center;
            width: 100%;
        }

        .main-buttons a {
            text-decoration: none;
        }

        .main-buttons button {
            padding: 10px 20px; /* Smaller size */
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background: linear-gradient(135deg, #FFD6E0, #C490E4, #89CFF0); /* Lighter variation of Pink, Purple, and Blue */
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .main-buttons button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #FF8C9C, #B788E6, #7EC8E3); /* Slightly different gradient on hover */
        }

        /* Transparent Box for Additional Buttons */
        .transparent-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 2s ease-in-out;
            max-width: 600px;
            width: 90%;
        }

        .buttons-3 {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .buttons-3 button {
            padding: 12px 25px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, #FF7EB9, #9B5DE5, #57C7FF); /* Original Pink, Purple, and Blue gradient */
            color: white;
            margin: 5px;
        }

        .buttons-3 button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #FF5C8A, #8A2BE2, #4A90E2); /* Slightly different gradient on hover */
        }

        .para {
            text-align: center;
            margin-top: 20px;
            color: #333;
            font-size: 22px;
            font-weight: bold;
            animation: fadeIn 2s ease;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Home and Account Buttons -->
    <div class="main-buttons">
        <a href="index.php"><button>Home</button></a>
        <!-- <a href="partil/farmer_account.php"><button>Account</button></a> -->
    </div>


        <div class="transparent-box">
            <div class="buttons-3">
                <a href="farmersignup.html">
                    <button class="button-fa">Register</button>
                </a>
                <a href="add_product.html">
                    <button class="button-faa">ADD Products</button>
                </a>
                <a href="partil/farmer_account.php">
                    <button class="button-faaa">Account</button>
                </a>
            </div>
            <div class="para"><p class="para-p">SELL WITH FARMERS MARKET</p></div>
        </div>
    

    <script>
        function showAlert() {
            alert("You already have an account!");
        }
    </script>
</body>

</html>
