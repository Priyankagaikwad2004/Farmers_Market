<?php   

include 'db_conn.php';
       

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $pas = $_POST['password'];
  $pass = $_POST['confirm-password'];

if (empty($email)) 
{
  // $email=$_POST['phone'];
  $email = $phone;
}


  // Submit these to a database --->> Sql query to be executed 


  if($pas==$pass)
  {
    //check the email in database if email is present in database show email exist
    $sql = "SELECT * FROM u_data WHERE email='$email'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0)
    {
      echo "<script>alert('Email already exists. Please use a different email.');window.location.href = '../user_signup.php';</script>";
    }   

    else{
    //inserted password make hash and then insert into database
    $hash= password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `u_data` (`email`, `pas`) VALUES ('$email', '$hash');";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('signup succesfull...!');window.location.href = '../index.php';</script>";
    }
  }
  else
  { 
    echo "<script>alert('wrong password...!');window.location.href = '../user_signup.html';</script>";
  }
}

?> 
