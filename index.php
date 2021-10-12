<?php
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");


if (file_exists('xml/song_list.xml')) {
    $song_list = simplexml_load_file('xml/song_list.xml');
} else exit('Failed to open xml/song_list.xml');

?>

<?php

$isSearching = false;

?>

<?php

if (isset($_GET["search"])) 
    $isSearching = ($_GET["search"] == "\n" || $_GET["search"] == "") ? false : true;

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
}



$songs = song_array_search($songs);
array_sort_by_column($songs, 'album');

?>

<?php

// Takes in a list of songs. Creates a new array and adds any song
// that has a match in any enumarable column
// Returns updated array
function song_array_search($array) {

    // new array to be pushed upon and returned
    $newSongList = array();
    // enumarable columns to search
    $columnSearch = array("title", "artist", "album");

    global $isSearching;
    // if something was searched
    if ($isSearching) {
        $content = trim($_GET["search"]);
        // get each song
        foreach ($array as $song) {
            
            // search each column for a match
            foreach ($columnSearch as $column) {
                if (str_contains(strtolower($song[$column]), strtolower($content))) {
                    // push if match
                    array_push($newSongList, $song);
                    break;
                }
            }
            
        }
        return $newSongList;

        // return array untouched 
    } else return $array;
}

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
        foreach ($songs as $song) {
            $title = $song['title'];
            $artist = $song['artist'];
            $album = $song['album'];
            $year = $song['year'];
            $genre = $song['genre'];
            $art = $song['art'];
        
            // circumvents error in templating
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