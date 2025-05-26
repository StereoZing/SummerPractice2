<?php
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password_confirm = trim(filter_var($_POST['password_confirm'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($login) || empty($name) || empty($email) || empty($password) || empty($password_confirm)){
        echo "Все поля обязательны";
    }else{
        if($password != $password_confirm){
            echo "Пароли не совпадают";
        }else{
            if(strlen($login) < 3 || strlen($login) > 20){
                echo "Длина логина должна быть от 3 до 20 символов";
                exit;
            }

            if(strlen($name) < 3 || strlen($name) > 20){
                echo "Длина имени должна быть от 3 до 20 символов";
                exit;
            }

            if(strlen($email) < 5 || strlen($email) > 20 || strpos($email, '@') === false){
                echo "Длина email должна быть от 5 до 20 символов и должна содержать символ @";
                exit;
            }

            if(strlen($password) < 6){
                echo "Длина пароля должна быть не менее 6 символов";
                exit;
            }
        }
    }

    // DB
    include("../../../pass.php");
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    try{
        $SQL = "INSERT INTO SummerPractice2users (name, login, email, password) VALUES (?, ?, ?, ?)";
        $query = $db->prepare($SQL);
        $query->execute([$name, $login, $email, $password]);

        echo "Вы успешно зарегистрировались";
    }catch(PDOException $e){
        print("Error!: " . $e->getMessage() . "<br/>");
    }

    header("Location: /SummerPractice2/index.php");
?>