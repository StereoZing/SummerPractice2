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
    <main>
        <div class="container">
            <div class="newBooking">
                <form action="/SummerPractice2/lib/booking.php" method="post">
                    <div class="input-field">
                        <input type="date" placeholder="Дата" name="date">
                    </div>
                    <div class="input-field">
                        <input type="time" placeholder="Время" name="time">
                    </div>
                    <div class="newBookingBtn">
                        <button type="submit">Изменить</button>
                    </div>
                </form>
        </div>
    </main>
    </main>    

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>