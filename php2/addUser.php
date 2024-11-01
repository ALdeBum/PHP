<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление пользователя</title>
</head>
<body>
    <h1>Добавление пользователя</h1>
    <form method="post" action="addUser.php">
        Логин: <input type="text" name="login" required><br>
        Пароль: <input type="password" name="password" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Добавить">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $userData = "$login: $password: $email";

        $file = 'users.txt';
        $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
        
        $exists = false;
        foreach ($users as $user) {
            list($existingLogin) = explode(': ', $user);
            if ($existingLogin === $login) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            echo "<p>Пользователь с таким логином уже существует!</p>";
        } else {
            file_put_contents($file, $userData . PHP_EOL, FILE_APPEND);
            echo "<p>Пользователь добавлен успешно!</p>";
        }
    }
    ?>
</body>
</html>
