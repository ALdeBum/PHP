<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анализ числа</title>
</head>
<body>
    <form method="post">
        Введите число: <input type="text" name="number">
        <input type="submit" value="Анализировать">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"];
        $digits = str_split($number); // Разбить число на массив цифр
        $count = count($digits);
        $max = max($digits);
        $min = min($digits);
        $sum = array_sum($digits);
        $avg = $sum / $count;

        echo "<h1>Number is: $number</h1>";
        echo "<h2>Digits in the number: " . implode(", ", $digits) . "</h2>";
        echo "<p>Count of digits: <b>$count</b>, Max: <b>$max</b>, Min: <b>$min</b>, Summ: <b>$sum</b>, AVG: <b>$avg</b></p>";
    }
    ?>
</body>
</html>
