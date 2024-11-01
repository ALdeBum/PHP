<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица депозита</title>
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
    <h2>Таблица депозита по годам</h2>
    <table>
        <tr>
            <th>Год</th>
            <th>Сумма в начале года</th>
            <th>Сумма в конце года</th>
            <th>Прибыль</th>
        </tr>
        <?php
        $initialDeposit = 300;
        $interestRate = 0.20;
        $years = 20;
        
        $currentAmount = $initialDeposit;

        for ($i = 1; $i <= $years; $i++) {
            $startAmount = $currentAmount;
            $profit = $startAmount * $interestRate;
            $endAmount = $startAmount + $profit;
            
            echo "<tr>
                    <td>$i</td>
                    <td>$startAmount</td>
                    <td>$endAmount</td>
                    <td>$profit</td>
                  </tr>";
                  
            $currentAmount = $endAmount;
        }
        ?>
    </table>
</body>
</html>
