<?php
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");


if (file_exists('xml/song_list.xml')) {
    $song_list = simplexml_load_file('xml/song_list.xml');
} else exit('Failed to open xml/song_list.xml');

?>

<?php

if (isset($_POST["search"])) {
    error_log("sdfh", 0);
}

?>

<?php

// $songs = array();

// foreach ($song_list->children() as $song) {
//     $songs[] = array(
//         'title'
//     )
// }


// function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
//     $reference_array = array();

//     // extract the column we want to sort by
//     foreach ($array as $key => $row) {
//         $reference_array[$key] = $row[$column];
//     }

//     // sort using extracted column as reference
//     array_multisort($reference_array, $direction, $array);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js" defer></script>
    <title>Document</title>
</head>

<body>

    <header>
        <div id="search-wrap">
            <div id="search-icon">
                <img id="search-img" src="images/magnifying-glass.png" alt="">
            </div>
            <div id="search-container">
                <div id="search-box" contenteditable>sdftsdhf</div>
                <div id="search-go-button">GO</div>
            </div>
        </div>
    </header>

    <div class="grid-container">



        <?php
        foreach ($song_list->children() as $song) {
            echo "<div class='grid-item'>
            <div class='img-wrap'>
                <img src=$song->art alt=''>
            </div>
            <div class='info-wrap'>
                <div class='field-1'><strong>Title: </strong><span>$song->title</span></div>
                <div class='field-2'><strong>Artist: </strong><span>$song->artist</span></div>
                <div class='field-3'><strong>Album: </strong><span>$song->album</span></div>
            </div>
        </div>";
        }

        ?>

    </div>
</body>

</html>