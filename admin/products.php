<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = mysqli_query($con, "SELECT * FROM `products` WHERE name = '$name'");

   if(mysqli_num_rows($select_products) > 0){
      $message[] = 'product name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = mysqli_query($con, "INSERT INTO `products`(name, category, price, image) VALUES('$name', '$category', '$price', '$image')");

         $message[] = 'new product added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = mysqli_query($con, "SELECT * FROM `products` WHERE id = '$delete_id'");
   $fetch_delete_image = mysqli_fetch_assoc($delete_product_image);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = mysqli_query($con, "DELETE FROM `products` WHERE id = '$delete_id'");
   $delete_cart = mysqli_query($con, "DELETE FROM `cart` WHERE pid = '$delete_id'");
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      

.add-products {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.add-products form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 40px;
    text-align: center;
    width: 50rem;
}

.add-products form h3 {
    font-size: 2.5rem;
    color: #333;
    text-transform: capitalize;
    margin-bottom: 1rem;
}

.add-products form .box {
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

.add-products form .box:focus {
    border-color: #4CAF50;
}

.add-products form .btn {
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

.add-products form .btn:hover {
    background-color: #45a049;
}

.show-products {
    padding-top: 0;
}

.box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    max-width: 300px;
}

.box img {
    max-width: 100%;
    border-radius: 5px;
}

.box .flex {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.box .flex .price {
    font-size: 1.6rem;
    color: #333;
}

.box .flex .category {
    font-size: 1.6rem;
    color: #666;
}

.box .name {
    margin-top: 10px;
    font-size: 1.8rem;
    color: #333;
}

.flex-btn {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.option-btn,
.delete-btn {
    padding: 8px 16px;
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



<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
         
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>



<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = mysqli_query($con, "SELECT * FROM `products`");
      if(mysqli_num_rows($show_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($show_products)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>₹</span><?= $fetch_products['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>
