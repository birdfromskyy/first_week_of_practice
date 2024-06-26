<?php

@include 'config.php';

session_start();

$courier_id = $_SESSION['courier_id'];

if(!isset($courier_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $select_message = $conn->prepare("SELECT * FROM `message_courier` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Уже отправленное сообщение!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message_courier`(courier_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$courier_id, $name, $email, $number, $msg]);

      $message[] = 'Сообщение отправлено!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'courier_header.php'; ?>

<section class="contact">

   <h1 class="title">Оставить сообщение</h1>

   <form action="" method="POST">
      <input type="text" name="name" class="box" required placeholder="Введите ваше имя">
      <input type="email" name="email" class="box" required placeholder="Введите ваш email">
      <input type="number" name="number" min="0" class="box" required placeholder="Введите ваш номер">
      <textarea name="msg" class="box" required placeholder="Введите ваше сообщение" cols="30" rows="10"></textarea>
      <input type="submit" value="Отправить сообщение" class="btn" name="send">
   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>