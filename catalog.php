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
                    <div class="btns">
                        <button id="rent" onclick="showBookingForm(' . $card->id . ')">Забронировать</button>
                    </div>
                </div>
            </div>';
            ?>
        </div>

        <?php  echo '<div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Бронирование площадки</h2>
            <form action="/SummerPractice2/lib/booking.php" method="post">
                <input type="hidden" id="card_id" name="card_id">
                <div class="input-field">
                    <input type="date" name="booking_date" required>
                </div>
                <div class="input-field">
                    <input type="time" name="start_time" required>
                </div>
                <div class="input-field">
                    <input type="time" name="end_time" required>
                </div>
                <button type="submit" class="regButton">Подтвердить бронь</button>
            </form>
        </div>
      </div>
      <script>
        function showBookingForm(cardId) {
            document.getElementById("card_id").value = cardId;
            document.getElementById("bookingModal").style.display = "block";
        }
        
        function closeModal() {
            document.getElementById("bookingModal").style.display = "none";
        }
        
        window.onclick = function(event) {
            if (event.target == document.getElementById("bookingModal")) {
                closeModal();
            }
        }
      </script>';
      ?>

    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>