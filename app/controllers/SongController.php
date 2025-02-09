<?php

class SongController {
    public function view($songId) {
        // Fetch song data and show details
        $song = Song::find($songId);
        require_once __DIR__ . '/../views/song/view.php';
    }

    public function play($songId) {
        // Handle playing the song (e.g., stream or serve file)
        $song = Song::find($songId);
        echo "Now playing: " . $song->title;
    }

    public function addToLibrary($songId) {
        // Add song to the user's library
        Song::addToLibrary($songId, $_SESSION['user']->id);
        header("Location: /user/library");
        exit;
    }
}
