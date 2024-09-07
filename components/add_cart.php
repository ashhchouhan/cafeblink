<?php

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $con->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->bind_param("si", $name, $user_id);
      $check_cart_numbers->execute();
      $check_cart_numbers->store_result();

      if($check_cart_numbers->num_rows > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_cart = $con->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->bind_param("iisdis", $user_id, $pid, $name, $price, $qty, $image);
         $insert_cart->execute();
         $message[] = 'added to cart!';
         
      }

   }

}

?> 
