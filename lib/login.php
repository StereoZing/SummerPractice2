<?php
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

    // DB
    include("../../../pass.php");
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    try{
        $sql = 'SELECT id FROM SummerPractice2users WHERE login = ? AND password = ?';
        $query = $db->prepare($sql);
        $query->execute([$login, $password]);

        if($query->rowCount() > 0){
            echo "Вы успешно вошли";
        }else{
            echo "Неверный логин или пароль";
        }
    }catch(PDOException $e){
        print("Error!: " . $e->getMessage() . "<br/>");
    }
    setcookie("login", $login, time() + (3600 * 24 * 30), "/SummerPractice2/");
    header("Location: /SummerPractice2/user.php");
?>