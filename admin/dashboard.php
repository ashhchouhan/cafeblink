<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Side Menu</title>
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-7TrTThMpwsjmyTK9l/4u+eCnHsWJV8X7c3V57DJ+CvIC/6p8fxmQznzPFny/E3T7l2D+U+hj06Zutuw/yMT1Pg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      /* Inline CSS for demonstration purposes, consider moving to external stylesheet */
       /* Inline CSS for demonstration purposes, consider moving to external stylesheet */
       .side-menu {
         position: fixed;
         left: 0;
         top: 0;
         height: 100%;
         width: 200px;
         background-color: #8697c1;
         color: #fff;
      }

      .profile {
         display: none;
      }

      .menu-header {
         padding: 20px;
         background-color: #222;
      }

      .menu-list {
         list-style-type: none;
         padding: 0;
      }

      .menu-list li {
         padding: 28px 21px 22px 48px;
         font-size: 15px;
         font-family: fantasy;
      }

      .menu-list li a {
         color: #fff;
         text-decoration: none;
      }

      .menu-list li a:hover {
         background-color: #555;
      }

      .sidebar-icons {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 20px;
      }

      /* Inline CSS for demonstration purposes, consider moving to external stylesheet */
.dashboard {
    padding: 2rem;
}

.heading {
    font-size: 2.5rem;
    color: #333;
    text-align: center;
    margin-bottom: 2rem;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    text-align: center;
}

.box h3 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.box p {
    font-size: 1.6rem;
    color: #333;
    margin-bottom: 1rem;
}

.box a.btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 1.6rem;
    text-decoration: none;
    margin-top: 10px;
}

.box a.btn:hover {
    background-color: #45a049;
}

   </style>
</head>

<body>

   <div class="side-menu">
      <div class="menu-header">
         <h2>Menu</h2>
      </div>
      <ul class="menu-list">
         <li><a href="dashboard.php">Home</a></li>
         <li><a href="placed_orders.php">Orders</a></li>
         <li><a href="admin_accounts.php">Admin</a></li>
         <li><a href="users_accounts.php">Users</a></li>
         <li><a href="products.php"> products</a> </li>
         <li><a href="messages.php">Message</a></li>
      </ul>


      <div class="sidebar-icons">
         <div><i class="fas fa-bars"></i></div>
         <div id="user-icon"><i class="fas fa-user"></i></div>
      </div>






   </div>


   <div class="profile" id="profile-section">
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
      <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
         class="delete-btn">logout</a>
   </div>
   <div>
      <section class="dashboard">

         <h1 class="heading">Dashboard</h1>

         <div class="box-container">

            <div class="box">
               <h3>Welcome!</h3>
               <?php if (isset($fetch_profile['name'])): ?>
                  <p><?= $fetch_profile['name']; ?></p>
                  <a href="update_profile.php" class="btn">Update Profile</a>
               <?php else: ?>
                  <p>Profile data not available.</p>
               <?php endif; ?>
            </div>



            <div class="box">
               <?php
               $total_pendings = 0;
               $query_pendings = "SELECT * FROM `orders` WHERE payment_status = 'pending'";
               $result_pendings = mysqli_query($con, $query_pendings);
               while ($fetch_pendings = mysqli_fetch_assoc($result_pendings)) {
                  $total_pendings += $fetch_pendings['total_price'];
               }
               ?>
               <h3><span>₹</span><?= $total_pendings; ?><span>/-</span></h3>
               <p>Total Pendings</p>
               <a href="placed_orders.php" class="btn">See Orders</a>
            </div>

            <div class="box">
               <?php
               $total_completes = 0;
               $query_completes = "SELECT * FROM `orders` WHERE payment_status = 'completed'";
               $result_completes = mysqli_query($con, $query_completes);
               while ($fetch_completes = mysqli_fetch_assoc($result_completes)) {
                  $total_completes += $fetch_completes['total_price'];
               }
               ?>
               <h3><span>₹</span><?= $total_completes; ?><span>/-</span></h3>
               <p>Total Completes</p>
               <a href="placed_orders.php" class="btn">See Orders</a>
            </div>



            <div class="box">
               <?php
               $query_orders = "SELECT * FROM orders";
               $result_orders = mysqli_query($con, $query_orders);
               $numbers_of_orders = mysqli_num_rows($result_orders);
               ?>
               <h3><?= $numbers_of_orders; ?></h3>
               <p>Total Orders</p>
               <a href="placed_orders.php" class="btn">See Orders</a>
               
            </div>

            <div class="box">
               <?php
               $query_products = "SELECT * FROM `products`";
               $result_products = mysqli_query($con, $query_products);
               $numbers_of_products = mysqli_num_rows($result_products);
               ?>
               <h3><?= $numbers_of_products; ?></h3>
               <p>Total Products Added</p>
               <a href="products.php" class="btn">See Products</a>
            </div>

            <div class="box">
               <?php
               $query_users = "SELECT * FROM `users`";
               $result_users = mysqli_query($con, $query_users);
               $numbers_of_users = mysqli_num_rows($result_users);
               ?>
               <h3><?= $numbers_of_users; ?></h3>
               <p>Total Users Accounts</p>
               <a href="users_accounts.php" class="btn">See Users</a>
            </div>

            <div class="box">
               <?php
               $query_admins = "SELECT * FROM `admin`";
               $result_admins = mysqli_query($con, $query_admins);
               $numbers_of_admins = mysqli_num_rows($result_admins);
               ?>
               <h3><?= $numbers_of_admins; ?></h3>
               <p>Total Admins</p>
               <a href="admin_accounts.php" class="btn">See Admins</a>
            </div>

            <div class="box">
               <?php
               $query_messages = "SELECT * FROM `messages`";
               $result_messages = mysqli_query($con, $query_messages);
               $numbers_of_messages = mysqli_num_rows($result_messages);
               ?>
               <h3><?= $numbers_of_messages; ?></h3>
               <p>Total New Messages</p>
               <a href="messages.php" class="btn">See Messages</a>
            </div>


         </div>

      </section>

   </div>


   <script src="../js/dashboardSidemenu.js"></script>

   <script src="../js/admin_script.js"></script>

</body>

</html>