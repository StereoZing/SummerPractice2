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
            if(isset($_COOKIE['login'])) {
                echo '<div class="container">
                    <div class="info">
                        <div class="info-text">
                            <p>Здравствуйте, '.htmlspecialchars($_COOKIE['login']).'</p>
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
                    if(isset($_COOKIE['login'])) {
                        echo '<button onclick="window.location.href=\'/SummerPractice2/lib/logout.php\'">Выйти</button>';
                    } else {
                        echo '<button onclick="window.location.href=\'/SummerPractice2/register.php\'">Регистрация</button>';
                        echo '<button onclick="window.location.href=\'/SummerPractice2/enter.php\'">Вход</button>';
                    }
                ?>
            </div>
        </div>

        <div class="container">
            <div class="bookings">
                <?php
                if(isset($_COOKIE['user_id'])) {
                    include("../../pass.php");
                    try {
                        $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass, [
                            PDO::ATTR_PERSISTENT => true, 
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);
                        
                        $stmt = $db->prepare("
                            SELECT b.date, b.time, c.adress, c.picture 
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
                                            <button id="change">Изменить</button>
                                            <button id="cancel">Отменить</button>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    } catch (PDOException $e) {
                        echo '<p class="error">Ошибка загрузки бронирований</p>';
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>