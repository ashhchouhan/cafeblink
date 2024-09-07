<?php
include '../components/connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit(); 
}
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
   exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admins Accounts</title>
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

.flex-btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.option-btn,
.delete-btn {
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1.6rem;
    cursor: pointer;
    text-decoration: none;
}

.option-btn {
    background-color: #4CAF50;
    color: #fff;
}

.option-btn:hover {
    background-color: #45a049;
}

.delete-btn {
    background-color: #f44336;
    color: #fff;
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
      <h1 class="heading">Admins Account</h1>
      <div class="box-container">
         <div class="box" style=" background-color: var(--white);
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   padding:4rem;
   padding-top: 2rem;
   text-align: center;">
            <p>Register New Admin</p>
            <a href="register_admin.php" class="option-btn">Register</a>
         </div>
         <?php
         $select_account = "SELECT * FROM `admin`";
         $result = mysqli_query($con, $select_account);
         if (mysqli_num_rows($result) > 0) {
            while ($fetch_accounts = mysqli_fetch_assoc($result)) {
               ?>
               <div class="box">
                  <p>Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
                  <p>Username : <span><?= $fetch_accounts['name']; ?></span> </p>
                  <div class="flex-btn">
                     <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
                     <?php
                     if ($fetch_accounts['id'] == $admin_id) {
                        echo '<a href="update_profile.php" class="option-btn">Update</a>';
                     }
                     ?>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">No accounts available</p>';
         }
         mysqli_free_result($result);
         ?>
      </div>
   </section>
   <script src="../js/admin_script.js"></script>
</body>
</html>
