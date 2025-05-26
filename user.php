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
        <div class="container">
            <div class="info">
                <div class="info-text">
                    <p>Ваш логин: <?php echo $_COOKIE['login']; ?></p>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "blocks/footer.php"; ?>
    
</body>
</html>