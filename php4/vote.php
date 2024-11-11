<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка куки
    if (!isset($_COOKIE['voted'])) {
        $candidate = $_POST["candidate"];
        $file = 'data/votes.txt';

        file_put_contents($file, $candidate . PHP_EOL, FILE_APPEND);

        // Установка куки на 1 год
        setcookie('voted', 'true', time() + (365 * 24 * 60 * 60));

        echo "
        <!DOCTYPE html>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>
            <title>Подтверждение голоса</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                .container a {
                    display: block;
                    margin-top: 20px;
                    text-decoration: none;
                    color: #007bff;
                }
                .container a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Ваш голос принят!</h1>
                <a href='index.html'>Назад на главную</a>
                <a href='results.php'>Посмотреть результаты</a>
            </div>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>
            <title>Голос уже зарегистрирован</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                .container a {
                    display: block;
                    margin-top: 20px;
                    text-decoration: none;
                    color: #007bff;
                }
                .container a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Вы уже голосовали!</h1>
                <a href='index.html'>Назад на главную</a>
                <a href='results.php'>Посмотреть результаты</a>
            </div>
        </body>
        </html>";
    }
}
?>
