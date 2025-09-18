<?php
session_start();
include 'db_conn.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    
                                                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                {
                                                $user_id = $_SESSION['email'];
                                                $product_id = $_POST['product_id'];

                                                $sql = "INSERT INTO `cart` (`product_id`, `email`) VALUES ('$product_id', '$user_id');";
                                                $result = mysqli_query($conn, $sql);
                                                echo "<script>alert('Product added Successfully');window.location.href = 'display_product_to_user.php';</script>";
                                                }

}
else
{  
    echo "<script>alert('Please log in...!');window.location.href = '../user_login.html';</script>";
}?>

