<?php   

include 'db_conn.php';
       

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $quantity = $_POST['quantity'];
    $cname = $_POST['cname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $building = $_POST['building'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $product_id = $_POST['product_id'];
    $farmer_email = $_POST['farmer_email'];
    $user_id=$_POST['user_id'];


    // CREATE TABLE sold_products( product_id INT, email VARCHAR(50), costomer_name VARCHAR(50), last_name VARCHAR(50), 
    // delivery_address VARCHAR(200), build_name VARCHAR(70), landmark_name VARCHAR(70), pincode INT, phone_no INT, quantity INT);

    $sql = "INSERT INTO sold_products ( product_id, email, customer_name,last_name, delivery_address, build_name, landmark_name, pincode, phone_no, quantity, user_id)
    VALUES('$product_id','$farmer_email','$cname','$lname','$address','$building','$landmark','$pincode','$phone','$quantity','$user_id');";


    $result = mysqli_query($conn, $sql);
    echo "<script>alert('Buy succesfull...!');window.location.href = 'display_product_to_user.php';</script>";

}



?>