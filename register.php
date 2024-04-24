<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $role = $_POST['role'];
   $role = filter_var($role, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'E-mail уже занят!';
   }else{
      if($pass != $cpass){
         $message[] = 'Пароли не совпадают!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, user_type, image) VALUES(?,?,?,?,?)");
         $insert->execute([$name, $email, $pass, $role, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'Изображение слишком большое!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'Вы зарегистрированы!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/components.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>Регистрация</h3>
      <input type="text" name="name" class="box" placeholder="Введите ваше имя" required>
      <input type="email" name="email" class="box" placeholder="Введите ваш email" required>
      <input type="password" name="pass" class="box" placeholder="Придумайте пароль" required>
      <input type="password" name="cpass" class="box" placeholder="Подтвердите пароль" required>
      <select name="role" class="box" required>
            <option value="" selected disabled>Выберите роль</option>
               <option value="user">Пользователь</option>
               <option value="admin">Менеджер</option>
               <option value="courier">Курьер</option>
               <option value="kitchen">Кухня</option>
      </select>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Зарегистрироваться" class="btn" name="submit">
      <p>У вас есть аккаунт? <a href="login.php">Авторизация</a></p>
   </form>

</section>


</body>
</html>