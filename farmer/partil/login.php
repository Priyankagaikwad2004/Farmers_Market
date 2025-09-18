<?php
session_start();

include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];

    $sql = "SELECT * FROM u_data WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['pas'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            echo json_encode(["status" => "success", "message" => "You are logged in!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Wrong password!"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "You don't have an account. Please sign up!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
