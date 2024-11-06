<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход пользователя</title>
</head>
<body>
    <h1>Вход пользователя</h1>
    <form method="post" action="login.php">
        Логин: <input type="text" name="login" required><br>
        Пароль: <input type="password" name="password" required><br>
        <input type="submit" value="Войти">
    </form>

    <p><a href="index.php">Назад на главную</a></p>

    <?php
    function authenticate($login, $password) {
        $file = 'users.txt';
        if (!file_exists($file)) {
            return false;
        }

        $users = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            list($existingLogin, $hashed_password) = explode(': ', $user);
            if ($existingLogin === $login && password_verify($password, $hashed_password)) {
                return true;
            }
        }
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $password = $_POST["password"];

        if (authenticate($login, $password)) {
            echo "<p>Успешный вход!</p>";
        } else {
            echo "<p>Доступ запрещён!</p>";
        }
    }
    ?>
</body>
</html>
