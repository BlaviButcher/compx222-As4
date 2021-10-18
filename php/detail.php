<?php
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");

include("helper.php");

if (file_exists('../xml/song_list.xml')) {
    $song_list = simplexml_load_file('../xml/song_list.xml');
} else exit('Failed to open ../xml/song_list.xml');

$songs = xmlSongsToAsscArray($song_list);
$song = getSongContent($songs);

?>

<?php

function getSongContent($songs) {
    $title = $_GET["title"];
    $artist = $_GET["artist"];

    foreach ($songs as $song) {
        if (str_contains($song["title"], $title) && str_contains($song['artist'], $artist)) {
            return $song;
        }
    }
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
// Circumvent templating issue
$title = $song["title"];
$artist = $song["artist"];
$album = $song["album"];
$genre = $song["genre"];
$year = $song["year"];
// doing this because php is satan and decides to add " (quotes) on concat
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