<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Перевернуть число</title>
</head>
<body>
    <form method="post">
        Введите число: <input type="text" name="number">
        <input type="submit" value="Перевернуть">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"];
        $reversedNumber = strrev($number);

        echo "<h1 style='color:red;'>$number</h1>";
        echo "<h1 style='color:green;'>$reversedNumber</h1>";
    }
    ?>
</body>
</html>
