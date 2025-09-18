<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>farmer products profile</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-size: cover;
    overflow-x: hidden;
}

/* Add Product button */
.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 10px;
    text-decoration: none;
    margin: 10px;
    display: inline-block;
}
.button:hover {
    background-color: #000;
}

.product-container {
    overflow-x: auto;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 10px;
    border-radius: 10px;
    margin-top: 20px;
}

/* Make table responsive */
table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

th, td {
    text-align: center;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
}

img {
    border-radius: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    .button {
        font-size: 14px;
        padding: 8px 15px;
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
<body>
    <a href="../add_product.html" class="button">Add Product</a>

<div class="product-container">
<?php
session_start();
include 'db_conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
// Retrieve all records from the sell_products table
$sql = "SELECT * FROM sell_products WHERE email='$email'";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table border='1'>
            <tr>
                <th>Product Name</th>
                <th>Species Name</th>
                <th>Farmer Name</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Statement</th>
                <th>Image</th>
            </tr>";
    
    // Fetch each record and display it in the table
    while($row = $result->fetch_assoc()) { 
        echo "<tr>
                
                <td>" . htmlspecialchars($row['product_name']) . "</td>
                <td>" . htmlspecialchars($row['species_name']) . "</td>
                <td>" . htmlspecialchars($row['farmer_name']) . "</td>
                <td>" . htmlspecialchars($row['weight']) . "</td>
                <td>" . htmlspecialchars($row['price']) . "</td>
                <td>" . htmlspecialchars($row['statement']) . "</td>
                <td><img src='". htmlspecialchars($row['image']) ."' height='100px' width='100px'></td>
                <td>";
            }
            
} else {
    echo "No records found.";
}

$conn->close();
?>
</div>

</body>
</html>

