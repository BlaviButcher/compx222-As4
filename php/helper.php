<?php

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
