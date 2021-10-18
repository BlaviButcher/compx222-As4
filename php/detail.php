<?php

// Set up error reporting.
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");

// Include helper.php for special functions.
include("helper.php");

// Look for an XML file. If it exists, load it.
if (file_exists('../xml/song_list.xml')) {
    $song_list = simplexml_load_file('../xml/song_list.xml');
} else exit('Failed to open ../xml/song_list.xml');

// Create an array of songs.
$songs = xmlSongsToAsscArray($song_list);
$song = getSongContent($songs);

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
    }

    // If not searching, return the array untouched.
    return $array;
}

// 
function xmlSongsToAsscArray($song_list) {

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

    return $songs;
}

// Gets the song content from the get request.
function getSongContent($songs) {
    $title = $_GET["title"];
    $artist = $_GET["artist"];

    foreach ($songs as $song) {
        if (str_contains($song["title"], $title) && str_contains($song['artist'], $artist)) {
            return $song;
        }
    }
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
    <link rel="stylesheet" href="../css/detail.css">
    <title>Document</title>
</head>

<?php

// Circumvent templating issue.
$title = $song["title"];
$artist = $song["artist"];
$album = $song["album"];
$genre = $song["genre"];
$year = $song["year"];

// Doing this because PHP is satan and decides to add " (quotes) on concat
// ie "../""images/xnay_on_the_hombre""
$art = str_replace('"', "", ("../" . $song["art"]));

?>

<body>
    <div class="muzieknootjes">
        <div class="noot-1">
            &#9835; &#9833;
        </div>
        <div class="noot-2">
            &#9833;
        </div>
        <div class="noot-3">
            &#9839; &#9834;
        </div>
        <div class="noot-4">
            &#9834;
        </div>
    </div>
    <div id="card">
        <div class='img-wrap'>
            <img alt='' src=<?php echo $art ?>>
        </div>
        <div class='info-wrap'>
            <div class='field-1'><strong>Title: </strong><span><?php echo $song["title"] ?></span></div>
            <div class='field-2'><strong>Artist: </strong><span><?php echo $song["artist"] ?></span></div>
            <div class='field-3'><strong>Album: </strong><span><?php echo $song["album"] ?></span></div>
            <div class='field-4'><strong>Year: </strong><span><?php echo $song["year"] ?></span></div>
            <div class='field-5'><strong>Genre: </strong><span><?php echo $song["genre"] ?></span></div>
        </div>
    </div>
    <div class="muzieknootjes">
        <div class="noot-1">
            &#9835; &#9833;
        </div>
        <div class="noot-2">
            &#9833;
        </div>
        <div class="noot-3">
            &#9839; &#9834;
        </div>
        <div class="noot-4">
            &#9834;
        </div>
    </div>
</body>

</html>