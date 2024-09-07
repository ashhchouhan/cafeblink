


<?php

include '../components/connect.php';

session_start();

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $con->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   $result = $select_admin->get_result(); // Get result set
   if($result->num_rows > 0){
      $fetch_admin_id = $result->fetch_assoc(); // Fetch row from result set
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'Incorrect username or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="../css/admin_style.css"> 

   <style>

body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('../images/virginmary.jpg'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.8); /* Add opacity to the login form */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        
        .form-container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        
        .input-field {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-field input {
            width: calc(97% - 40px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            padding-left: 52px; /* Add padding to the left to create space for the icon */
        }
        
        .input-field i {
            position: absolute;
            top: 50%;
            left: 24px;
            transform: translateY(-50%);
            color: #888;
        }
        
        .extra {
            margin-top: 20px;
        }
        
        .extra a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        
        .extra a:hover {
            text-decoration: underline;
        }
        
        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
if(isset($message) && is_array($message)){
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

<!-- admin login form section starts  -->
<section class="form-container">
        <h1>Admin Login</h1>
        <form method="post" action="">
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Admin Name" name="name" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="pass" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>

            <input type="submit" class="btn" value="login now" name="submit">

            <div class="extra">
                <a href="#">Forgot Password?</a>
                <a href="#">Create an Account</a>
            </div>
        </form>
    </section>
<!-- admin login form section ends -->
</body>
</html>




