<?php

include 'config.php'; 

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if(isset($input['orderId'])) {
    $orderId = $input['orderId'];

    $query = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $query->execute([$orderId]);

    if($query->rowCount() > 0) {
        $orderData = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($orderData);
    } else {
        echo json_encode(['error' => 'Заказ не найден']);
    }
} else {
    echo json_encode(['error' => 'ID заказа не найден']);
}

?>
