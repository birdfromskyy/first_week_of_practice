<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Мои заказы</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
      <div class="box">
         <p>Дата: <span><?= $fetch_orders['placed_on']; ?></span></p>
         <p>Имя: <span><?= $fetch_orders['name']; ?></span></p>
         <p>Номер: <span><?= $fetch_orders['number']; ?></span></p>
         <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
         <p>Адрес дом: <span><?= $fetch_orders['flat']; ?></span></p>
         <p>Квартира: <span><?= $fetch_orders['street']; ?></span></p>
         <p>Город: <span><?= $fetch_orders['city']; ?></span></p>
         <p>Пожелания: <span><?= $fetch_orders['pin']; ?></span></p>
         <p>Способ оплаты: <span><?= $fetch_orders['method']; ?></span></p>
         <p>Продукты: <span><?= $fetch_orders['total_products']; ?></span></p>
         <p>Всего: <span>$<?= $fetch_orders['total_price']; ?></span></p>
         <p>Статус оплаты: <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
      </div>
   <?php
      }
   }else{
      echo '<p class="empty">НЕТ ЗАКАЗОВ!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>