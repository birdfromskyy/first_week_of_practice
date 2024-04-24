<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};


if(isset($_POST['update_product'])){

   
   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  
   if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
      $image = $_FILES['image']['name'];
      $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'uploaded_img/'.$image;
   } else {
    
      $image = $_POST['old_image'];
   }

  
   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, details = ?, price = ?, image = ? WHERE id = ?");
   $update_product->execute([$name, $category, $details, $price, $image, $pid]);

  
   $message[] = 'Продукт успешно обновлен!';

   if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
      if($image_size > 2000000){
         $message[] = 'Размер изображения слишком большой!';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);

         if(file_exists('uploaded_img/'.$_POST['old_image'])) {
            unlink('uploaded_img/'.$_POST['old_image']);
            $message[] = 'Старое изображение успешно удалено!';
         } else {
            $message[] = 'Старое изображение не найдено!';
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
   <title>update products</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">Обновить продукт</h1>   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <input type="text" name="name" placeholder="Введите название продукта" required class="box" value="<?= $fetch_products['name']; ?>">
      <input type="number" name="price" min="0" placeholder="Введите цену продукта" required class="box" value="<?= $fetch_products['price']; ?>">
      <select name="category" class="box" required>
         <option value="" selected disabled>Выберите категорию</option>
            <option value="pizza">Пицца</option>
            <option value="napitki">Напитки</option>
            <option value="burger">Бургеры</option>
            <option value="zakuski">Закуски</option>
      </select>
      <textarea name="details" required placeholder="enter product details" class="box" cols="10" rows="1"><?= $fetch_products['details']; ?></textarea>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <div class="flex-btn">
         <input type="submit" class="btn" value="Обновить продукт" name="update_product">
         <a href="admin_products.php" class="option-btn">Вернуться назад</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>













<script src="js/script.js"></script>

</body>
</html>