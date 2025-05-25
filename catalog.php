<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
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
                        <p>Адрес: Сормовская 4а<br>
                            Год: 2014<br>
                            Тип: стадион<br>
                            Размер: 120 × 75<br>
                            Стоимость/час: 78000₽<br>
                            Компания: ООО “Фокус”<br>
                            Режим работы: ср - вс, 8:00 - 23:00<br>
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

    <footer>
        <div class="container">
            Нужна помощь или есть идеи?<br>
            Работаем для вас каждый день с 9:00 до 22:00<br>
            +7 928 203 63 21 StereoZing@gmail.com @stereo_zing<br>
            © 2025 StereoZing<br>
        </div>
    </footer>
</body>
</html>