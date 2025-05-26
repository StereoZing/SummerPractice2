<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_COOKIE['login'])) {
        header("Location: /SummerPractice2/enter.php");
        exit;
    }

    $card_id = filter_var($_POST['card_id'], FILTER_SANITIZE_NUMBER_INT);
    $booking_date = filter_var($_POST['booking_date'], FILTER_SANITIZE_STRING);
    $start_time = filter_var($_POST['start_time'], FILTER_SANITIZE_STRING);
    $end_time = filter_var($_POST['end_time'], FILTER_SANITIZE_STRING);

    include("../../../pass.php");
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
        [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Получаем ID пользователя
    $sql = 'SELECT id FROM SummerPractice2users WHERE login = ?';
    $query = $db->prepare($sql);
    $query->execute([$_COOKIE['login']]);
    $user = $query->fetch(PDO::FETCH_OBJ);

    // Проверяем доступность времени
    $sql = 'SELECT * FROM SummerPractice2bookings 
            WHERE card_id = ? AND booking_date = ? AND 
            ((start_time <= ? AND end_time >= ?) OR 
            (start_time <= ? AND end_time >= ?) OR 
            (start_time >= ? AND end_time <= ?)';
    $query = $db->prepare($sql);
    $query->execute([$card_id, $booking_date, $start_time, $start_time, $end_time, $end_time, $start_time, $end_time]);

    if ($query->rowCount() > 0) {
        echo "Это время уже занято";
    } else {
        // Создаем бронирование
        $sql = 'INSERT INTO SummerPractice2bookings (user_id, card_id, booking_date, start_time, end_time) 
                VALUES (?, ?, ?, ?, ?)';
        $query = $db->prepare($sql);
        $query->execute([$user->id, $card_id, $booking_date, $start_time, $end_time]);
        echo "Бронирование успешно создано";
    }

    header("Location: /SummerPractice2/user.php");
}
?>