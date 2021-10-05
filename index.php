<?php
ini_set("error_reporting", E_ALL);
ini_set("log_errors", "1");
ini_set("error_log", "php_errors.txt");

echo phpinfo();

if (file_exists('xml/song_list.xml')) {
    $song_list = simplexml_load_file('xml/song_list.xml');
    error_log("Loaded " . $song_list->count() . " songs", 0);
} else exit('Failed to open xml/song_list.xml');
