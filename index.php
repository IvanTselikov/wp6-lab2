<?php

require_once __DIR__ . '\conf.php';

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($db->connect_error) {
    die('Невозможно подключиться к базе данных.');
}

if (!empty($_POST)) {
    switch ($_POST['buttonId']) {
        case 'ex1':
            $res = $db->query('SELECT `lastName` FROM `users`');
            while ($row = $res->fetch_array()) {
                echo $row['lastName'], '<br>';
            }
            break;
        case 'ex2':
            echo 'ex2<br>';
            break;
        case 'ex3':
            echo 'ex3<br>';
            break;
    }
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>PHP Вывод данных из БД</title>
</head>

<body>
    <main class="m-3">
        <h3>Выберите действие:</h3>
        <button class="btn btn-primary btn-block" id="ex1">
            Упражнение 1: Вывод данных из базы на страницу
        </button>
        <button class="btn btn-primary btn-block" id="ex2">
            Упражнение 2: Вывод статистики
        </button>
        <button class="btn btn-primary btn-block" id="ex3">
            Упражнение 3: Реализация поиска по сайту
        </button>

        <pre class="mt-3" id="output"></pre>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>