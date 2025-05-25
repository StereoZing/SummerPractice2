<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My front</title>
    <link rel="icon" type="image/png" href="/SummerPractice2/sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>
    <header class="container">
        <span class = logo>
            <img src="sourse/img/Logo1.png" alt="logo">
        </span>
        <nav>
            <ul>
                <li class="active"><a href="/SummerPractice2/index.php">Главная</a></li>
                <li class="active"><a href="/SummerPractice2/catalog.php">Каталог</a></li>
                <li class="active"><a href="/SummerPractice2/register.php">Регистрация</a></li>
                <li class="active"><a href="/SummerPractice2/enter.php">Вход</a></li>
            </ul>
        </nav>
        <div class="avatar">
            <img src="sourse/img/NoAvatar.png" alt="avatar">
        </div>            
    </header>

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