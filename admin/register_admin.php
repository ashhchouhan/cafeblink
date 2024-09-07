<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit(); 
}

$message = []; 

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   
   $check_admin_query = "SELECT * FROM `admin` WHERE name = '$name'";
   $check_admin_result = mysqli_query($con, $check_admin_query);

   if(mysqli_num_rows($check_admin_result) > 0){
      $message[] = 'Username already exists!';
   } else {
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      } else {
         
         $insert_admin_query = "INSERT INTO `admin` (name, password) VALUES ('$name', '$cpass')";
         
         if(mysqli_query($con, $insert_admin_query)){
            $message[] = 'New admin registered!';
         } else {
            $message[] = 'Error registering new admin: ' . mysqli_error($conn);
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
   <title>Register</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
     

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
      <h3>Register New</h3>
      <?php foreach ($message as $msg): ?>
         <div class="message">
            <span><?= $msg ?></span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
      <?php endforeach; ?>
      <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="Confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" name="submit" class="btn">
   </form>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>
