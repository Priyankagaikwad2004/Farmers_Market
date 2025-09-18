<?php
session_start();   

include 'db_conn.php';
       

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // $quantity = $_POST['quantity'];
    $cname = $_POST['cname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $building = $_POST['building'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
 
    $user_id=$_SESSION['email'];

    $sql = "UPDATE profile_info 
            SET first_name = '$cname', last_name = '$lname', addres = '$address', 
                building_name = '$building', landmark = '$landmark', pincode = '$pincode', 
                phone_no = '$phone' 
            WHERE email = '$user_id'";
    $result = mysqli_query($conn, $sql);

        echo "<script>alert('  information updated succesfully...!');window.location.href = 'user_profil.php';</script>";

}

?>
