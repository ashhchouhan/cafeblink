<link rel="stylesheet" href="../css/admin_style.css">
<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex"> 
      <div class="logo">
         <img src="images/c3.png"   class="logo">
      </div>

     <!-- <a href="home.php" class="logo">  cafeblink  </a> -->

      <nav class="navbar">
         <a href="home.php">HOME</a>
         <a href="about.php">ABOUT</a>
         <a href="menu.php">MENU</a>
         <a href="orders.php">ORDERS</a>
         <a href="contact.php">CONTACT</a>
        <!-- <a href="reservation.php">reservation</a> -->
         
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
            $total_cart_items = mysqli_num_rows($count_cart_items);
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$user_id'");
            if(mysqli_num_rows($select_profile) > 0){
               $fetch_profile = mysqli_fetch_assoc($select_profile);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>
