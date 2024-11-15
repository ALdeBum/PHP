<?php
session_start();
$_SESSION['score1'] = array_sum($_POST);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Testing Form - Page 2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm() {
            let valid = true;
            const questions = document.querySelectorAll('input[type="checkbox"]');
            const answers = {};
            
            questions.forEach(q => {
                if (!answers[q.name]) {
                    answers[q.name] = false;
                }
                if (q.checked) {
                    answers[q.name] = true;
                }
            });
            
            for (let key in answers) {
                if (!answers[key]) {
                    valid = false;
                    break;
                }
            }
            
            if (!valid) {
                alert("Please answer all questions.");
            }
            
            return valid;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Testing Form - Page 2</h1>
        <form action="page3.php" method="post" onsubmit="return validateForm()">
            <?php
            $file = file('quiz_files/questions_page2.txt');
            foreach ($file as $line) {
                list($question, $answer1, $answer2, $answer3, $answer4) = explode(';', trim($line));
                echo "<p>$question</p>";
                foreach ([$answer1, $answer2, $answer3, $answer4] as $answer) {
                    list($text, $correct) = explode('|', $answer);
                    echo "<input type='checkbox' name='".md5($question)."[]' value='$correct'> $text<br>";
                }
            }
            ?>
            <input type="submit" value="Next">
        </form>
    </div>
</body>
</html>
