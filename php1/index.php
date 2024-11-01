<?php
// Генерация массива из 100 случайных чисел
$numbers = array();
for ($i = 0; $i < 100; $i++) {
    $numbers[] = rand(1, 100); // Генерирует случайное число от 1 до 100
}

// Вывод всех чисел
echo implode(' ', $numbers) . "<br>";

// Нахождение максимального и минимального значений
$max = max($numbers);
$min = min($numbers);

echo "Maximum: $max<br>";
echo "Minimum: $min<br>";
?>
