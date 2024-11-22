<?php
// Подключаем класс
include 'organizer.php';

// Создаём объект класса Organizer
$organizer = new Organizer();

// Обработка формы добавления задачи
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $date = $_POST['date'];
    $organizer->addTask($task, $date);
}

// Печать задач по фильтрам
$tasksToDisplay = [];

if (isset($_GET['view_day']) && $_GET['view_day'] != '') {
    $tasksToDisplay = $organizer->printTasksByDate($_GET['view_day']);
} elseif (isset($_GET['view_week']) && $_GET['view_week'] != '') {
    $tasksToDisplay = $organizer->printTasksForWeek($_GET['view_week']);
} elseif (isset($_GET['view_month']) && $_GET['view_month'] != '' && isset($_GET['view_year']) && $_GET['view_year'] != '') {
    $tasksToDisplay = $organizer->printTasksForMonth($_GET['view_month'], $_GET['view_year']);
} elseif (isset($_GET['view_until_date']) && $_GET['view_until_date'] != '') {
    $tasksToDisplay = $organizer->printTasksUntilDate($_GET['view_until_date']);
} elseif (isset($_GET['view_next_month'])) {
    $tasksToDisplay = $organizer->printTasksForNextMonth();
} elseif (isset($_GET['view_next_week'])) {
    $tasksToDisplay = $organizer->printTasksForNextWeek();
} elseif (isset($_GET['view_next_year'])) {
    $tasksToDisplay = $organizer->printTasksForNextYear();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Органайзер задач</title>
</head>
<body>
    <h1>Органайзер задач</h1>

    <!-- Форма для добавления задачи -->
    <form action="index.php" method="POST">
        <label for="task">Задача:</label>
        <input type="text" name="task" id="task" required><br>

        <label for="date">Дата:</label>
        <input type="date" name="date" id="date" required><br>

        <button type="submit">Добавить задачу</button>
    </form>

    <h2>Просмотр задач</h2>
    <form action="index.php" method="GET">
        <h3>Поиск задач по:</h3>

        <!-- Выбор фильтра для дня -->
        <label for="view_day">Дата:</label>
        <input type="date" name="view_day" id="view_day"><br>

        <!-- Выбор фильтра для недели -->
        <label for="view_week">Неделя (начало недели):</label>
        <input type="date" name="view_week" id="view_week"><br>

        <!-- Выбор фильтра для месяца -->
        <label for="view_month">Месяц:</label>
        <input type="number" name="view_month" id="view_month" min="1" max="12" placeholder="Месяц (1-12)">
        
        <label for="view_year">Год:</label>
        <input type="number" name="view_year" id="view_year" placeholder="Год"><br>

        <!-- Новый фильтр для задач до выбранной даты -->
        <label for="view_until_date">До даты:</label>
        <input type="date" name="view_until_date" id="view_until_date"><br>

        <!-- Новый фильтр для ближайшего месяца -->
        <button type="submit" name="view_next_month">Ближайший месяц</button><br>

        <!-- Новый фильтр для ближайшей недели -->
        <button type="submit" name="view_next_week">Ближайшая неделя</button><br>

        <!-- Новый фильтр для ближайшего года -->
        <button type="submit" name="view_next_year">Ближайший год</button><br>
    </form>

    <h3>Задачи:</h3>
    <?php
    if ($tasksToDisplay) {
        foreach ($tasksToDisplay as $task) {
            echo '<p>' . $task['task'] . ' - ' . $task['date'] . '</p>';
        }
    } else {
        echo '<p>Нет задач для отображения.</p>';
    }
    ?>
</body>
</html>
