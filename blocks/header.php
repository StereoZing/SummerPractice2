<header class="container">
    <span class = logo>
        <img src="sourse/img/Logo1.png" alt="logo">
    </span>
    <nav>
        <ul>
            <li class="active"><a href="/SummerPractice2/index.php">Главная</a></li>
            <li class="active"><a href="/SummerPractice2/catalog.php">Каталог</a></li>
            <li class="active"><a href="/SummerPractice2/user.php">Резервирование</a></li>

            <?php
                if(isset($_COOKIE['login'])){
                    echo '<li class="active"><a href="/SummerPractice2/user.php">Личный кабинет</a></li>';
                } else {
                    echo '<li class="active"><a href="/SummerPractice2/register.php">Регистрация</a></li>';
                    echo '<li class="active"><a href="/SummerPractice2/enter.php">Вход</a></li>';
                }
            ?>
        </ul>
    </nav>
    <div class="avatar">
        <img src="sourse/img/NoAvatar.png" alt="avatar">
    </div>            
</header>