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
                            Дополнительная информация: ' . $card->description . '<br>
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>';
            ?>

            <div class="card">
                <div class="info">
                    <div class="picture">
                        <img src="sourse/img/photo2.jpg" alt="card">
                    </div>
                    <div class="info-text">
                        <p>Адрес: просп. Чекистов, 27<br>
                            Год: 2017<br>
                            Тип: стадион<br>
                            Размер: 100 × 65<br>
                            Стоимость/час: 12000₽<br>
                            Компания: ООО “Антик”<br>
                            Режим работы: без выходных, 11:00 - 1:00<br>
                            Дополнительная информация:<br>          
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>

            <div class="card">
                <div class="info">
                    <div class="picture">
                        <img src="sourse/img/photo3.jpg" alt="card">
                    </div>
                    <div class="info-text">
                        <p>Адрес: Янковского, 24<br>
                            Год: 2006<br>
                            Тип: баскетбольная площадка<br>
                            Размер: 30 × 8<br>
                            Стоимость/час: 1900₽<br>
                            Компания: ООО “Спорт без Преград”<br>
                            Режим работы: вс - чт, 9:00 - 21:00<br>
                            Дополнительная информация:<br>
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>

            <div class="card">
                <div class="info">
                    <div class="picture">
                        <img src="sourse/img/photo4.jpg" alt="card">
                    </div>
                    <div class="info-text">
                        <p>Адрес: Кирова, 41<br>
                            Год: 2021<br>
                            Тип: бассейн<br>
                            Размер: 25 × 15<br>
                            Стоимость/час: 700₽<br>
                            Компания: ООО “Аквадар”<br>
                            Режим работы: вт - сб, 8:00 - 20:00<br>
                            Дополнительная информация:<br>
                        </p>
                    </div>
                </div>
                <div class="btns">
                    <button id="rent">Забронировать</button>
                    <!-- <button id="more">Подробнее</button> -->
                </div>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>