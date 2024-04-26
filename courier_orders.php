<?php

@include 'config.php';

session_start();

$courier_id = $_SESSION['courier_id'];

if(!isset($courier_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'courier_header.php'; ?>

<section class="dashboard">

   <h1 class="title">Информация</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['рассматривается']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         };
      ?>
      <h3>$<?= $total_pendings; ?>/-</h3>
      <p>Незавершённые Заказы </p>
      <a href="courier_orders_nezaver.php" class="btn">Посмотреть</a>
      </div>

      

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>