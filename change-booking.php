<?php
// Проверка авторизации
if (!isset($_COOKIE['user_id'])) {
    header("Location: /SummerPractice2/login.php");
    exit();
}

// Проверка наличия ID бронирования
if (!isset($_GET['id'])) {
    header("Location: /SummerPractice2/user.php");
    exit();
}

// Подключение к БД
include("../../pass.php");
try {
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
        PDO::ATTR_PERSISTENT => true, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    // Проверка, что бронь принадлежит пользователю и получение данных
    $stmt = $db->prepare("SELECT b.*, c.adress 
                        FROM SummerPractice2bookings b
                        JOIN SummerPractice2cards c ON b.card_id = c.id
                        WHERE b.id = ? AND b.user_id = ?");
    $stmt->execute([$_GET['id'], $_COOKIE['user_id']]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
        header("Location: /SummerPractice2/user.php?error=not_your_booking");
        exit();
    }

    // Обработка формы изменения
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
        
        // Валидация даты
        $currentDate = new DateTime();
        $bookingDate = DateTime::createFromFormat('Y-m-d', $date);
        if (!$bookingDate || $bookingDate < $currentDate) {
            $errors[] = "Некорректная дата бронирования";
        }
        
        // Валидация времени
        if (!preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $time)) {
            $errors[] = "Некорректное время бронирования";
        }
        
        // Проверка на дублирование брони
        $stmt = $db->prepare("SELECT id FROM SummerPractice2bookings 
                            WHERE card_id = ? AND date = ? AND time = ? AND id != ?");
        $stmt->execute([$booking['card_id'], $date, $time, $booking['id']]);
        if ($stmt->fetch()) {
            $errors[] = "Это время уже занято";
        }
        
        if (empty($errors)) {
            try {
                $stmt = $db->prepare("UPDATE SummerPractice2bookings 
                                    SET date = ?, time = ? 
                                    WHERE id = ?");
                $stmt->execute([$date, $time, $booking['id']]);
                
                header("Location: /SummerPractice2/user.php?success=booking_updated");
                exit();
            } catch (PDOException $e) {
                $errors[] = "Ошибка при обновлении бронирования: " . $e->getMessage();
            }
        }
    }
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение бронирования</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>
    
    <?php require_once "blocks/header.php"; ?>
    
    <main>
        <div class="container">
            <div class="newBooking">
                <?php if (!empty($errors)): ?>
                    <div class="errors">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <form action="/SummerPractice2/change-booking.php?id=<?= $booking['id'] ?>" method="post">
                    <div class="bookingAddress">
                        <label>
                            Адрес: <?= htmlspecialchars($booking['adress']) ?>
                        </label>
                    </div>
                    <div class="input-field">
                        <input type="date" name="date" value="<?= htmlspecialchars($booking['date']) ?>" required>
                    </div>
                    <div class="input-field">
                        <input type="time" name="time" value="<?= htmlspecialchars($booking['time']) ?>" required>
                    </div>
                    <div class="newBookingBtn">
                        <button type="submit">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>