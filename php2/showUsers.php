<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Список пользователей</h1>
    <table>
        <tr>
            <th>Логин</th>
            <th>Пароль</th>
            <th>Email</th>
        </tr>
        <?php
        $file = 'users.txt';
        if (file_exists($file)) {
            $users = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($users as $user) {
                list($login, $password, $email) = explode(': ', $user);
                echo "<tr><td>$login</td><td>$password</td><td>$email</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Нет данных</td></tr>";
        }
        ?>
    </table>
</body>
</html>
