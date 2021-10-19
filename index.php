<?php

// Setup error reporting and include helper.php for some handy functions
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");

include("php/helper.php");

// Load song list if exists, else error
if (file_exists('xml/song_list.xml')) {
    $song_list = simplexml_load_file('xml/song_list.xml');
} else exit('Failed to open xml/song_list.xml');

// Check and record if the page is currently searching by observing the get request.
$isSearching = false;
if (isset($_GET["search"])) {
    $isSearching = !($_GET["search"] == "\n" || $_GET["search"] == "");
}

$songs = xmlSongsToAsscArray($song_list);
$songs = song_array_search($songs);

// Set order if it is set, trim and lower, else use default - title
$searchOrder = "title";
if (isset($_GET["order"])) $searchOrder = trim(strtolower($_GET["order"]));

array_sort_by_column($songs, $searchOrder);

/**
 * Takes in a list of songs. Creates a new array and adds any song
 * that has a match in any enumarable column
 *   
 * @param array $array multidemensional associative array containing songs
 * @return array
 */
function song_array_search($songList) {

    // New array to be pushed upon and returned
    $newSongList = array();
    // Enumarable columns to search
    $columnSearch = array("title", "artist", "album");

    // If the user searched for something
    global $isSearching;
    if ($isSearching) {
        $content = trim($_GET["search"]);
        // Get each song
        foreach ($songList as $song) {
            // Search each column for a match
            foreach ($columnSearch as $column) {
                if (strpos(strtolower($song[$column]), strtolower($content))!== false) {
                    // Push if match
                    array_push($newSongList, $song);
                    break;
                }
            }
        }
        return $newSongList;
    }
    // If nothing was searched, then return the song list, untouched
    return $songList;
}

/**
 * Fills a referenceArray with content from songs with only one column - the one given.
 * It's then sorted, then sorts the big song array using the referenceArray as reference
 * 
 * @param array array filled with songs
 * @param string column to sort by
 */
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
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <script src="js/index.js" defer></script>

    <title>Music Database</title>
</head>

<body>
    <header>
        <!-- Buffer for symmetric spacing -->
        <div id="left"></div>
        <!-- Holds everything related to search -->
        <div id="middle">
            <div id="search-wrap">
                <div id="search-container">
                    <div id="search-box" contenteditable>
                        <!-- If something was search update box to match -->
                        <?php if ($isSearching) echo trim($_GET["search"]);
                        else echo "";
                        ?>
                    </div>
                    <div id="search-go-button">
                        <img id="search-img" src="images/magnifying-glass.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div id="right">
            <!-- Dropdown -->
            <div class="dropdown-wrap">
                <div class="dropdown open">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown-order"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if (isset($_GET["order"])) echo $_GET["order"];
                        else echo "Title"; ?>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item">Title</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Artist</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Album</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="grid-container">
        <?php
        // Draw songs to page in each individual card
        foreach ($songs as $song) {
            // Storing in varaible to prevent templating issues
            $title = $song['title'];
            $artist = $song['artist'];
            $album = $song['album'];
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

    <!-- Down here as that is what bootstrap requests -->
    <!-- These are only used for the toggle dropdown -->
    <!-- Popper JS -->
    <script src="js/bootstrap/pooper.min.js"></script>
    <!-- jquery needed for bootstrap -->
    <script src="js/jquery.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>