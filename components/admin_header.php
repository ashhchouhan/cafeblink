<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="dashboard.php">HOME</a>
         <a href="products.php">PRODUCTS</a>
         <a href="placed_orders.php">ORDERS</a>
         <a href="admin_accounts.php">ADMINS</a>
         <a href="users_accounts.php">USERS</a>
         <a href="messages.php">MESSAGE</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            // Assuming $conn is your MySQLi connection object
            $select_profile = $con->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->bind_param("i", $admin_id);
            $select_profile->execute();
            $result = $select_profile->get_result();
            $fetch_profile = $result->fetch_assoc();
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>
