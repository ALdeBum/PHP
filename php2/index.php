<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
</head>
<body>
    <h1>Меню</h1>
    <ul>
        <li><a href="addUser.php">Add</a></li>
        <li><a href="showUsers.php">Show</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
    <?php
    $file = 'users.txt';
    $count = 0;
    if (file_exists($file)) {
        $count = count(file($file));
    }
    echo "<p>Количество пользователей: $count</p>";
    ?>
</body>
</html>
