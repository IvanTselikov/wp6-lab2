<?php

require_once __DIR__ . '\conf.php';

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($db->connect_error) {
    die('Невозможно подключиться к базе данных.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Вывод данных из БД</title>
</head>
<body>
    <h3>Выберите задание:</h3>
    <button>Упражнение 1: Вывод данных из базы на страницу</button>
    <button>Упражнение 2: Вывод статистики</button>
    <button>Упражнение 3: Реализация поиска по сайту</button>
</body>
</html>