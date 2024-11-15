<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileMask = $_POST['fileMask'];
    $searchText = $_POST['searchText'];
    $disk = $_POST['disk'];

    // Функция для поиска файлов по маске с ограничением глубины и фильтрацией каталогов
    function findFiles($dir, $pattern, $depth = 0, $maxDepth = 5) {
        $files = [];
        if ($depth <= $maxDepth) {
            $found = glob("$dir/$pattern");
            if ($found !== false) {
                $files = array_merge($files, $found);
            }
            foreach (glob("$dir/*", GLOB_ONLYDIR) as $subDir) {
                // Исключаем системные и скрытые каталоги
                if (is_readable($subDir) && strpos($subDir, '$') === false && strpos($subDir, '.') !== 0) {
                    $files = array_merge($files, findFiles($subDir, $pattern, $depth + 1, $maxDepth));
                }
            }
        }
        return $files;
    }

    // Поиск файлов по маске
    $foundFiles = findFiles($disk, $fileMask);
    $results = [];

    if (!empty($searchText)) {
        // Если введен текст для поиска, ищем его в найденных файлах
        foreach ($foundFiles as $file) {
            if (is_readable($file) && is_file($file)) {
                $content = file_get_contents($file);
                if (strpos($content, $searchText) !== false) {
                    preg_match_all("/" . preg_quote($searchText, '/') . "/", $content, $matches, PREG_OFFSET_CAPTURE);
                    $positions = array_map(function($match) {
                        return $match[1];
                    }, $matches[0]);
                    $results[] = ['file' => $file, 'positions' => $positions];
                }
            } else {
                error_log("File not readable or not a regular file: $file");
            }
        }
    } else {
        // Если текст для поиска не введен, просто показываем список файлов
        $results = array_map(function($file) {
            return ['file' => $file, 'positions' => []];
        }, $foundFiles);
    }

    // Вывод результатов
    echo "<div class='container'>";
    echo "<h1>Результаты поиска</h1>";
    if (!empty($results)) {
        echo "<ul>";
        foreach ($results as $result) {
            echo "<li><strong>" . $result['file'] . "</strong>";
            if (!empty($result['positions'])) {
                echo " - Найдено на позициях: " . implode(', ', $result['positions']);
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Ничего не найдено</p>";
    }
    echo "</div>";
}
?>
