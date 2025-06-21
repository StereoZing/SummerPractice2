<?php
// Подключение к базе данных
include("../../../pass.php");
try {
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
        PDO::ATTR_PERSISTENT => true, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверка авторизации через куки (как у вас сейчас)
if (!isset($_COOKIE['user_id']) || empty($_COOKIE['user_id'])) {
    header("Location: /SummerPractice2/login.php");
    exit();
}

// Получаем user_id из куки
$user_id = $_COOKIE['user_id'];

// Обработка формы бронирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Валидация данных
    $errors = [];
    
    $card_id = filter_input(INPUT_POST, 'selectedCardId', FILTER_VALIDATE_INT);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    
    // Проверка площадки
    $stmt = $db->prepare("SELECT id FROM SummerPractice2cards WHERE id = ?");
    $stmt->execute([$card_id]);
    if (!$stmt->fetch()) {
        $errors[] = "Выбранная площадка не существует";
    }
    
    // Проверка даты
    $currentDate = new DateTime();
    $bookingDate = DateTime::createFromFormat('Y-m-d', $date);
    if (!$bookingDate || $bookingDate < $currentDate) {
        $errors[] = "Некорректная дата бронирования";
    }
    
    // Проверка времени
    if (!preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $time)) {
        $errors[] = "Некорректное время бронирования";
    }
    
    // Проверка на дублирование брони
    $stmt = $db->prepare("SELECT id FROM SummerPractice2bookings 
                         WHERE card_id = ? AND date = ? AND time = ?");
    $stmt->execute([$card_id, $date, $time]);
    if ($stmt->fetch()) {
        $errors[] = "Это время уже занято";
    }
    
    // Если ошибок нет - сохраняем бронь
    if (empty($errors)) {
        try {
            $stmt = $db->prepare("INSERT INTO SummerPractice2bookings 
                                 (card_id, user_id, time, date) 
                                 VALUES (?, ?, ?, ?)");
            $stmt->execute([$card_id, $user_id, $time, $date]);
            
            // Перенаправляем обратно с параметром успеха
            header("Location: /SummerPractice2/booking.php?success=1");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Ошибка при сохранении бронирования: " . $e->getMessage();
        }
    }
    
    // Если есть ошибки - сохраняем их в URL
    if (!empty($errors)) {
        $error_str = urlencode(implode('|', $errors));
        header("Location: /SummerPractice2/booking.php?errors=" . $error_str);
        exit();
    }
} else {
    // Если запрос не POST - перенаправляем
    header("Location: /SummerPractice2/booking.php");
    exit();
}