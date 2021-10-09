<?php
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");


if (file_exists('xml/song_list.xml')) {
    $song_list = simplexml_load_file('xml/song_list.xml');
    error_log("Loaded " . $song_list->count() . " songs", 0);
} else exit('Failed to open xml/song_list.xml');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>

<body>
    <div class="grid-container">


        <?php
        foreach ($song_list->children() as $song) {
            echo "<div class='grid-item'>
            <div class='img-wrap'>
                <img src=$song->art alt=''>
            </div>
            <div class='info-wrap'>
                <div class='field-1'><strong>Title: </strong>$song->title</div>
                <div class='field-2'><strong>Artist: </strong>$song->artist</div>
                <div class='field-3'><strong>Album: </strong>$song->album</div>
            </div>
        </div>";
        }

        ?>


    </div>

</body>

</html>