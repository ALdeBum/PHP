<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>
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
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Таблица умножения от 2 до 10</h2>
    <table>
        <tr>
            <th>*</th>
            <?php for ($i = 2; $i <= 10; $i++) echo "<th>$i</th>"; ?>
        </tr>
        <?php
        for ($i = 2; $i <= 10; $i++) {
            echo "<tr><th>$i</th>";
            for ($j = 2; $j <= 10; $j++) {
                echo "<td>" . ($i * $j) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
