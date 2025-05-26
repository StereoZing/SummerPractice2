<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>

    <?php require_once "blocks/header.php"; ?>

    <main>

        <form metod="post" action="/SummerPractice2/lib/login.php">
            <div class="container">
                <div class="formBlocks">
                    <div class="Enter">
                        <div class="Login">
                            <div class="input-field">
                                <input type="text" placeholder="Логин">
                            </div>
                        </div>
                        <div class="Password">
                            <div class="input-field">
                                <input type="password" placeholder="Пароль">
                            </div>
                        </div>
                    </div>
                    <button class="regButton" type="submit">Войти</button>
                </div>
        </form>

    </main>

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>