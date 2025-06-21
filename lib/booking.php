<?php
// Должно быть ПЕРВЫМИ строками, без пробелов/вывода ДО этого!
session_start();

// Отладочный вывод (убрать в продакшене)
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_SESSION);

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    // Используем относительный путь
    header("Location: login.php");
    exit();
}

// Подключение к базе данных
include("../../pass.php");
try {
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
        PDO::ATTR_PERSISTENT => true, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Обработка формы бронирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Валидация данных
    $errors = [];
    
    $card_id = filter_input(INPUT_POST, 'selectedCardId', FILTER_VALIDATE_INT);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id'];
    
    // Проверка, что площадка существует
    $stmt = $db->prepare("SELECT id FROM SummerPractice2cards WHERE id = ?");
    $stmt->execute([$card_id]);
    if (!$stmt->fetch()) {
        $errors[] = "Выбранная площадка не существует";
    }
    
    // Проверка даты (должна быть не раньше текущего дня)
    $currentDate = new DateTime();
    $bookingDate = DateTime::createFromFormat('Y-m-d', $date);
    if (!$bookingDate || $bookingDate < $currentDate) {
        $errors[] = "Некорректная дата бронирования";
    }
    
    // Проверка времени
    if (!preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $time)) {
        $errors[] = "Некорректное время бронирования";
    }
    
    // Проверка на дублирование брони (одна площадка, одно время, одна дата)
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
            
            // Перенаправляем с сообщением об успехе
            $_SESSION['booking_success'] = "Бронирование успешно создано!";
            header("Location: /SummerPractice2/booking.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Ошибка при сохранении бронирования: " . $e->getMessage();
        }
    }
    
    // Если есть ошибки - сохраняем их в сессию и перенаправляем обратно
    if (!empty($errors)) {
        $_SESSION['booking_errors'] = $errors;
        header("Location: /SummerPractice2/booking.php");
        exit();
    }
} else {
    // Если запрос не POST - перенаправляем
    header("Location: /SummerPractice2/booking.php");
    exit();
}