<?php
session_start();

include 'db_conn.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
     
  $email = $_SESSION['email'];

  $sql = "SELECT * FROM farmer_data WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
      $name = $row["fname"];
      $phone = $row["phone_no"];
      $addres = $row["address"];
      $_SESSION['register']=true;
    }
  }
  else
  {
    echo "Register you have no account"; 
  }
}
else
{  
  echo "<script>alert('first login...!');window.location.href = 'http://localhost/farmer/user_login.html';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Farmer Dashboard</title>
  <link rel="icon" href="./desktop/farmer.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
  body {
  font-family: Arial, sans-serif;
  background-image: url('https://images.pexels.com/photos/1334312/pexels-photo-1334312.jpeg?cs=srgb&dl=pexels-designstrive-1334312.jpg&fm=jpg');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  min-height: 100vh;
  background-color: #f4f4f4;
  margin: 0;
  padding: 20px;
  overflow: hidden;
}

  h2 {
    text-align: center;
    color: #333;
  }

  .info-box {
    display: flex;
    flex-wrap: wrap;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    max-width: 1000px;
    margin: 20px auto;
    justify-content: center;
    gap: 20px;
  }

  .button-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    width: 100%;
    margin-bottom: 20px;
  }

  button {
    background-color: rgb(59, 187, 59);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
  }

  button:hover {
    background-color: rgb(0, 0, 0);
  }

  .cancelbtn-login {
    background-color: #dc3545;
  }

  .cancelbtn-login:hover {
    background-color: #c82333;
  }

  .information {
    flex: 1 1 300px;
    min-width: 280px;
  }

  .information h3 {
    margin-bottom: 20px;
    color: #333;
  }

  .information p {
    color: #555;
    margin: 10px 0;
  }

  .address {
    width: 100%;
    height: auto;
  }

  img {
    flex: 1 1 300px;
    max-width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
  }

  /* 🔽 Mobile responsive styles */
  @media (max-width: 768px) {
    body {
      padding: 10px;
      overflow-y: auto;

    }

    .info-box {
      flex-direction: column;
      padding: 15px;
    }

    .button-group {
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .information {
      text-align: center;
    }

    .information p {
      margin-left: 0;
    }

    img {
      margin: 0 auto;
    }
  }

  </style>
</head>

<body>
  <?php  
    if(isset($_SESSION['register']) && $_SESSION['register']==true)
    {
      echo '<div class="info-box">';
      echo '<div class="button-group">';
      echo '<a href="../index.php"><button>Home</button></a>';
      echo '<a href="show_added_product_on_farmer_account.php"><button>Added products</button></a>';
      echo '<a href="show_sold_product_to_farmer.php"><button>Sold products</button></a>';
      echo '</div>';
      echo '<div class="information">';
      echo '<h3>User Information</h3>';
      echo '<p><strong>Email:</strong> ' . $email . '</p>';
      echo '<p><strong>Name:</strong> ' . $name . '</p>';
      echo '<p><strong>Mobile Number:</strong> ' . $phone . '</p>';
      echo '<p class="address"><strong>Address:</strong> ' . $addres . '</p>';
      echo '</div>';
      echo '<img src=" https://t4.ftcdn.net/jpg/06/63/53/51/360_F_663535165_jHjv6d5LKP6zs2VWYJ17e0koOLFauOPo.jpg" alt="Farmer Image">';
      echo '</div>';
      
    }
    else
    { 
      echo "<script>alert('Register first...!');window.location.href = 'http://localhost/farmer/farmersignup.html';</script>";
    }
  ?>
</body>
</html>
