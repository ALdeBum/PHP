<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изображения</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .gallery img {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="gallery">
        <?php
        $dir = __DIR__ . '/images'; // Путь к папке с изображениями
        $images = glob($dir . '/*.jpg'); // Поиск всех файлов с расширением .jpg в папке images

        foreach ($images as $image) {
            echo '<img src="images/' . basename($image) . '" alt="image">';
        }
        ?>
    </div>
</body>
</html>
