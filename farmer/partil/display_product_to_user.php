<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Farmer Products Profile</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color:  #46C848; /* Navbar background color */
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      flex-wrap: wrap;
    }

    .navbar .logo img {
      width: 100px;
    }

    .menu {
      display: flex;
      gap: 20px;
    }

    .menu a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
    }

    .menu-toggle {
      display: none;
      font-size: 28px;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .menu {
        flex-direction: column;
        width: 100%;
        display: none;
        background-color: #fff;
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px 0;
      }

      .menu.show {
        display: flex;
      }

      .menu a {
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
      }

      .menu a:last-child {
        border-bottom: none;
      }

      .menu-toggle {
        display: block;
        color: #333;
      }
    }

    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      padding: 40px 20px;
    }

    .food-item {
      width: 280px;
      background-color: #fff;
      border-radius: 25px;
      box-shadow: 0px 0px 15px #00000010;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .food-item:hover {
      transform: scale(1.03);
    }

    .food-item-image {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .food-item-info {
      padding: 20px;
    }

    .food-item-name-rating {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .food-item-name-rating p {
      font-size: 20px;
      font-weight: 600;
      margin: 0;
      color: #333;
    }

    .food-item-descreption {
      font-size: 14px;
      color: #666;
      margin: 4px 0;
    }

    .food-item-price {
      color:rgb(255, 151, 67);
      font-size: 20px;
      font-weight: bold;
      margin: 10px 0;
    }

    .buy-button,
    .cart-button {
      width: 100%;
      border: none;
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .buy-button {
      background-color: #28a745;
      color: white;
    }

    .buy-button:hover {
      background-color: #1e7e34;
    }

    .cart-button {
      background-color: #ffea00;
      color: black;
    }

    .cart-button:hover {
      background-color: #f5dd00;
    }

    footer {
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      font-size: 14px;
      background-color: #ffffff;
      box-shadow: 0px -2px 8px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <a href="../index.php"><img src="logo.png" alt="logo"></a>
    </div>
    <div class="menu-toggle" id="menu-toggle">&#9776;</div>
    <div class="menu" id="menu">
      <a href="../index.php">Home</a>
      <a href="cart.php">Cart</a>
      <a href="order.php">My Order</a>
    </div>
  </div>

  <div class="product-container">
    <?php
      include 'db_conn.php';

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM sell_products";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='food-item'>";
          echo "  <img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['product_name']) . "' class='food-item-image'>";
          echo "  <div class='food-item-info'>";
          echo "    <div class='food-item-name-rating'>";
          echo "      <p>" . htmlspecialchars($row['product_name']) . "</p>";
          echo "    </div>";
          echo "    <p class='food-item-descreption'>Species: " . htmlspecialchars($row['species_name']) . "</p>";
          echo "    <p class='food-item-descreption'>Weight: " . htmlspecialchars($row['weight']) . " kg</p>";
          echo "    <p class='food-item-price'>Rs. " . htmlspecialchars($row['price']) . "</p>";

          echo "    <form action='product_details.php' method='POST'>";
          echo "      <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
          echo "      <button type='submit' name='action' value='add' class='buy-button'>Buy Now</button>";
          echo "    </form>";

          echo "    <form action='product_add_in_cart.php' method='POST'>";
          echo "      <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
          echo "      <button type='submit' class='cart-button'>Add to Cart</button>";
          echo "    </form>";

          echo "  </div>";
          echo "</div>";
        }
      } else {
        echo "<p>No products found.</p>";
      }

      $conn->close();
    ?>
  </div>

  <footer>
    <p>&copy; Farmer Market<br>
    <a href="mailto:fa_market@gmail.com">fa_market@gmail.com</a></p>
  </footer>

  <script>
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    toggle.addEventListener('click', () => {
      menu.classList.toggle('show');
    });
  </script>
</body>
</html>
