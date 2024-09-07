<?php

include 'components/connect.php';

session_start();

$user_id = ''; 

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">
   <style>
      
     section{
   margin:0 auto;
   max-width: 1270px;
   padding:2rem;
   
}

      #Mainhero{
         background-image: url('images/hotchocolate.jpg');
      }

      .hero1 {
    text-align: center;
    padding: 1em 0px;
    height: 826px;
    
    
         /* background-image: url('../uploaded_img/-about4.jpg'); */
      
         background-size: cover;
         background-repeat: no-repeat;   
    color: white;
}
.hero-content {
    max-width: 650px;
    margin: 250px auto;
}
.hero1 h1 {
    font-size: 54px;
    margin-bottom: 0.5em;
}


h1 {
    margin: 0;
    color:white;
    padding: 10px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.hero1 p {
    font-size: 21px;
    margin-top: -0.5em;
    margin-bottom: 13px;
    color: white;
}
#hero-button {
    background-color: #8697c1;
    border: none;
    color: white;
    padding: 9px 19px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 7px 0px;
    cursor: pointer;
    border-radius: 47px;
    transition-duration: 0.4s;
}
    
.hero{
   color: #8697c1;
}
   </style>

</head>
<body class="body">

<?php include 'components/user_header.php'; ?>

<section class="hero1" id="Mainhero">
        <div class="hero-content">
            <h1>Welcome to Café <br> BLINK</h1>
            <p>Experience the finest coffee and pastries in town.</p>
	<a href="about.php" > <button id="hero-button">  know more</button></a>
        </div>
    </section>

<section class="hero">
   <div class="swiper hero-slider">
      <div class="swiper-wrapper">
      
         <div class="swiper-slide slide">
            <div class="content">
               <span>enjoy our delicious meal</span>
               <h3>delicious pizza</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/pexels-photo-1346347.jpg" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>chezzy hamburger</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/home-img-2.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>rosted chicken</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="images/pexels-photo-291528.jpg" alt="">
            </div>
         </div>
      </div>
      <div class="swiper-pagination"></div>
   </div>
</section>

<section class="category">
   <h1 class="title">food category</h1>
   <div class="box-container">
      <a href="category.php?category=fast food" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>fast food</h3>
      </a>

      <a href="category.php?category=main dish" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>main dishes</h3>
      </a>

      <a href="category.php?category=drinks" class="box">
         <img src="images/cat-3.png" alt="">
         <h3>drinks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>desserts</h3>
      </a>
   </div>
</section>

<section class="products">
   <h1 class="title">latest dishes</h1>
   <div class="box-container">
      <?php
         $select_products = $con->query("SELECT * FROM `products` LIMIT 6");
         if($select_products){
            while($fetch_products = $select_products->fetch_assoc()){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>₹</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
            $select_products->free();
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
   </div>
   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});
</script>

</body>
</html>
