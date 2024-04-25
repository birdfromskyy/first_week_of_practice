<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $flat = $_POST['flat'];
   $flat = filter_var($flat, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $street = $_POST['street'];
   $street = filter_var($street, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pin = $_POST['pin'];
   $pin = filter_var($pin, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND flat = ? AND street = ? AND city = ? AND pin = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $flat, $street, $city, $pin, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'Корзина пустая';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'заказ уже размещен!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, flat, street, city, pin, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $flat, $street, $city, $pin, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'Заказ успешно размещён!';
   }

}


$order_name = isset($_SESSION['order_name']) ? $_SESSION['order_name'] : '';
$order_number = isset($_SESSION['order_number']) ? $_SESSION['order_number'] : '';
$order_email = isset($_SESSION['order_email']) ? $_SESSION['order_email'] : '';
$order_method = isset($_SESSION['order_method']) ? $_SESSION['order_method'] : '';
$order_flat = isset($_SESSION['order_flat']) ? $_SESSION['order_flat'] : '';
$order_street = isset($_SESSION['order_street']) ? $_SESSION['order_street'] : '';
$order_city = isset($_SESSION['order_city']) ? $_SESSION['order_city'] : '';
$order_pin = isset($_SESSION['order_pin']) ? $_SESSION['order_pin'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= $fetch_cart_items['price'].'₽ x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
   }
   }else{
      echo '<p class="empty">Ваша корзина пуста!</p>';
   }
   ?>
   <div class="grand-total">Общая стоимость : <span><?= $cart_grand_total; ?>₽</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>Заполните для покупки</h3>

      <div class="flex">
         <div class="inputBox">
            <span>имя :</span>
            <input type="text" name="name" value="<?= $order_name ?>" placeholder="Введите ваше имя" class="box" required>
         </div>
         <div class="inputBox">
            <span>номер :</span>
            <input type="text" name="number" value="<?= $order_number ?>" placeholder="Введите ваш номер" class="box" required>
         </div>
         <div class="inputBox">
            <span>email :</span>
            <input type="email" name="email" value="<?= $order_email ?>" placeholder="Введите ваш email" class="box" required>
         </div>
         <div class="inputBox">
            <span>способ оплаты :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery" <?= ($order_method == 'cash on delivery') ? 'selected' : '' ?>>По Сберу</option>
               <option value="credit card" <?= ($order_method == 'credit card') ? 'selected' : '' ?>>По Тинькофу</option>
               <option value="paytm" <?= ($order_method == 'paytm') ? 'selected' : '' ?>>Карта Мир</option>
               <option value="paypal" <?= ($order_method == 'paypal') ? 'selected' : '' ?>>Сбер Онлайн</option>
            </select>
         </div>
         <div class="inputBox">
            <span>адресс дом :</span>
            <input type="text" name="flat" value="<?= $order_flat ?>" placeholder="" class="box" required>
         </div>
         <div class="inputBox">
            <span>квартира :</span>
            <input type="text" name="street" value="<?= $order_street ?>" placeholder="" class="box" required>
         </div>
         <div class="inputBox">
            <span>город :</span>
            <input type="text" name="city" value="<?= $order_city ?>" placeholder="Khanty-Mansysk" class="box" required>
         </div>
         <div class="inputBox">
            <span>пожелания :</span>
            <input type="text" name="pin" value="<?= $order_pin ?>" placeholder="" class="box" >
         </div>
      </div>


      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="заказать">
      <button onclick="showPastOrders()">Показать прошлые заказы</button>
      
      <div id="pastOrders" style="display:none;">
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
            <p>Всего: <span><?= $fetch_orders['total_price']; ?>₽</span></p>
            <p>Статус оплаты: <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
            <button class="use-order" onclick="fetchOrderData(<?= $fetch_orders['id']; ?>)">Использовать этот заказ</button>
         </div>
         <?php
               }
            } else {
               echo '<p class="empty">Нет заказов!</p>';
            }
         ?>
      </div>

   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
