<!DOCTYPE html>
<html lang="en">
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
        <?php
            if(isset($_COOKIE['login'])){
                echo '<div class="container">
            <div class="info">
                <div class="info-text">
                    <p>Здравствуйте, '.htmlspecialchars($_COOKIE['login']).' </p>
                </div>
            </div>
        </div>';
            } else {
                echo '<div class="container">
            <div class="info">
                <div class="info-text">
                    <p>Вы не авторизованы!</p>
                </div>
            </div>
        </div>';
            }
        ?>

        <div class="container">
            <div class='regOrLogin'>
                    <?php
                        if(isset($_COOKIE['login'])){
                            echo '<button onclick="window.location.href=\'/SummerPractice2/lib/logout.php\'">Выйти</button>';
                        } else {
                            echo '<button onclick="window.location.href=\'/SummerPractice2/register.php\'">Регистрация</button>';
                            echo '<button onclick="window.location.href=\'/SummerPractice2/enter.php\'">Вход</button>';
                        }
                    ?>
            </div>
        </div>

        <?php
        // Обработка отмены бронирования
        if(isset($_POST['cancel_booking']) && isset($_COOKIE['user_id'])) {
            include("../../pass.php");
            try {
                $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
                    PDO::ATTR_PERSISTENT => true, 
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                
                // Проверяем, что бронь принадлежит пользователю
                $stmt = $db->prepare("SELECT id FROM SummerPractice2bookings WHERE id = ? AND user_id = ?");
                $stmt->execute([$_POST['booking_id'], $_COOKIE['user_id']]);
                
                if ($stmt->fetch()) {
                    // Удаляем бронь
                    $stmt = $db->prepare("DELETE FROM SummerPractice2bookings WHERE id = ?");
                    $stmt->execute([$_POST['booking_id']]);
                    echo '<div class="container"><p class="success">Бронирование успешно отменено!</p></div>';
                }
            } catch (PDOException $e) {
                echo '<div class="container"><p class="error">Ошибка при отмене бронирования: '.$e->getMessage().'</p></div>';
            }
        }
        ?>

        <div class = "container">
            <div class="bookings">
                <?php
                // Подключаемся к БД только если пользователь авторизован
                if(isset($_COOKIE['user_id'])) {
                    include("../../pass.php");
                    try {
                        $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
                            PDO::ATTR_PERSISTENT => true, 
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);
                        
                        // Получаем бронирования пользователя
                        $stmt = $db->prepare("
                            SELECT b.id, b.date, b.time, c.adress, c.picture 
                            FROM SummerPractice2bookings b
                            JOIN SummerPractice2cards c ON b.card_id = c.id
                            WHERE b.user_id = ?
                            ORDER BY b.date, b.time
                        ");
                        $stmt->execute([$_COOKIE['user_id']]);
                        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (empty($bookings)) {
                            echo '<p>У вас нет активных бронирований</p>';
                        } else {
                            foreach ($bookings as $booking) {
                                echo '
                                <div class="booking">
                                    <div class="booking-img">
                                        <img src="sourse/img/'.$booking['picture'].'" alt="booking-img">
                                    </div>
                                    <div class="info">
                                        <div class="booking-text">
                                            <p>
                                                Адрес: '.htmlspecialchars($booking['adress']).'<br>
                                                Дата: '.htmlspecialchars($booking['date']).'<br>
                                                Время: '.htmlspecialchars($booking['time']).'
                                            </p>
                                        </div>
                                        <div class="booking-btns">
                                            <form action="/SummerPractice2/edit_booking.php" method="post" style="display: inline;">
                                                <input type="hidden" name="booking_id" value="'.$booking['id'].'">
                                                <button type="submit" name="edit_booking">Изменить</button>
                                            </form>
                                            <form action="user.php" method="post" style="display: inline;">
                                                <input type="hidden" name="booking_id" value="'.$booking['id'].'">
                                                <button type="submit" name="cancel_booking">Отменить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    } catch (PDOException $e) {
                        echo '<p class="error">Ошибка загрузки бронирований: '.$e->getMessage().'</p>';
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>