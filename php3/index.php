<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление страны</title>
</head>
<body>
    <h1>Добавление страны</h1>
    <form method="post" action="index.php">
        Название страны: <input type="text" name="country" required><br>
        <input type="submit" value="Добавить">
    </form>

    <?php
    // Функция для проверки наличия страны в файле
    function countryExists($country, $file) {
        $countries = file($file, FILE_IGNORE_NEW_LINES);
        return in_array($country, $countries);
    }

    // Функция для проверки, является ли страна допустимой
    function isValidCountry($country, $dictionaryFile) {
        $countries = file($dictionaryFile, FILE_IGNORE_NEW_LINES);
        return in_array($country, $countries);
    }

    // Обработка формы
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $country = trim($_POST["country"]); // Удаление лишних пробелов
        $countriesFile = 'countries.txt';
        $dictionaryFile = 'dictionary.txt'; // Эталонный файл стран

        if (!empty($country)) {
            if (!file_exists($countriesFile)) {
                file_put_contents($countriesFile, ""); // Создание файла, если он не существует
            }

            if (isValidCountry($country, $dictionaryFile)) {
                if (!countryExists($country, $countriesFile)) {
                    file_put_contents($countriesFile, $country . PHP_EOL, FILE_APPEND);
                    echo "<p>Страна добавлена успешно!</p>";
                } else {
                    echo "<p>Эта страна уже существует в списке.</p>";
                }
            } else {
                echo "<p>Это не допустимое название страны.</p>";
            }
        } else {
            echo "<p>Введите название страны.</p>";
        }
    }

    // Отображение списка стран
    echo "<h2>Список стран</h2>";
    echo "<select>";
    $countriesFile = 'countries.txt';
    if (file_exists($countriesFile)) {
        $countries = file($countriesFile, FILE_IGNORE_NEW_LINES);
        foreach ($countries as $country) {
            echo "<option value=\"$country\">$country</option>";
        }
    }
    echo "</select>";
    ?>
</body>
</html>
