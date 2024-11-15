<?php
session_start();
$score1 = $_SESSION['score1'];
$score2 = $_SESSION['score2'];
$score3 = 0;

foreach ($_POST as $key => $answer) {
    $correct_answer_key = 'correct_answer' . substr($key, 1);
    if (isset($_SESSION[$correct_answer_key]) && strtolower($answer) == strtolower($_SESSION[$correct_answer_key])) {
        $score3 += 5;
    }
}

$totalScore = $score1 * 1 + $score2 * 3 + $score3 * 5;

echo "<div class='container'><h1>Your total score is: $totalScore</h1>";
session_destroy();
?>

<form action="page1.php" method="get">
    <input type="submit" value="Retry Test">
</form>
</div>
