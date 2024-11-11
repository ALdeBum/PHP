<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты голосования</title>
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
            width: 300px;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .candidate {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .candidate span {
            flex: 1;
            text-align: left;
        }
        .bar-container {
            position: relative;
            flex: 2;
            margin-left: 10px; /* Добавляем отступ для выравнивания */
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }
        .bar {
            height: 20px;
            background-color: #007bff;
            border-radius: 5px;
        }
        .percentage {
            position: absolute;
            right: 10px;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            color: #fff;
            font-weight: bold;
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
    <div class="container">
        <h1>Результаты голосования</h1>
        <?php
        $file = 'data/votes.txt';
        if (file_exists($file)) {
            $votes = file($file, FILE_IGNORE_NEW_LINES);
            $totalVotes = count($votes);
            $results = array_count_values($votes);
            arsort($results);

            foreach ($results as $candidate => $count) {
                $percentage = ($count / $totalVotes) * 100;
                echo "
                <div class='candidate'>
                    <span>$candidate</span>
                    <div class='bar-container'>
                        <div class='bar' style='width: " . round($percentage, 2) . "%'></div>
                        <div class='percentage'>" . round($percentage, 2) . "%</div>
                    </div>
                </div>";
            }
            echo "<p>Всего голосов: $totalVotes</p>";
        } else {
            echo "<p>Голосов пока нет.</p>";
        }
        ?>
        <a href="index.html">Назад на главную</a>
    </div>
</body>
</html>
