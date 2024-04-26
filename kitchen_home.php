<?php

@include 'config.php';

session_start();

$kitchen_id = $_SESSION['kitchen_id'];

if(!isset($kitchen_id)){
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
      $message[] = 'Уже добавлено в Избранные!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Уже добавлено в Корзину!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'Добавлено в Избранные!';
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
      $message[] = 'Уже добавлено в Корзину!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Добавлено в корзину!';
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

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'kitchen_header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">

         <span>НАШ ЛУЧШИЙ ПОВАР: <?= $fetch_profile['name']; ?> <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="" width="50" height="50" style="border-radius: 50%;"></span>
         <h3>СПАСИБО, ЧТО ТЫ В НАШЕЙ БОЛЬШОЙ КОМАНДЕ</h3>
         <p>Каждый из вас, наши уважаемые шеф-повары, является неотъемлемой частью нашей команды и ключевым элементом в достижении наших целей. Ваш профессионализм, творческий подход к кулинарному искусству и стремление к совершенству делают нашу компанию лучше.

Мы видим ваше усердие и преданность, и хотим выразить вам нашу глубокую благодарность. Ваши кулинарные шедевры не только удовлетворяют вкусовые предпочтения наших клиентов, но и создают неповторимый опыт обслуживания. Пусть ваше творчество и талант всегда будут оценены, а вы сами – вдохновлены успехами, которые достигаете каждый день.

Спасибо вам за ваш вклад и за ваше стремление сделать нашу компанию еще успешнее и лучше для всех!</p>
         
      </div>

   </section>

</div>

<?php include 'kitchen_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>