<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Farmer Sold Products</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f5f5f5;
    }

    /* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 15px 30px;
    background-color: #2e7d32;
    color: white;
    position: relative;
}

.navbar .menu {
    display: flex;
    gap: 20px;
}

.navbar .menu a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.navbar .menu a:hover {
    color: #ddd;
}

/* Hamburger Icon */
.menu-toggle {
    display: none;
    font-size: 24px;
    margin-right: 20px;
    cursor: pointer;
}

/* Responsive Navbar */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    .navbar .menu {
        display: none;
        color:black;
        flex-direction: column;
        background: rgba(255, 255, 255, 0.95);
        position: absolute;
        top: 60px;
        right: 20px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .navbar .menu.show {
        color: black;
        display: flex;
    }

    .navbar .menu a {
        margin: auto;
        color: black;
        padding: 10px 0;
    }
}

    h1 {
        text-align: center;
        margin-top: 30px;
        color: #2e7d32;
    }

    .table-container {
        overflow-x: auto;
        background-color: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: 30px auto;
        max-width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 1000px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    caption {
        font-weight: bold;
        font-size: 1.2em;
        margin-bottom: 10px;
        color: #333;
    }

    img {
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar .menu {
            margin-top: 10px;
        }

        table {
            font-size: 14px;
        }

        th, td {
            padding: 6px;
        }

        img {
            width: 80px;
            height: 80px;
        }
    }
</style>

</head>
<body>
<nav class="navbar">
        <div class="logo">
            <a href="../index.php"><img src="logo.png" alt="logo" width="100"></a>
        </div>

        <div class="menu-toggle" id="menu-toggle">&#9776;</div>

        <div class="menu" id="menu">
            <a href="../index.php">Home</a>
            <a href="farmer_account.php">Back</a>
        </div>
    </nav>

    <h1>SOLD PRODUCTS LIST</h1>

    <?php
    session_start();
    include 'db_conn.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email'];

    // Query to join sold_products and sell_products based on product_id
    $sql = "
        SELECT sp.product_id, sp.customer_name, sp.last_name, sp.delivery_address, sp.build_name, sp.landmark_name, sp.pincode, sp.phone_no, sp.quantity, 
               p.product_name, p.species_name, p.farmer_name, p.weight, p.price, p.statement, p.image
        FROM sold_products sp
        JOIN sell_products p ON sp.product_id = p.product_id
        WHERE sp.email = '$email'
    ";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-container'><table>
            <caption>Sold Products with Details</caption>
            <tr>
                
                <th>Customer Name</th>
                <th>Last Name</th>
                <th>Delivery Address</th>
                <th>Build Name</th>
                <th>Landmark Name</th>
                <th>Pincode</th>
                <th>Phone Number</th>
                <th>Product Name</th>
                <th>Species Name</th>
                <th>Farmer Name</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Statement</th>
                <th>quantity</th>
                <th>Image</th>
            </tr>";

        // Fetch and display each row of data
        while ($row = $result->fetch_assoc()) {

            echo "<tr>
                    <td>" . htmlspecialchars($row['customer_name']) . "</td>
                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                    <td>" . htmlspecialchars($row['delivery_address']) . "</td>
                    <td>" . htmlspecialchars($row['build_name']) . "</td>
                    <td>" . htmlspecialchars($row['landmark_name']) . "</td>
                    <td>" . htmlspecialchars($row['pincode']) . "</td>
                    <td>" . htmlspecialchars($row['phone_no']) . "</td>
                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                    <td>" . htmlspecialchars($row['species_name']) . "</td>
                    <td>" . htmlspecialchars($row['farmer_name']) . "</td>
                    <td>" . htmlspecialchars($row['weight']) . "</td>
                    <td>" . htmlspecialchars($row['price']) . "</td>
                    <td>" . htmlspecialchars($row['statement']) . "</td>
                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                    <td><img src='" . htmlspecialchars($row['image']) . "' height='100px' width='100px'></td>
                  </tr>";
        }

        echo "</table></div>";
    } else {
        echo "<p>No sold products found.</p>";
    }

    $conn->close();
    ?>
    <script>
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    toggle.addEventListener('click', () => {
        menu.classList.toggle('show');
    });
</script>

</body>
</html>