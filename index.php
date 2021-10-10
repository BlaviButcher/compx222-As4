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

$songs = array();

foreach ($song_list->children() as $song) {
    $songs[] = array(
        'title' => (string)$song->title,
        'artist' => (string)$song->artist,
        'album' => (string)$song->album,
        'year' => (int)$song->year,
        'genre' => (string)$song->genre,
        'art' => (string)$song->art
    );
    // var_dump($songs);

    array_sort_by_column($songs, 'title');
}
?>

<?php
function array_sort_by_column(&$array, $column) {
    $reference_array = array();

    // extract the column we want to sort by and put into $reference_array
    foreach ($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    // sort using extracted column as reference. $reference_array is sorted
    // then the corresponding indexes of the other array - $array - are sorted
    // to matched the indexes of the first array $reference_array
    array_multisort($reference_array, $array);
}
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
        for ($x = 0; $x < $song_list->count(); $x++) {
            // circumvents error in templating
            $title = $songs[$x]['title'];
            $artist = $songs[$x]['artist'];
            $album = $songs[$x]['album'];
            $year = $songs[$x]['year'];
            $genre = $songs[$x]['genre'];
            $art = $songs[$x]['art'];



            echo "<div class='grid-item'>
            <div class='img-wrap'>
                <img src=$art alt=''>
            </div>
            <div class='info-wrap'>
                <div class='field-1'><strong>Title: </strong><span>$title</span></div>
                <div class='field-2'><strong>Artist: </strong><span>$artist</span></div>
                <div class='field-3'><strong>Album: </strong><span>$album</span></div>
            </div>
        </div>";
        }

        ?>


    </div>
</body>

</html>