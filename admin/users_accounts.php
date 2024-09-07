<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_users = $con->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->bind_param("i", $delete_id);
   $delete_users->execute();
   $delete_order = $con->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_order->bind_param("i", $delete_id);
   $delete_order->execute();
   $delete_cart = $con->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->bind_param("i", $delete_id);
   $delete_cart->execute();
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
   
      

.accounts {
    padding: 2rem;
}

.heading {
    font-size: 2.5rem;
    color: #333;
    text-align: center;
    margin-bottom: 2rem;
}

.box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    max-width: 400px;
}

.box p {
    margin: 0;
    font-size: 1.6rem;
    color: #333;
}

.box p span {
    font-weight: bold;
}

.delete-btn {
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #f44336;
    color: #fff;
    font-size: 1.6rem;
    cursor: pointer;
    text-decoration: none;
}

.delete-btn:hover {
    background-color: #d32f2f;
}

.empty {
    font-size: 1.8rem;
    color: #666;
    text-align: center;
}

   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>


<section class="accounts">

   <h1 class="heading">users account</h1>

   <div class="box-container">

   <?php
      $select_account = $con->prepare("SELECT * FROM `users`");
      $select_account->execute();
      $result = $select_account->get_result();
      if($result->num_rows > 0){
         while($fetch_accounts = $result->fetch_assoc()){  
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>
