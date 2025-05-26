<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="icon" type="image/png" href="sourse/img/Logo1.png">
    <link rel="stylesheet" href="/SummerPractice2/css/style.css">
</head>
<body>
    
    <?php require_once "blocks/header.php"; ?>
    
    <main>
        <form action="/SummerPractice2/lib/reg.php" method="post">
            <div class="container">
                <div class="formBlocks">
                    <div class="NameAndLogin">
                        <div class="input-field">
                            <input type="text" placeholder="Имя" name="name">
                        </div>

                        <div class="input-field">
                            <input type="text" placeholder="Логин" name="login">
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="email">
                            <input type="text" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="PasswordAndConfirm">
                        <div class="input-field">
                            <input type="password" placeholder="Пароль" name="password">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="Подтвердите пароль" name="password_confirm">
                        </div>
                    </div>
                    <button class="regButton" type="submit">Зарегистрироваться</button>
                </div>
        </form>
    </main>    

    <?php require_once "blocks/footer.php"; ?>
</body>
</html>