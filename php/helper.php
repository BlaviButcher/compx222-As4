<?php

/**
 * Converts the contents of an XML file to an array of associative arrays
 */
function xmlSongsToAsscArray($songList) {

    $newSongList = array();

    foreach ($songList->children() as $song) {
        $newSongList[] = array(
            'title' => (string)$song->title,
            'artist' => (string)$song->artist,
            'album' => (string)$song->album,
            'year' => (int)$song->year,
            'genre' => (string)$song->genre,
            'art' => (string)$song->art
        );
    }

    return $newSongList;
}

?>