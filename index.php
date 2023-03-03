<?php

require_once __DIR__ . '\conf.php';

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($db->connect_error) {
    die('Невозможно подключиться к базе данных.');
}

if (!empty($_GET)) {
    switch ($_GET['buttonId']) {
        case 'ex1':
            $res = $db->query('SELECT `lastName` FROM `users`') or die($db->error);
            while ($row = $res->fetch_assoc()) {
                echo $row['lastName'], '<br>';
            }
            $res->free();
            break;
        case 'ex2':
            $res = $db->query('SELECT COUNT(*) FROM `users`') or die($db->error);
            $count = $res->fetch_array()[0];
            echo '<b>Всего зарегистрировано пользователей:</b> ', $count, '<br>';
            $res->free();

            $dateArray = getdate();
            $beginDate = date('Y-m-d', mktime(0, 0, 0, $dateArray['mon'], 1, $dateArray['year']));
            $endDate = date('Y-m-d', mktime(0, 0, 0, $dateArray['mon'] + 1, 0, $dateArray['year']));

            $res = $db->query("SELECT COUNT(*) FROM `users`
                               WHERE `registrationData`
                                 BETWEEN '$beginDate' AND '$endDate'") or die($db->error);
            $count = $res->fetch_array()[0];
            echo '<b>За последний месяц:</b> ', $count, '<br>';
            $res->free();

            $res = $db->query('SELECT `firstName`, `lastName`, `login` FROM `users`
                               ORDER BY `registrationData` DESC LIMIT 0,1') or die($db->error);
            $row = $res->fetch_assoc();

            echo '<b>Последний зарегистрированный пользователь:</b> ', $row['login'],
                ' (', $row['firstName'], ' ', $row['lastName'], ')', '<br>';

            $res->free();

            break;
        case 'ex3':
            $userSearch = trim($_GET['userSearch']);
            if (!empty($userSearch)) {
                $stmt = $db->prepare("SELECT * FROM `users`
                    WHERE `firstName` LIKE CONCAT('%',?,'%')
                        OR `lastName` LIKE CONCAT('%',?,'%')
                        OR `email` LIKE CONCAT('%',?,'%')
                        OR `login` LIKE CONCAT('%',?,'%')
                        OR `description` LIKE CONCAT('%',?,'%')");
                $stmt->bind_param("sssss", $userSearch, $userSearch, $userSearch, $userSearch, $userSearch);
                $stmt->execute();

                $res = $stmt->get_result();
                
                if ($res->num_rows) {
                    echo '<ul>';
                    while ($user = $res->fetch_assoc()) {
                        echo "<li><b>Логин:</b> {$user['login']}<ul>";
                        echo "<li><i>Имя:</i> {$user['firstName']}</li>";
                        echo "<li><i>Фамилия:</i> {$user['lastName']}</li>";
                        echo "<li><i>Email:</i> {$user['email']}</li>";
                        echo "<li><i>О себе:</i> {$user['description']}</li>";
                        echo '</ul></li>';
                    }
                    echo '</ul><br>';
                } else {
                    echo '<b>Ничего не найдено!</b>', '<br>';
                }
                $res->free();
            }
            break;
        default:
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
    <title>PHP Вывод данных из БД</title>
</head>

<body>
    <main class="m-3">
        <h3>Выберите действие:</h3>
        <button id="ex1">Упражнение 1: Вывод данных из базы на страницу</button>
        <button id="ex2">Упражнение 2: Вывод статистики</button>
        <button id="ex3">Упражнение 3: Реализация поиска по сайту</button>
        <pre class="mt-3" id="output"></pre>
    </main>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>