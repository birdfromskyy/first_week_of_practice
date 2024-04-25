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

<header class="header">

   <div class="flex">
   <img src="images/logo2.png" alt="KING-FOOD" width="190" height="40" >
      <div class="icons">
         <a id="cur-btn"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/rymzvwiu.json"
            trigger="hover"
            colors="primary:#121331,secondary:#3a3347,tertiary:#e88c30,quaternary:#ffc738,quinary:#4bb3fd,senary:#f24c00,septenary:#08a88a,octonary:#e83a30,nonary:#92140c"
            style="width:80px;height:80px">
         </lord-icon>
      </div>
      <nav class="navbar">
         <a href="admin_page.php">Моя Страница</a>
         <a href="admin_products.php">Добавление Продуктов</a>
         <a href="admin_orders.php">Статус Заказов</a>
         
      </nav>

      <div class="icons">
         <a id="menu-btn"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/uvtlaqep.json"
            trigger="hover"
            colors="primary:#e88c30"
            style="width:45px;height:45px">
         </lord-icon>
         <a id="user-btn"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/szoiozyr.json"
            trigger="hover"
            colors="primary:#242424,secondary:#e88c30,tertiary:#f4c89c,quaternary:#242424,quinary:#66d7ee"
            style="width:80px;height:80px">
         </lord-icon>

         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$admin_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$admin_id]);
         ?>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="admin_update_profile.php" class="btn">Обновить Профиль</a>
         <a href="logout.php" class="delete-btn">Выйти</a>
      </div>

   </div>

</header>