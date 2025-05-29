<?php $selectedCardId = 0; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>

    <?php require_once "blocks/header.php"; ?>

    <main>
        <div class="groupOfCards">

        <div class="card">
                <div class="info">
                    <div class="picture">
                        <img src="sourse/img/photo1.jpg" alt="card">
                    </div>
                    <div class="info-text">
                        <p>Адрес: ' . $card->adress . '<br>
                            Год: ' . $card->year . '<br>
                            Тип: ' . $card->type . '<br>
                            Размер: ' . $card->size . '<br>
                            Стоимость/час: ' . $card->price . '₽<br>
                            Компания: ' . $card->company . '<br>
                            Режим работы: ' . $card->worktime . '<br>
                            Дополнительная информация:<br> ' . $card->description . '<br>
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent" onclick="window.location.href='/SummerPractice2/booking.php'">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>
            <?php
                // DB
                include("../../pass.php");
                $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
                [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                // SQL
                $sql = 'SELECT * FROM SummerPractice2cards';
                $query = $db->prepare($sql);
                $query->execute();
                $cards = $query->fetchAll(PDO::FETCH_OBJ);

                foreach($cards as $card)
                    echo '<div class="card">
                <div class="info">
                    <div class="picture">
                        <img src="sourse/img/' . $card->picture . '" alt="card">
                    </div>
                    <div class="info-text">
                        <p>Адрес: ' . $card->adress . '<br>
                            Год: ' . $card->year . '<br>
                            Тип: ' . $card->type . '<br>
                            Размер: ' . $card->size . '<br>
                            Стоимость/час: ' . $card->price . '₽<br>
                            Компания: ' . $card->company . '<br>
                            Режим работы: ' . $card->worktime . '<br>
                            Дополнительная информация:<br> ' . $card->description . '<br>
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>';
            ?>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>