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
                    <p>Здраствуйте, '.$_COOKIE['login'].' </p>
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


        <div class = "container">
            <div class="bookings">
                <div class="booking">
                    <div class="booking-img">
                        <img src="sourse/img/photo2.jpg" alt="booking-img">
                    </div>
                    <div class="info">
                        <div class="booking-text">
                            <p>
                                Адрес:<br>
                                Дата:<br>
                                Время:
                            </p>
                        </div>
                        <div class="booking-btns">
                            <button id="change">Изменить</button>
                            <button id="cancel">Отменить</button>
                        </div>
                    </div>
                </div>

                <div class="booking">
                    <div class="booking-img">
                        <img src="sourse/img/photo4.jpg" alt="booking-img">
                    </div>
                    <div class="info">
                        <div class="booking-text">
                            <p>
                                Адрес:<br>
                                Дата:<br>
                                Время:
                            </p>
                        </div>
                        <div class="booking-btns">
                            <button id="change">Изменить</button>
                            <button id="cancel">Отменить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
    
</body>
</html>