<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <title>Product Delivery Status</title>
    <style>
        /* Base Styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 5%;
    background-color:  #46C848; /* Navbar background color */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    flex-wrap: wrap;
}

.logo img {
    height: 40px;
}

.menu a {
    margin-left: 20px;
    font-size: 16px;
    color: black;
    text-decoration: none;
}


.cart {
    margin: 50px 5%;
}

.cart-items-title {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1fr 1fr 1fr 0.5fr;
    align-items: center;
    color: gray;
    font-size: max(1vw, 12px);
}

.cart-items-item {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1fr 1fr 1fr 0.5fr;
    align-items: center;
    margin: 10px 0;
    font-size: max(1vw, 14px);
}

.cart-items-item img {
    width: 40px;
    max-width: 100%;
}

.cart hr {
    height: 1px;
    background-color: #e2e2e2;
    border: none;
}

.cross {
    cursor: pointer;
}

.cart-bottom {
    margin-top: 50px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 40px;
}

.cart-total {
    flex: 1;
    min-width: 250px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.cart-total-details {
    display: flex;
    justify-content: space-between;
    color: #555;
}

.cart-total hr {
    margin: 10px 0;
}

.cart-total button {
    border: none;
    color: white;
    background-color: tomato;
    width: 100%;
    padding: 12px;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.cart-total button:hover {
    background-color: #e5533c;
}

footer {
    text-align: center;
    margin-top: 50px;
    padding: 20px;
    background-color: #f8f8f8;
}

a {
    text-decoration: none;
    color: black;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-items-title,
    .cart-items-item {
        grid-template-columns: 1fr 1fr;
        grid-row-gap: 10px;
    }

    .cart-items-title p,
    .cart-items-item p {
        font-size: 14px;
    }

    .cart-items-item img {
        width: 35px;
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .cart-bottom {
        flex-direction: column;
        align-items: center;
    }

    .cart-total {
        width: 100%;
    }
}

.cart-items-wrapper {
    overflow-x: auto;
    width: 100%;
}

.cart-items {
    min-width: 750px; /* or more if needed */
}

.cart-items-title, .cart-items-row {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1fr 1fr 1fr 0.5fr;
    align-items: center;
    font-size: max(1vw, 12px);
    padding: 10px 0;
}

.cart-items-title {
    color: gray;
    font-weight: bold;
}

.cart-items-row {
    color: black;
}

.cart-items-row img {
    width: 50px;
}

.cart-items-row .cross {
    cursor: pointer;
}


    </style>
</head>
<body>

    <div class="navbar">
    <div class="logo">
        <a href="../index.php"><img src="logo.png" alt="logo"></a>
    </div>
    <div class="menu">
        <a href="../index.php">Home</a>
        <a href="#order">Order</a>
    </div>
</div>

        <br>
<?php
session_start();
include 'db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
    $sql = "
        SELECT sp.product_id, sp.email, 
               p.product_name, p.species_name, p.farmer_name, p.weight, p.price, p.statement, p.image
        FROM cart sp
        JOIN sell_products p ON sp.product_id = p.product_id
        WHERE sp.email = '$email'
    ";

    $result = $conn->query($sql);
    $totalPrice = 0;

    echo '<div class="cart">';
    echo '<div class="cart-items-wrapper"><div class="cart-items">';
    echo '<div class="cart-items-title">
            <p>Image</p>
            <p>Title</p>
            <p>Price</p>
            <p>Quantity</p>
            <p>Total</p>
            <p>Remove</p>
          </div><hr>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productPrice = floatval($row['price']);
            $totalPrice += $productPrice;

            echo '<div class="cart-items-row">';
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Product Image">';
            echo '<p>' . htmlspecialchars($row['product_name']) . '</p>';
            echo '<p>Rs.' . number_format($productPrice, 2) . '</p>';
            echo '<p>1</p>'; // Assuming quantity 1
            echo '<p>Rs.' . number_format($productPrice, 2) . '</p>';
            echo '<p class="cross"><a href="remove.php?id=' . $row['product_id'] . '">X</a></p>';
            echo '</div><hr>';
        }
    } else {
        echo "<p>No products found.</p>";
    }

    echo '</div></div>'; // .cart-items

    echo '<div class="cart-bottom">
            <div class="cart-total">
              <h2>Cart Total</h2>
              <div>
                <div class="cart-total-details">
                  <p>Subtotal</p>
                  <p>Rs.' . number_format($totalPrice, 2) . '</p>
                </div>
                <hr />
                <div class="cart-total-details">
                  <p>Delivery Fee</p>
                  <p>Rs.2.00</p>
                </div>
                <hr />
                <div class="cart-total-details">
                  <b>Total</b>
                  <p>Rs.' . number_format($totalPrice + 2, 2) . '</p>
                </div>
              </div>
              <button>PROCEED TO CHECKOUT</button>
            </div>
          </div>';
    echo '</div>'; // close cart-items and wrapper
} else {
    echo "<script>alert('Please log in!');window.location.href = '../user_login.html';</script>";
}

$conn->close();
?>


    <footer>
        <p>&copy; 2025 Farmer Market<br>
        <a href="mailto:fa_market@gmail.com">fa_market@gmail.com</a></p>
    </footer>
</body>
</html>
