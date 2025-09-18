<?php
session_start();   

include 'db_conn.php';
       

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $cname = $_POST['cname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $building = $_POST['building'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $user_id=$_SESSION['email'];

    $sql = "INSERT INTO profile_info ( email, first_name,last_name, addres, building_name, landmark, pincode, phone_no)
    VALUES('$user_id','$cname','$lname','$address','$building','$landmark','$pincode','$phone');";


    $result = mysqli_query($conn, $sql);
    echo "<script>alert('Information saved...!');window.location.href = 'display_product_to_user.php';</script>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Profile</title>
    <style>
        body, html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://img.freepik.com/free-photo/3d-wooden-table-leaves-against-defocused-landscape_1048-10839.jpg?t=st=1736416139~exp=1736419739~hmac=b88e263c0f266f89d55b9a495b6617fbac995dfa3f49eea617513ea54305a3c1&w=1060') no-repeat center center fixed;
            background-size: cover;
            /* background-attachment: fixed;
            background: linear-gradient(135deg,rgb(255, 181, 200),rgb(223, 170, 255),rgb(116, 243, 192)); */
        }

        .navbar{    background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar .a {
                    text-decoration: none;
                    color: black;
                    margin-left: 20px;
                    padding: 8px 16px;
                    border-radius: 10px;
                    transition: background-color 0.3s ease;
                }

            .navbar .a:hover {
                background-color: transparent;
                box-shadow: 0 6px 8px rgb(255, 255, 255);
            }

            .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    position: relative;
    z-index: 10;
}

.hamburger {
    display: none;
    font-size: 28px;
    cursor: pointer;
    color: black;
}

.menu {
    display: flex;
    gap: 20px;
}

@media (max-width: 768px) {
    .menu {
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

    .hamburger {
        display: block;
    }

    .menu.show {
        display: none;
    }
}




.form-container {
    margin-top: 50px;
    background-color: rgba(0, 0, 0, 0.5);    border-radius: 18px;
    /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); */
    width: 90%;
    max-width: 800px;
    padding: 20px;
}

form {
    margin: 0;
}

h2 {
    text-align: center;
    color:rgb(255, 255, 255);
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color:rgb(255, 255, 255);
    font-weight: bold;
}

input[type="text"],
input[type="tel"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

textarea {
    resize: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

.horizontal-group {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.half-width {
    flex: 1;
}

@media (max-width: 600px) {
    .horizontal-group {
        flex-direction: column;
    }
}
/* 
.log-out:hover{
    box-shadow: 0 6px 8px rgb(255, 72, 72);
} */
        
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <a href="../index.php"><img src="logo.png" alt="logo" width="100"></a>
    </div>

    <div class="hamburger" id="hamburger">&#9776;</div>

    <div class="menu" id="menu">
        <a class="a" href="../index.php">Home</a>
        <a class="a" href="cart.php">Cart</a>
        <a class="a" href="order.php">My Order</a>
        <a class="a" href="logout.php" onmouseover="this.style.boxShadow='0 6px 8px rgb(255, 72, 72)';" onmouseout="this.style.boxShadow='none';">LogOut</a>
    </div>
</div>



<center><div class="form-container">

    <?php
    
    $name = $address = $city = $zip = "";
    $user_id = $_SESSION['email'];

    $sql = "SELECT * FROM profile_info WHERE email='$user_id'";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone_no = $row['phone_no'];
        $addres = $row['addres'];
        $landmark = $row['landmark'];
        $pincode = $row['pincode'];
        $building_name = $row['building_name'];
         ?>

        <form action="update_user_information.php" method="post">
                    <h2>Welcome, <?php echo $row['email']; ?></h2>
                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="cname">Customer Name:</label>
                            <input type="text" id="cname" name="cname" placeholder="Enter first name" value="<?php echo $first_name; ?>" required>
                        </div>
                        <div class="half-width">
                            <label for="surname">Last Name:</label>
                            <input type="text" id="lastname" name="lname" placeholder="Enter Last Name" value="<?php echo $last_name; ?>" required>
                        </div>
                    </div>

                    <label for="address">Delivery Address:</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address" value="<?php echo $addres; ?>" required>

                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="building">Building Name/Number:</label>
                            <input type="text" id="building" name="building" placeholder="Building Name/Number" value="<?php echo $building_name; ?>" required>
                        </div>
                        <div class="half-width">
                            <label for="landmark">Landmark:</label>
                            <input type="text" id="landmark" name="landmark" placeholder="Landmark" value="<?php echo $landmark; ?>" required>
                        </div>
                    </div>

                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="pincode">PIN Code:</label>
                            <input type="text" id="pincode" name="pincode" placeholder="Enter PIN code" value="<?php echo $pincode; ?>" required>
                        </div>
                        <div class="half-width">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo $phone_no; ?>" required>
                        </div>
                    </div>

                    <button type="submit">Update</button>
        </form>
<?php }} else {
    ?>

    <form action="user_profil.php" method="post" id="address-form">
                    <h2>Confirm Order</h2>
                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="cname">Customer Name:</label>
                            <input type="text" id="cname" name="cname" placeholder="Enter first name"  required>
                        </div>
                        <div class="half-width">
                            <label for="surname">Last Name:</label>
                            <input type="text" id="lastname" name="lname" placeholder="Enter Last Name"  required>
                        </div>
                    </div>

                    <label for="address">Delivery Address:</label>
                    <textarea id="address" name="address" rows="3" placeholder="Enter your address"  required></textarea>

                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="building">Building Name/Number:</label>
                            <input type="text" id="building" name="building" placeholder="Building Name/Number" required>
                        </div>
                        <div class="half-width">
                            <label for="landmark">Landmark:</label>
                            <input type="text" id="landmark" name="landmark" placeholder="Landmark" required>
                        </div>
                    </div>

                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="pincode">PIN Code:</label>
                            <input type="text" id="pincode" name="pincode" placeholder="Enter PIN code" required>
                        </div>
                        <div class="half-width">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
                        </div>
                    </div>

                    <button type="submit">Save</button>
    </form> <?php } ?>
</div>
</center>
<script>
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');

    // Toggle menu on hamburger click
    hamburger.addEventListener('click', function () {
        menu.classList.toggle('show');
    });
    

</script>


</body>
</html>
