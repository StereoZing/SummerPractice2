<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Брониррование</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>
    
    <?php require_once "blocks/header.php"; ?>
    
    <main>
        <div class="container">

            <?php
            // Вывод сообщений об ошибках
            if (isset($_SESSION['booking_errors'])) {
                echo '<div class="errors">';
                foreach ($_SESSION['booking_errors'] as $error) {
                    echo '<p>' . htmlspecialchars($error) . '</p>';
                }
                echo '</div>';
                unset($_SESSION['booking_errors']);
            }
            
            // Вывод сообщения об успехе
            if (isset($_SESSION['booking_success'])) {
                echo '<div class="success">' . htmlspecialchars($_SESSION['booking_success']) . '</div>';
                unset($_SESSION['booking_success']);
            }
            ?>
        
            <div class="newBooking">
                <form action="/SummerPractice2/lib/booking.php" method="post">
                    <div class="bookingAddress">
                        <label>
                            Адрес:<br />
                            <select name="selectedCardId" id="selectedCardId">
                                <option value="1">Сормовская 4а</option>
                                <option value="2">Просп. Чекистов, 27</option>
                                <option value="3">Янковского, 24</option>
                                <option value="4">Кирова, 41</option>
                            </select>
                        </label><br/>
                    </div>
                    <div class="input-field">
                        <input type="date" placeholder="Дата" name="date">
                    </div>
                    <div class="input-field">
                        <input type="time" placeholder="Время" name="time">
                    </div>
                    <div class="newBookingBtn">
                        <button type="submit">Забронировать</button>
                    </div>
                </form>
        </div>
    </main>    

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>