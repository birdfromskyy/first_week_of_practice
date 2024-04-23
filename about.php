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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about.jpeg" alt="" width="450" height="200">
         <h3>Почему именно мы?</h3>
         <p> У нас только оригинальные продукты, подобранные с заботой о вашем вкусе.</p>
         <a href="contact.php" class="btn1">Контакты</a>
      </div>

      <div class="box">
         <img src="images/about1.jpg" alt="" width="450" height="200">
         <h3>Как сделать покупку?</h3>
         <p>Сделать покупку у нас очень просто. Нажми кнопку ниже и всё готово</p>
         <a href="shop.php" class="btn1">Покупки</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Наши Клиенты</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/rabotnik1.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Альфредо</h3>
      </div>

      <div class="box">
         <img src="images/rabotnik2.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Себастьян</h3>
      </div>

      <div class="box">
         <img src="images/rabotnik8.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Александр</h3>
      </div>

      <div class="box">
         <img src="images/rabotnik4.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Джон</h3>
      </div>

      <div class="box">
         <img src="images/rabotnik5.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Серафим</h3>
      </div>

      <div class="box">
         <img src="images/rabotnik6.png" alt="">
         <p></p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Евгений</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>