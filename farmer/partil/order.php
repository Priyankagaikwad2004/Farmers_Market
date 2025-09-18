<?php
session_start();
include 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Product Delivery Status</title>
    <style>
        
        body {
            background: linear-gradient(120deg, #f0f9ff, #cbebff); /* Gradient background */
            margin: 0;
            padding: 0;
            font-family: 'Roboto', Arial, sans-serif; /* Modern font */
        }

        .container {
            border: 2px solid grey;
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em; /* Increased font size */
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .product-wrapper {
            display: flex;
            gap: 30px; /* Increased gap between image and information */
            align-items: flex-start;
            margin-bottom: 30px; /* Added margin to separate sections */
        }

        .product-image {
            margin-left: 50px;
            margin-right: 100px;
            flex: 1;
            max-width: 40%;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            flex: 2;
            font-size: 1.1em; /* Increased font size */
        }

        .product-info p {
            margin: 10px 0; /* Increased margin for spacing */
        }

        .status {
            margin: 20px 0;
            padding: 15px;
            background: #dff0d8;
            border-left: 4px solid #4caf50;
            color: #4caf50;
            font-weight: bold;
            font-size: 1.2em; /* Increased font size */
        }

        .tracker {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .tracker div {
            text-align: center;
        }

        .tracker span {
            display: block;
            width: 25px; /* Increased size */
            height: 25px; /* Increased size */
            background-color: #ccc;
            border-radius: 50%;
            margin: 0 auto;
        }

        .tracker .active span {
            background-color: #4caf50;
        }

        .line {
            flex: 1;
            height: 2px;
            background: #ccc;
            position: relative;
            margin: 0 10px;
        }

        .line.completed {
            background: #4caf50;
        }

        @media (max-width: 768px) {
    .product-wrapper {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .product-image {
        margin: 0 auto;
        max-width: 80%;
    }

    .product-info {
        text-align: center;
        font-size: 1em;
    }

    .tracker {
        flex-direction: column;
        gap: 10px;
    }

    .line {
        display: none;
    }

    .navbar .menu a {
        display: block;
        margin: 10px 0;
    }

    .navbar {
        flex-direction: column;
        align-items: center;
    }
}

    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">
            <a href="../index.php"><img src="logo.png" alt="logo" width="100"></a>
        </div>
        <div class="menu">
            <a href="../index.php">Home</a>
            <a href="#order">Order</a>
        </div>
    </div>

    <?php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $email = $_SESSION['email'];
        $sql = "
            SELECT sp.product_id, sp.customer_name, sp.delivery_address, sp.build_name, sp.landmark_name, sp.pincode, sp.phone_no, sp.quantity,
                   p.product_name, p.species_name, p.farmer_name, p.weight, p.price, p.statement, p.image
            FROM sold_products sp
            JOIN sell_products p ON sp.product_id = p.product_id
            WHERE sp.user_id = '$email'
        ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total_price = $row['quantity'] * $row['price'];
    ?>
    <div class="container">
        <h1>Product Delivery Status</h1>

        <div class="product-wrapper">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($row['product_id']); ?></p>
                <p><strong>Product Name:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                <p><strong>Species Name:</strong> <?php echo htmlspecialchars($row['species_name']); ?></p>
                <p><strong>Farmer Name:</strong> <?php echo htmlspecialchars($row['farmer_name']); ?></p>
                <p><strong>Weight:</strong> <?php echo htmlspecialchars($row['weight']); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity']); ?></p>
                <p><strong>Total Price:</strong> <?php echo htmlspecialchars($total_price); ?></p>
            </div>
        </div>

        <div class="status">Your order is on its way!</div>

        <div class="tracker">
            <div class="active">
                <span></span>
                <p>Order Placed</p>
            </div>
            <div class="line completed"></div>
            <div class="active">
                <span></span>
                <p>Shipped</p>
            </div>
            <div class="line completed"></div>
            <div>
                <span></span>
                <p>Out for Delivery</p>
            </div>
            <div class="line"></div>
            <div>
                <span></span>
                <p>Delivered</p>
            </div>
        </div>
    </div>
    <?php
            }
        } else {
            echo "<p style='text-align:center; font-size:1.2em;'>No products found.</p>";
        }
    } else {
        echo "<script>alert('Please login!'); window.location.href = '../user_login.html';</script>";
    }

    $conn->close();
    ?>

    <footer>
        <p>&copy; Farmer Market<br>
        <a href="mailto:fa_market@gmail.com">fa_market@gmail.com</a></p>
    </footer>

</body>
</html>
