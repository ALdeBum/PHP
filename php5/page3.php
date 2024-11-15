<?php
session_start();
$_SESSION['score2'] = array_sum(array_map('array_sum', $_POST));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Testing Form - Page 3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm() {
            let valid = true;
            const questions = document.querySelectorAll('input[type="text"]');
            
            questions.forEach(q => {
                if (q.value.trim() === "") {
                    valid = false;
                }
            });
            
            if (!valid) {
                alert("Please answer all questions.");
            }
            
            return valid;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Testing Form - Page 3</h1>
        <form action="results.php" method="post" onsubmit="return validateForm()">
            <?php
            $file = file('quiz_files/questions_page3.txt');
            $q_num = 1;
            foreach ($file as $line) {
                list($question, $correct_answer) = explode(';', trim($line));
                echo "<p>$question</p>";
                echo "<input type='text' name='q$q_num'><br>";
                $_SESSION["correct_answer$q_num"] = $correct_answer;
                $q_num++;
            }
            ?>
            <input type="submit" value="Finish">
        </form>
    </div>
</body>
</html>
