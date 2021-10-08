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
        <div class="grid-item">
            <div class="img-wrap">
                <img src="images/dookie.png" alt="">
            </div>
            <div class="info-wrap">
                <div class="field-1">Song Title Song TitleSong Title Song TitleSong Title</div>
                <div class="field-2">Song Artist Song Artist Song Artist Song Artist Song Artist</div>
                <div class="field-3">Song Album Song Album Song Album Song Album Song Album Song Album</div>
            </div>
        </div>
        <div class="grid-item">
        </div>
        <div class="grid-item">
        </div>
        <div class="grid-item">
        </div>
        <div class="grid-item">
        </div>
    </div>

</body>

</html>