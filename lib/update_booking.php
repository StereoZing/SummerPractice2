<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_COOKIE['login'])) {
        header("Location: /SummerPractice2/enter.php");
        exit;
    }

    $booking_id = filter_var($_POST['booking_id'], FILTER_SANITIZE_NUMBER_INT);
    $new_start_time = filter_var($_POST['new_start_time'], FILTER_SANITIZE_STRING);
    $new_end_time = filter_var($_POST['new_end_time'], FILTER_SANITIZE_STRING);

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

    $booking = $query->fetch(PDO::FETCH_OBJ);

    // Проверяем доступность нового времени
    $sql = 'SELECT * FROM SummerPractice2bookings 
            WHERE card_id = ? AND booking_date = ? AND id != ? AND
            ((start_time <= ? AND end_time >= ?) OR 
            (start_time <= ? AND end_time >= ?) OR 
            (start_time >= ? AND end_time <= ?))';
    $query = $db->prepare($sql);
    $query->execute([
        $booking->card_id, 
        $booking->booking_date, 
        $booking_id,
        $new_start_time, 
        $new_start_time, 
        $new_end_time, 
        $new_end_time, 
        $new_start_time, 
        $new_end_time
    ]);

    if ($query->rowCount() > 0) {
        echo "Это время уже занято";
    } else {
        // Обновляем бронирование
        $sql = 'UPDATE SummerPractice2bookings 
                SET start_time = ?, end_time = ?
                WHERE id = ?';
        $query = $db->prepare($sql);
        $query->execute([$new_start_time, $new_end_time, $booking_id]);
        echo "Время бронирования успешно изменено";
    }

    header("Location: /SummerPractice2/user.php");
}
?>