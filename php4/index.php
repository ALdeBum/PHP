<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Интернет-голосование</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .candidate {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 200px;
            margin-bottom: 10px;
        }
        .candidate label {
            flex-grow: 1;
            text-align: left;
        }
        .container form input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .container form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .container a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($_COOKIE['voted'])): ?>
            <h1>Интернет-голосование</h1>
            <form method="post" action="vote.php">
                <div class="candidate">
                    <input type="radio" name="candidate" value="Python" required>
                    <label>Python</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="JavaScript">
                    <label>JavaScript</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="Java">
                    <label>Java</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="C++">
                    <label>C++</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="C#">
                    <label>C#</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="PHP">
                    <label>PHP</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="Ruby">
                    <label>Ruby</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="Go">
                    <label>Go</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="Swift">
                    <label>Swift</label>
                </div>
                <div class="candidate">
                    <input type="radio" name="candidate" value="Kotlin">
                    <label>Kotlin</label>
                </div>
                <input type="submit" value="Голосовать">
            </form>
        <?php else: ?>
            <h1>Вы уже голосовали!</h1>
        <?php endif; ?>
        <a href="results.php">Посмотреть результаты</a>
    </div>
</body>
</html>
