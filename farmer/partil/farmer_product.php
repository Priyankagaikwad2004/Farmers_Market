<?php
require_once('db_conn.php');
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('You are not logged in!'); window.location.href = '../index.php';</script>";
    exit();
}

if (!isset($_SESSION['register']) || $_SESSION['register'] !== true) {
    echo "<script>alert('You have no account!'); window.location.href = '../add_product.html';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES["uploadfile"]) || $_FILES["uploadfile"]["error"] !== 0) {
        echo "<script>alert('File upload failed!'); window.location.href = '../add_product.html';</script>";
        exit();
    }

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/" . $filename;

    if (!move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Failed to move uploaded file.'); window.location.href = '../add_product.html';</script>";
        exit();
    }

    $email = $_SESSION['email'];
    $product_name = $_POST['product_name'];
    $species_name = $_POST['species_name'];
    $farmer_name = $_POST['farmer_name'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $statement = $_POST['statement'];

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO sell_products (email, product_name, species_name, farmer_name, weight, price, statement, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddss", $email, $product_name, $species_name, $farmer_name, $weight, $price, $statement, $folder);

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!'); window.location.href = '../add_product.html';</script>";
    } else {
        echo "<script>alert('Error adding product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
