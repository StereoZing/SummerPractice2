<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>

    <?php require_once "blocks/header.php"; ?>

    <main>
        <div class="container">
            <h1>Мои бронирования</h1>
            <div class="bookings-list">
                <?php
                if (!isset($_COOKIE['login'])) {
                    header("Location: /SummerPractice2/enter.php");
                    exit;
                }

                include("../../pass.php");
                $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
                    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                // Получаем ID пользователя
                $sql = 'SELECT id FROM SummerPractice2users WHERE login = ?';
                $query = $db->prepare($sql);
                $query->execute([$_COOKIE['login']]);
                $user = $query->fetch(PDO::FETCH_OBJ);

                // Получаем бронирования пользователя
                $sql = 'SELECT b.*, c.adress, c.type, c.price 
                        FROM SummerPractice2bookings b
                        JOIN SummerPractice2cards c ON b.card_id = c.id
                        WHERE b.user_id = ? AND b.status = "active"
                        ORDER BY b.booking_date, b.start_time';
                $query = $db->prepare($sql);
                $query->execute([$user->id]);
                $bookings = $query->fetchAll(PDO::FETCH_OBJ);

                if (count($bookings) > 0) {
                    foreach ($bookings as $booking) {
                        echo '<div class="booking-card">
                                <div class="booking-info">
                                    <h3>' . $booking->type . ' - ' . $booking->adress . '</h3>
                                    <p>Дата: ' . $booking->booking_date . '</p>
                                    <p>Время: ' . substr($booking->start_time, 0, 5) . ' - ' . substr($booking->end_time, 0, 5) . '</p>
                                    <p>Стоимость: ' . ($booking->price * (strtotime($booking->end_time) - strtotime($booking->start_time)) / 3600) . '₽</p>
                                </div>
                                <div class="booking-actions">
                                    <form action="/SummerPractice2/lib/update_booking.php" method="post">
                                        <input type="hidden" name="booking_id" value="' . $booking->id . '">
                                        <input type="time" name="new_start_time" value="' . substr($booking->start_time, 0, 5) . '">
                                        <input type="time" name="new_end_time" value="' . substr($booking->end_time, 0, 5) . '">
                                        <button type="submit">Изменить время</button>
                                    </form>
                                    <form action="/SummerPractice2/lib/cancel_booking.php" method="post">
                                        <input type="hidden" name="booking_id" value="' . $booking->id . '">
                                        <button type="submit">Отменить</button>
                                    </form>
                                </div>
                              </div>';
                    }
                } else {
                    echo '<p>У вас нет активных бронирований</p>';
                }
                ?>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>