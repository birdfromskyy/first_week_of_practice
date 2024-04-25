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
            src="https://cdn.lordicon.com/eoacwhtz.json"
            trigger="hover"
            colors="primary:#242424,secondary:#f4c89c,tertiary:#e4e4e4,quaternary:#c71f16,quinary:#242424,senary:#242424,septenary:#e88c30"
            style="width:70px;height:70px">
         </lord-icon>
      </div>

      
      <nav class="navbar">
         <a href="courier_home.php">ГЛАВНАЯ<span></span></a>
         <a href="courier_orders_nezaver.php">ЗАКАЗЫ</a>
         <a href="courier_active_orders.php">АКТИВНЫЕ</a>
         <a href="courier_zaver.php">ЗАВЕРШЕННЫЕ</a>
         <a href="courier_contact.php">ПОДДЕРЖКА</a>
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
            src="https://cdn.lordicon.com/yymnvbnt.json"
            trigger="hover"
            colors="primary:#121331,secondary:#3a3347,tertiary:#f4c89c,quaternary:#e88c30,quinary:#b4b4b4"
            style="width:70px;height:70px">
         </lord-icon>


         
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$courier_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$courier_id]);
         ?>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$courier_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <p>Баланс: <?= $fetch_profile['balance']; ?></p>
         <a href="courier_profile_update.php" class="btn">обновить профиль</a>
         <a href="logout.php" class="delete-btn">выйти</a>
      </div>

   </div>

</header>