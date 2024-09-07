<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $select_name = mysqli_prepare($con, "SELECT * FROM `admin` WHERE name = ?");
      mysqli_stmt_bind_param($select_name, "s", $name);
      mysqli_stmt_execute($select_name);
      mysqli_stmt_store_result($select_name);
      if(mysqli_stmt_num_rows($select_name) > 0){
         $message[] = 'username already taken!';
      }else{
         $update_name = mysqli_prepare($con, "UPDATE `admin` SET name = ? WHERE id = ?");
         mysqli_stmt_bind_param($update_name, "si", $name, $admin_id);
         mysqli_stmt_execute($update_name);
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_old_pass = mysqli_prepare($con, "SELECT password FROM `admin` WHERE id = ?");
   mysqli_stmt_bind_param($select_old_pass, "i", $admin_id);
   mysqli_stmt_execute($select_old_pass);
   mysqli_stmt_store_result($select_old_pass);
   mysqli_stmt_bind_result($select_old_pass, $fetch_prev_pass);
   mysqli_stmt_fetch($select_old_pass);
   $prev_pass = $fetch_prev_pass;
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = mysqli_prepare($con, "UPDATE `admin` SET password = ? WHERE id = ?");
            mysqli_stmt_bind_param($update_pass, "si", $confirm_pass, $admin_id);
            mysqli_stmt_execute($update_pass);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile update</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

 
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
    

      /* Custom CSS for profile update page */
.form-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.form-container form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 40px;
    text-align: center;
    width: 50rem;
}

.form-container form h3 {
    font-size: 2.5rem;
    color: #333;
    text-transform: capitalize;
    margin-bottom: 1rem;
}

.form-container form p {
    margin: 1rem 0;
    font-size: 1.8rem;
    color: #666;
}

.form-container form .box {
    width: calc(100% - 20px);
    background-color: #f9f9f9;
    padding: 1rem;
    font-size: 1.6rem;
    color: #333;
    margin: 1rem 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.form-container form .box:focus {
    border-color: #4CAF50;
}

.form-container form .btn {
    width: calc(100% - 20px);
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 1.6rem;
    cursor: pointer;
    outline: none;
}

.form-container form .btn:hover {
    background-color: #45a049;
}

   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>



<section class="form-container">

   <form action="" method="POST">
      <h3>update profile</h3>
      <input type="text" name="name" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $fetch_profile['name']; ?>">
      <input type="password" name="old_pass" maxlength="20" placeholder="enter your old password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" maxlength="20" placeholder="enter your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" maxlength="20" placeholder="confirm your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>
