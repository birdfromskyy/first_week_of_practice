<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Только вкусная еда! </span>
         <h3>Откройте для себя волшебство в каждом блюде с KING-FOOD</h3>
         <p>KING-FOOD - это не просто место, где вы можете насладиться вкусной едой, это место, где каждый прием пищи становится незабываемым событием. Наши бургеры, пиццы, суши и напитки приготовлены с любовью и заботой, чтобы удовлетворить ваши гастрономические желания. Мы гордимся тем, что предлагаем только самые свежие и качественные ингредиенты, чтобы каждый укус приносил вам удовольствие. Присоединяйтесь к нам и окунитесь в мир вкуса и удовольствия с KING-FOOD!</p>
         <a href="about.php" class="btn">О нас</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">Выбери категорию</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pizza.jpg" alt="" width="190" height="150">
         <h3>Пицца</h3>
         <p>Пицца: удобство, поддержка, стиль, динамика - ваш активный образ.</p>
         <a href="category.php?category=vegitables" class="btn">Выбрать</a>
      </div>

      <div class="box">
         <img src="images/napitki.jpg" alt="" width="190" height="150">
         <h3>Напитки</h3>
         <p>Напитки: свобода выражения, комфорт и стиль в каждой детали.</p>
         <a href="category.php?category=fruits" class="btn">Выбрать</a>
      </div>

      <div class="box">
         <img src="images/burger.jpeg" alt="" width="190" height="150">
         <h3>Бургеры</h3>
         <p>Бургеры: комфорт, тепло, стиль, свобода движения - ваша уютная мода.</p>
         <a href="category.php?category=meat" class="btn">Выбрать</a>
      </div>

      <div class="box">
         <img src="images/zakuski.jpg" alt="" width="190" height="150">
         <h3>Закуски</h3>
         <p>Закуски: символ роскоши, элегантности и безупречного стиля для уверенного образа.</p>
         <a href="category.php?category=fish" class="btn">Выбрать</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Некоторые продукты</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="В Избранные" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="В корзину" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>