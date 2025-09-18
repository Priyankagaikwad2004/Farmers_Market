<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_conn.php';

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $note = $_POST['note'];

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $email = $_SESSION['email'];

        // Check if the user is already registered
        $check_sql = "SELECT * FROM `farmer_data` WHERE `email` = '$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            
            echo "<script>alert('You are already registered...!'); window.location.href = '/farmer/partil/farmer_account.php';</script>";
        } else {
            $sql = "INSERT INTO `farmer_data` (`fname`, `phone_no`, `address`, `email`) VALUES ('$name', '$mobile', '$note', '$email')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION["registration"] = true;
                echo "<script>alert('You registered successfully...!'); window.location.href = '/farmer/sell.php';</script>";
            } else {
                echo "<script>alert('Registration failed: " . mysqli_error($conn) . "'); window.history.back();</script>";
            }
        }
    } else {
        echo "<script>alert('Please log in first...!'); window.location.href = '/farmer/user_login.html';</script>";
    }
}
?>
