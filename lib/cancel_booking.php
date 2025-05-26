<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_COOKIE['login'])) {
        header("Location: /SummerPractice2/enter.php");
        exit;
    }

    $booking_id = filter_var($_POST['booking_id'], FILTER_SANITIZE_NUMBER_INT);

    include("../../../pass.php");
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
        [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Проверяем, принадлежит ли бронирование пользователю
    $sql = 'SELECT b.* FROM SummerPractice2bookings b
            JOIN SummerPractice2users u ON b.user_id = u.id
            WHERE b.id = ? AND u.login = ?';
    $query = $db->prepare($sql);
    $query->execute([$booking_id, $_COOKIE['login']]);
    
    if ($query->rowCount() === 0) {
        echo "Ошибка: бронирование не найдено или не принадлежит вам";
        exit;
    }

    // Отменяем бронирование
    $sql = 'UPDATE SummerPractice2bookings 
            SET status = "cancelled"
            WHERE id = ?';
    $query = $db->prepare($sql);
    $query->execute([$booking_id]);

    header("Location: /SummerPractice2/user.php");
}
?>