<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StereoZing</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>

    <?php require_once "blocks/header.php"; ?>

    <div class="mainPicture">
        <img src="sourse/img/mainpic.jpg" alt="main picture">
    </div>

    <div class="container">
        <div class="info">
            <div class="info-text">
                <p>Забронируй прямо сейчас!</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="btn">
            <button  onclick="window.location.href='/SummerPractice2/catalog.php'">Посмотреть каталог</button>
        </div>
    </div>

    <?php require_once "blocks/footer.php"; ?>

</body>
</html>