<?php

class Organizer {
    private $tasks = [];
    private $filePath = 'tasks.txt'; // Путь к файлу

    public function __construct() {
        // Загрузка задач из файла при инициализации
        $this->loadTasks();
    }

    // Загрузка задач из файла
    private function loadTasks() {
        if (file_exists($this->filePath)) {
            $fileContents = file_get_contents($this->filePath);
            $this->tasks = json_decode($fileContents, true) ?: [];
        }
    }

    // Сохранение задач в файл
    private function saveTasks() {
        file_put_contents($this->filePath, json_encode($this->tasks));
    }

    // Добавление задачи
    public function addTask($task, $date) {
        $this->tasks[] = [
            'task' => $task,
            'date' => $date
        ];
        $this->saveTasks(); // Сохранение после добавления задачи
    }

    // Задачи до указанной даты
    public function printTasksUntilDate($endDate) {
        $tasksUntilDate = array_filter($this->tasks, function($task) use ($endDate) {
            return strtotime($task['date']) <= strtotime($endDate);
        });

        return $tasksUntilDate;
    }

    // Задачи на ближайшую неделю
    public function printTasksForNextWeek() {
        $startOfWeek = date('Y-m-d', strtotime('next Monday'));
        $endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' + 6 days'));
        $tasksInWeek = array_filter($this->tasks, function($task) use ($startOfWeek, $endOfWeek) {
            return strtotime($task['date']) >= strtotime($startOfWeek) && strtotime($task['date']) <= strtotime($endOfWeek);
        });

        return $tasksInWeek;
    }

    // Задачи на ближайший месяц
    public function printTasksForNextMonth() {
        $startOfMonth = date('Y-m-d', strtotime('first day of next month'));
        $endOfMonth = date('Y-m-d', strtotime($startOfMonth . ' + 1 month - 1 day'));
        $tasksInMonth = array_filter($this->tasks, function($task) use ($startOfMonth, $endOfMonth) {
            return strtotime($task['date']) >= strtotime($startOfMonth) && strtotime($task['date']) <= strtotime($endOfMonth);
        });

        return $tasksInMonth;
    }

    // Задачи на ближайший год
    public function printTasksForNextYear() {
        $startOfYear = date('Y-m-d', strtotime('first day of January next year'));
        $endOfYear = date('Y-m-d', strtotime($startOfYear . ' + 1 year - 1 day'));
        $tasksInYear = array_filter($this->tasks, function($task) use ($startOfYear, $endOfYear) {
            return strtotime($task['date']) >= strtotime($startOfYear) && strtotime($task['date']) <= strtotime($endOfYear);
        });

        return $tasksInYear;
    }

    // Печать задач на определенную дату
    public function printTasksByDate($date) {
        $tasksOnDate = array_filter($this->tasks, function($task) use ($date) {
            return $task['date'] === $date;
        });

        return $tasksOnDate;
    }

    // Печать задач на неделю
    public function printTasksForWeek($weekStartDate) {
        $weekEndDate = date('Y-m-d', strtotime($weekStartDate . ' + 6 days'));
        $tasksInWeek = array_filter($this->tasks, function($task) use ($weekStartDate, $weekEndDate) {
            return strtotime($task['date']) >= strtotime($weekStartDate) && strtotime($task['date']) <= strtotime($weekEndDate);
        });

        return $tasksInWeek;
    }

    // Печать задач на месяц
    public function printTasksForMonth($month, $year) {
        $tasksInMonth = array_filter($this->tasks, function($task) use ($month, $year) {
            $taskDate = new DateTime($task['date']);
            return $taskDate->format('m') == $month && $taskDate->format('Y') == $year;
        });

        return $tasksInMonth;
    }

    // Отмена задачи
    public function cancelTask($taskName) {
        foreach ($this->tasks as $key => $task) {
            if ($task['task'] == $taskName) {
                unset($this->tasks[$key]);
                $this->saveTasks(); // Сохранение после удаления задачи
                return true;
            }
        }
        return false;
    }
}
?>
