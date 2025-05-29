<?php
    $selectedCardId = $_POST['selectedCardId'];
    $date = trim(filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS));
    $time = trim(filter_var($_POST['time'], FILTER_SANITIZE_SPECIAL_CHARS));

    foreach($_POST['selectedCardId'] as $value) {
		echo $value;
        echo"gerrfregftrfergf";
	}

    // // DB
    // include("../../../pass.php");
    
    // $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
    // [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // try{
    //     $sql = 'INSERT INTO SummerPractice2bookings (adress, date, time) VALUES (?, ?, ?)';
    //     $query = $db->prepare($sql);
    //     $query->execute([$adressForBooking, $date, $time]);
    //     echo "Ваше бронирование успешно забронировано";
    // }catch(PDOException $e){
    //     print("Error!: " . $e->getMessage() . "<br/>");
    // }
    // header("Location: /SummerPractice2/user.php");
?>