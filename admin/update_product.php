<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit();
}

$update_id = isset($_GET['update']) ? $_GET['update'] : null;

if ($update_id === null) {
   
    exit("Error: Product ID for update not provided.");
}

if(isset($_POST) && !empty($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_product = mysqli_prepare($con, "UPDATE `products` SET name = ?, category = ?, price = ? WHERE id = ?");
   mysqli_stmt_bind_param($update_product, "sssi", $name, $category, $price, $pid);
   mysqli_stmt_execute($update_product);

   $message[] = 'product updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = mysqli_prepare($con, "UPDATE `products` SET image = ? WHERE id = ?");
         mysqli_stmt_bind_param($update_image, "si", $image, $pid);
         mysqli_stmt_execute($update_image);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated!';
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
   <title>update product</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
  
.update-product form{
   margin:0 auto;
   max-width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   padding:2rem;
}

.update-product form img{
   height: 25rem;
   width: 100%;
   object-fit: contain;
}

.update-product form .box{
   background-color: var(--light-bg);
   border:var(--border);
   width: 100%;
   padding:1.4rem;
   font-size: 1.8rem;
   color:var(--black);
   border-radius: .5rem;
   margin: 1rem 0;
}

.update-product form textarea{
   height: 15rem;
   resize: none;
}

.update-product form span{
   font-size: 1.7rem;
   color:var(--black);
}
   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>



<section class="update-product">

   <h1 class="heading">update product</h1>

   <?php
      if ($update_id !== null) {
         $show_products = mysqli_prepare($con, "SELECT * FROM `products` WHERE id = ?");
         mysqli_stmt_bind_param($show_products, "i", $update_id);
         mysqli_stmt_execute($show_products);
         $result = mysqli_stmt_get_result($show_products);
         if(mysqli_num_rows($result) > 0){
            while($fetch_products = mysqli_fetch_assoc($result)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <span>update name</span>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
      <span>update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
      <span>update category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
      </select>
      <span>update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
            }
         } else {
            echo '<p class="empty">No products found!</p>';
         }
      } else {
         echo '<p class="empty">Product ID for update not provided!</p>';
      }
   ?>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>
