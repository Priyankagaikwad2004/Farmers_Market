<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Product Confirmation</title>
    <style>
    /* Base styles */
html, body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f1f1f1;
    min-height: 100vh;
    background-size: cover;
    background-attachment: fixed;
}

.main-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.header {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.content-wrapper {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
    padding: 20px;
    width: 100%;
    max-width: 900px;
}

.product-card {
    display: flex;
    flex-wrap: wrap;
    margin: 20px 0;
    padding: 15px;
    border: 2px solid #ccc;
}

.product-image {
    max-width: 100%;
    width: 100%;
    max-width: 300px;
    height: auto;
    border-radius: 10px;
    margin: auto;
}

.product-details {
    flex: 1;
    margin-top: 20px;
    color: black;
    text-align: center;
}

.quantity-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}

.quantity-btn {
    padding: 10px;
    font-size: 16px;
    background-color: #ff6f61;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: 0.3s ease;
}

.quantity-input {
    width: 60px;
    text-align: center;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
}

.button-group {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.Buy, .cancle {
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 150px;
    text-align: center;
}

.Buy {
    background-color: #28a745;
    color: #fff;
}

.Buy:hover {
    background-color: #218838;
}

.cancle {
    background-color: #dc3545;
    color: #fff;
}

.cancle:hover {
    background-color: #c82333;
}

.full {
    width: 100%;
    opacity: 0;
    transition: all 2s ease;
}

.full.show {
    opacity: 1;
    margin-top: 20px;
}

.cust {
    border-radius: 20px;
    background-color: #ffffff;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 900px;
    margin: auto;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
}

#address-form {
    width: 100%;
}

label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

input[type="text"], input[type="tel"], textarea, input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid gray;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.5);
    box-sizing: border-box;
}

.horizontal-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px;
    margin: 8px 0;
}

.horizontal-group .half-width {
    flex: 1 1 45%;
    min-width: 220px;
}

.confirm {
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: #28a745;
    color: #fff;
    width: 100%;
    margin-top: 15px;
}

.confirm:hover {
    background-color: #218838;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Responsive Queries */
@media (max-width: 768px) {
    .product-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .product-image {
        margin: 0 auto;
    }

    .product-details {
        margin: 10px 0;
    }

    .button-group {
        flex-direction: column;
        align-items: center;
    }

    .Buy, .cancle {
        width: 100%;
    }
    

    .horizontal-group {
        flex-direction: column;
    }

    .cust {
        padding: 10px;
    }

    .confirm {
        width: 100%;
    }

    .quantity-wrapper {
        flex-direction: column;
        align-items: center;
    }

    h1.header {
        font-size: 1.5rem;
    }
}

    </style>
</head>
<body>
    <div class="main-container">
        <h1 class="header">Product Confirmation</h1>
        <div class="content-wrapper">
            <?php
            include 'db_conn.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $sql = "SELECT * FROM sell_products WHERE product_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $product_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='product-card'>";
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['product_name']) . "' class='product-image'>";
                    echo "<div class='product-details'>";
                    echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
                    echo "<p>Species: " . htmlspecialchars($row['species_name']) . "</p>";
                    echo "<p>Farmer: " . htmlspecialchars($row['farmer_name']) . "</p>";
                    echo "<p>Weight: " . htmlspecialchars($row['weight']) . " kg</p>";
                    echo "<p>Price: Rs. " . htmlspecialchars($row['price']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p>Product not found.</p>";
                }

                $stmt->close();
            } else {
                echo "<p>Invalid request.</p>";
            }

            $conn->close();
            ?>
            <form action="confirm_product.php" method="post">
                <div class="quantity-wrapper">
                    <h3>Quantity : </h3>
                    <div class="qut">
                        <button type="button" class="quantity-btn" name="quantity" onclick="decreaseQuantity()">-</button>
                        <input type="number" id="quantity" class="quantity-input" name="quantity" value="1" min="1">
                        <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                    </div>
                </div>
                <!-- Hidden input for product_id -->
                <?php
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['product_id']) . "'>";
                // echo'<input type="hidden" id="hidden-quantity" name="quantity">'
                ?>
                <div class="button-group">
                    <button class="Buy">Buy Now</button>
                    <button type="button" class="cancle" onclick="cancelAction()">Cancel</button>                </div>
            </form>
        </div>
    </div>
    <div class="full">
        <center>
            <div class="cust">
                <form action="Add_sold_products.php" method="post" id="address-form">
                    <h2>Confirm Order</h2>
                    <div class="horizontal-group">
                        <div class="half-width">
                            <label for="cname">Customer Name:</label>
                            <input type="text" id="cname" name="cname" placeholder="Enter first name" required>
                        </div>
                        <div class="half-width">
                            <label for="surname">Last Name:</label>
                            <input type="text" id="lastname" name="lname" placeholder="Enter Last Name" required>
                        </div>
                    </div>

                    <label for="address">Delivery Address:</label>
                    <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>

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

                    <!-- Hidden inputs -->
                    <?php
                    echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                    echo "<input type='hidden' name='farmer_email' value='" . $row['email'] . "'>";
                    echo "<input type='hidden' name='user_id' value='" . $_SESSION['email'] . "'>";
                    // echo'<input type="hidden" id="quantity" name="quantity">';
                    echo'<input type="hidden" id="hiddenQuantity" name="quantity" value="">';   
                    ?>                
                    <center><button type="submit" class="confirm">Confirm Order</button></center>
                </form>
            </div>
        </center>
        <br><br>
    </div>

    <script>
    const quantityInput = document.getElementById("quantity");
    const hiddenQuantityInput = document.getElementById("hiddenQuantity");

    function updateHiddenQuantity() {
        hiddenQuantityInput.value = quantityInput.value;
    }

    function increaseQuantity() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateHiddenQuantity();
    }

    function decreaseQuantity() {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateHiddenQuantity();
        }
    }

    updateHiddenQuantity();

    document.querySelector('.Buy').addEventListener('click', function(event) {
        event.preventDefault();  // Prevent form submission
        const fullSection = document.querySelector('.full');
        fullSection.classList.add('show');  // Trigger the animation

        // Smooth scroll to the form
        setTimeout(() => {
            fullSection.scrollIntoView({ behavior: 'smooth' });
        }, 300);  // Slight delay to ensure .show is applied
    });

    function cancelAction() {
        window.location.href = '/farmer/partil/display_product_to_user.php';
    }
</script>

</body>
</html>
<?php
} else {
    echo "<script>alert('Please log in...!');window.location.href = '../user_login.html';</script>";
}
?>