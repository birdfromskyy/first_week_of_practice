<?php

@include 'config.php';

session_start();

$courier_email = $_SESSION['courier_email'];
$courier_id = $_SESSION['courier_id'];

if(!isset($courier_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'Статус был изменен!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:courier_orders.php');

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

   
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'courier_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Заказы</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM orders WHERE payment_status = 'завершен' AND courier_email = ?");
         $select_orders->execute([$courier_email]);
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
         <p>Всего: <span><?= $fetch_orders['total_price']; ?>₽</span></p>
         <p>Статус оплаты: <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Нет заказов!</p>';
      }
      ?>

   </div>

</section>



<script src="js/script.js"></script>

</body>
</html>