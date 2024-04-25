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
            src="https://cdn.lordicon.com/yeoppmgu.json"
            trigger="hover"
            stroke="bold"
            style="width:80px;height:80px">
         </lord-icon>
      </div>
      <nav class="navbar">
         <a href="kitchen_home.php">МОЯ СТРАНИЦА</a>
         <a href="kitchen_orders_nezaver.php">ЗАКАЗЫ</a>
         <a href="kitchen_to_courier.php">ПОДТВЕРДИТЬ ЗАКАЗ</a>
         <a href="kitchen_contact.php">ПОДДЕРЖКА</a>
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
            src="https://cdn.lordicon.com/pyarizrk.json"
            trigger="hover"
            colors="primary:#121331,secondary:#f4c89c,tertiary:#e88c30,quaternary:#242424"
            style="width:80px;height:80px">
         </lord-icon>
         
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$kitchen_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$kitchen_id]);
         ?>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$kitchen_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="kitchen_profile_update.php" class="btn">обновить профиль</a>
         <a href="logout.php" class="delete-btn">выйти</a>
      </div>

   </div>

</header>