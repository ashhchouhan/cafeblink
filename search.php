<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <style>
      #search{
         height: 391px;
    width: 1259px;
    padding: 77px 219px 0px 210px;
}
#find{
   background-image: url('C:\xampp\htdocs\cafeblink\images\b5b8fdc69450664acbaa4d6533d65134.jpg');
}
      
   </style>

</head>


<body>


   <?php include 'components/user_header.php'; ?>


   <section class="search-form" id="find" style="background-image:url('../images/c2,png');">
      <div id="search">
      <form method="post" action="">
         <input type="text" name="search_box" placeholder="search here..." class="box">
         <button type="submit" name="search_btn" class="fas fa-search"></button>
      </form>
      </div>
   </section>




   <section class="products" style="min-height: 100vh; padding-top:0;">
   

      <div class="box-container">

         <?php
         if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];
            $select_products = $con->prepare("SELECT * FROM `products` WHERE name LIKE ?");
            $search_query = "%" . $search_box . "%";
            $select_products->bind_param("s", $search_query);
            $select_products->execute();
            $result = $select_products->get_result();
            if ($result->num_rows > 0) {
               while ($fetch_products = $result->fetch_array(MYSQLI_ASSOC)) {
                  ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                     <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                     <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                     <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                     <a href="category.php?category=<?= $fetch_products['category']; ?>"
                        class="cat"><?= $fetch_products['category']; ?></a>
                     <div class="name"><?= $fetch_products['name']; ?></div>
                     <div class="flex">
                        <div class="price"><span>₹</span><?= $fetch_products['price']; ?></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                     </div>
                  </form>
                  <?php
               }
            } 
            else {
               echo '<p class="empty">no products added yet!</p>';
            }
         }
         ?>

      </div>

   </section>


   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>