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
   <title>about</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about11.png" alt="" width="450" height="20">
         <h3>Почему именно мы?</h3>
         <p style="color: black;">У нас только оригинальные продукты, подобранные с заботой о вашем вкусе.</p>
         <a href="contact.php" class="btn1">Контакты</a>
      </div>

      <div class="box">
         <img src="images/about12.png" alt="" width="450" height="200">
         <h3>Как сделать покупку?</h3>
         <p style="color: black;">У нас только оригинальные продукты, подобранные с заботой о вашем вкусе.</p>
         <a href="shop.php" class="btn1">Покупки</a>
      </div>

   </div>

</section>











<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>