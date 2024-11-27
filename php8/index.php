<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестирование PHP классов</title>
    <style>
        .control {
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Создание HTML элементов</h1>
    <form method="POST" action="">
        <h2>Создать Button</h2>
        <label>Background: <input type="text" name="button_background"></label><br>
        <label>Width: <input type="number" name="button_width"></label><br>
        <label>Height: <input type="number" name="button_height"></label><br>
        <label>Name: <input type="text" name="button_name"></label><br>
        <label>Value: <input type="text" name="button_value"></label><br>
        <label>Is Submit: <input type="checkbox" name="button_isSubmit"></label><br>
        <input type="submit" name="create_button" value="Создать Button">
        
        <h2>Создать Text</h2>
        <label>Background: <input type="text" name="text_background"></label><br>
        <label>Width: <input type="number" name="text_width"></label><br>
        <label>Height: <input type="number" name="text_height"></label><br>
        <label>Name: <input type="text" name="text_name"></label><br>
        <label>Value: <input type="text" name="text_value"></label><br>
        <label>Placeholder: <input type="text" name="text_placeholder"></label><br>
        <input type="submit" name="create_text" value="Создать Text">
        
        <h2>Создать Label</h2>
        <label>Background: <input type="text" name="label_background"></label><br>
        <label>Width: <input type="number" name="label_width"></label><br>
        <label>Height: <input type="number" name="label_height"></label><br>
        <label>For Object (Name): <input type="text" name="label_forObject"></label><br>
        <input type="submit" name="create_label" value="Создать Label">
    </form>

    <?php
    session_start();
    
    require_once 'Button.php';
    require_once 'Text.php';
    require_once 'Label.php';

    function convertToHTML($control) {
        $html = "<div class='control' style='background: " . $control->getBackground() . "; width: " . $control->getWidth() . "px; height: " . $control->getHeight() . "px;'>";
        
        if ($control instanceof Button) {
            $html .= "<button type='" . ($control->getSubmitState() ? "submit" : "button") . "' name='" . $control->getName() . "'>" . $control->getValue() . "</button>";
        } elseif ($control instanceof Text) {
            $html .= "<input type='text' name='" . $control->getName() . "' value='" . $control->getValue() . "' placeholder='" . $control->getPlaceholder() . "'>";
        } elseif ($control instanceof Label) {
            $html .= "<label for='" . $control->getParentName() . "'>Label</label>";
        }

        $html .= "</div>";
        return $html;
    }

    if (!isset($_SESSION['controls'])) {
        $_SESSION['controls'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create_button'])) {
            $background = $_POST['button_background'];
            $width = $_POST['button_width'];
            $height = $_POST['button_height'];
            $name = $_POST['button_name'];
            $value = $_POST['button_value'];
            $isSubmit = isset($_POST['button_isSubmit']) ? true : false;

            $button = new Button($background, $width, $height, $name, $value, $isSubmit);
            $_SESSION['controls'][] = $button;
        }

        if (isset($_POST['create_text'])) {
            $background = $_POST['text_background'];
            $width = $_POST['text_width'];
            $height = $_POST['text_height'];
            $name = $_POST['text_name'];
            $value = $_POST['text_value'];
            $placeholder = $_POST['text_placeholder'];

            $text = new Text($background, $width, $height, $name, $value, $placeholder);
            $_SESSION['controls'][] = $text;
        }

        if (isset($_POST['create_label'])) {
            $background = $_POST['label_background'];
            $width = $_POST['label_width'];
            $height = $_POST['label_height'];
            $forObjectName = $_POST['label_forObject'];
            
            // Для простоты поиска объекта по имени
            $forObject = null;
            foreach ($_SESSION['controls'] as $control) {
                if ($control instanceof Input && $control->getName() == $forObjectName) {
                    $forObject = $control;
                    break;
                }
            }

            if ($forObject) {
                $label = new Label($background, $width, $height, $forObject);
                $_SESSION['controls'][] = $label;
            } else {
                echo "<p>Объект с именем '$forObjectName' не найден.</p>";
            }
        }
    }

    // Отображение всех объектов
    if (isset($_SESSION['controls'])) {
        foreach ($_SESSION['controls'] as $control) {
            echo convertToHTML($control);
        }
    }
    ?>
</body>
</html>
