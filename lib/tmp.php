<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
$error = FALSE;

if (strlen($_POST['name1'])>150) {
	print('Длина не более 150'.PHP_EOL);
	$error = TRUE;
} elseif (preg_match('~[0-9]+~', $_POST['name1'])) {
	print('Имя не должно содержать цифр'.PHP_EOL);
	$error = TRUE;
}

if (!preg_match('/^\+7[0-9]{10}$/', $_POST['tel'])) {
	print('Неверный формат'.PHP_EOL);
	$error = TRUE;
} 

if (!preg_match('~@~', $_POST['email'])) {
	print('Должна содержать @'.PHP_EOL);
	$error = TRUE;
}

$year =(int)substr($_POST['date1'],0,4);
if($year<1800){
	print('Слишком давно'.PHP_EOL);
	$error = TRUE;
} elseif ($year>2025) {
	print('Мелковат'.PHP_EOL);
	$error = TRUE;
} 

if (empty($_POST['languages'])){
	
	print('Вы бёрете язык'.PHP_EOL);
	$error = TRUE;
} 

if (!preg_match('/^[0, 1]$/', $_POST['pol'])){
	print('Не бинарно'.PHP_EOL);
	$error=TRUE;
} 

if (strlen($_POST['biography'])>200){
	print('Слишком длинно'.PHP_EOL);
	$error = TRUE;
} 

if (!$error) {



include("../../../pass.php");
$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

try {
	$stmt = $db->prepare("INSERT INTO applications VALUES (0, ?, ?, ?, ?, ?, ?)");
	$stmt -> execute([$_POST['name1'], $_POST['tel'], $_POST['email'],
					$_POST['date1'], $_POST['pol'], $_POST['biography']]);
	$id_app = $db -> lastInsertId();
	foreach($_POST['languages'] as $value) {
		$stmt = $db->prepare("INSERT INTO app_langs VALUES (?, ?)");
		$stmt -> execute([$id_app,$value]);
	}
}
catch(PDOException $e){
	print('Error 401');
}

}

}


?>

<!DOCTYPE html>

<html lang="ru">

  <head>
    <meta charset="utf-8">
    <title>Лабороторная работа №3</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="styleH.css" />
  </head>

  <body class="fs-120p ff-sans-serif" id="body">

    <main class="mxw-960 container g-0 d-flex flex-column justify-content-center">

      <section class="content order-3 order-sm-3 mt-3 p-3" id="form">
        <h2 class="text-center fw-bold">Форма</h2>

        <form action="./" method="POST">
            <label>
                Имя:<br />
                <input name="name1" required />
            </label><br />

            <label>
                Телефон:<br />
                <input type="tel" name="tel" required />
            </label><br />

            <label>
                Email:<br />
                <input type="email" name="email" required />
            </label><br />

            <label>
                Дата рождения:<br />
                <input type="date" name="date1" />
            </label><br />

            Пол:<br />
            <label>
                <input type="radio" checked="checked" name="pol"
                       value="0" /> Муж
            </label>
            <label>
                <input type="radio" name="pol" value="1" /> Жен
            </label><br />

            <label>
                Любимые языки программирования:<br />
                <select name="languages[]" multiple="multiple">
                    <option value="1">Pascal</option>
                    <option value="2">C</option>
                    <option value="3">C++</option>
                    <option value="4">JavaScript</option>
                    <option value="5">PHP</option>
                    <option value="6">Python</option>
                    <option value="7">Java</option>
                    <option value="8">Haskel</option>
                    <option value="9">Clojure</option>
                    <option value="10">Prolog</option>
                    <option value="11">Scala</option>
                </select>
            </label><br />

            <label>
                Биография:<br />
                <textarea name="biography"></textarea>
            </label><br />

            <label>
                <input type="checkbox" name="familiarized" required />
                Ознакомлен с контрактом
            </label><br />

            <button type="submit">Сохранить</button>
        </form>
      </section>
    </main>

  </body>

</html>