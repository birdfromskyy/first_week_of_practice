<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_message = $conn->prepare("DELETE FROM `message_kitchen` WHERE id = ?");
    $delete_message->execute([$delete_id]);
    header('location:admin_contacts_kitchen.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="messages">

        <h1 class="title">Сообщения</h1>

        <div class="box-container">

            <?php
            $select_message = $conn->prepare("SELECT * FROM `message_kitchen`");
            $select_message->execute();
            if ($select_message->rowCount() > 0) {
                while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
                    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_user->execute([$fetch_message['kitchen_id']]);
                    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
            ?>
                    <div class="box">
                        <p> user id : <span><?= $fetch_message['kitchen_id']; ?></span> </p>
                        <p> name : <span><?= $fetch_message['name']; ?></span> </p>
                        <p> number : <span><?= $fetch_message['number']; ?></span> </p>
                        <p> email : <span><?= $fetch_message['email']; ?></span> </p>
                        <p> message : <span><?= $fetch_message['message']; ?></span> </p>
                        <a href="admin_contacts_kitchen.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('Удалить это сообщение?');" class="delete-btn">Удалить</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Нет сообщений!</p>';
            }
            ?>

        </div>

    </section>

    <script src="js/script.js"></script>

</body>

</html>
