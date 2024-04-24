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

      <nav class="navbar">
         <a href="home.php">ГЛАВНАЯ</a>
         <a href="shop.php">ПОКУПКИ</a>
         <a href="orders.php">ЗАКАЗЫ</a>
         <a href="about.php">О НАС</a>
         <a href="contact.php">КОНТАКТЫ</a>
      </nav>

      <div class="icons">
         <a id="menu-btn"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/pcllgpqm.json"
            trigger="hover"
            colors="primary:#121331,secondary:#e88c30,tertiary:#e88c30"
            style="width:45px;height:45px">
         </lord-icon>
         <a id="user-btn"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/xcxzayqr.json"
            trigger="hover"
            state="hover-looking-around"
            colors="primary:#e83a30,secondary:#e88c30"
            style="width:45px;height:45px">
         </lord-icon></a>
         <a href="search_page.php"> <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/ybaojceo.json"
            trigger="hover"
            colors="primary:#848484,secondary:#e88c30,tertiary:#794628"
            style="width:45px;height:45px">
         </lord-icon></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <a href="wishlist.php"><script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/biobqpgs.json"
            trigger="hover"
            colors="primary:#e83a30,secondary:#ebe6ef,tertiary:#ffc738,quaternary:#f9c9c0,quinary:#f24c00"
            style="width:45px;height:45px">
         </lord-icon>
         </a>
         <a href="cart.php">
         <script src="https://cdn.lordicon.com/lordicon.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/cosvjkbu.json"
            trigger="hover"
            colors="primary:#e88c30,secondary:#646e78,tertiary:#3a3347"
            style="width:49px;height:49px">
         </lord-icon>
         </a>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <div class="flex-btn">
            <a href="user_profile_update.php" class="btn">обновить профиль</a>
            <a href="logout.php" class="delete-btn">выйти</a>
         </div>
      </div>

   </div>

</header>