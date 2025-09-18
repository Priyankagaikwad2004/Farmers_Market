<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page with Buttons and Address Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .buttons {
            margin-bottom: 20px;
        }
        .buttons button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="buttons">
    <button onclick="location.href='logout.php'">Logout</button>
    <button onclick="location.href='cart.php'">Cart</button>
    <button onclick="location.href='myproduct.php'">My Product</button>
</div>

<div class="form-container">
    <h2>Enter Address Details</h2>
    <?php
    // Initialize variables
    $name = $address = $city = $zip = "";

    // Handle form submission
    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $zip = htmlspecialchars($_POST['zip']);

        // Store data in a file (you can replace this with database storage)
        $data = "Name: $name\nAddress: $address\nCity: $city\nZIP Code: $zip\n\n";
        file_put_contents("addresses.txt", $data, FILE_APPEND);
    }
    ?>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
        
        <label for="address">Address:</label><br>
        <textarea id="address" name="address" rows="4" cols="50" required><?php echo $address; ?></textarea><br><br>
        
        <label for="city">City:</label><br>
        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required><br><br>
        
        <label for="zip">ZIP Code:</label><br>
        <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>" required><br><br>
        
        <button type="submit" name="submit">Submit</button>
    </form>
</div>

</body>
</html>
