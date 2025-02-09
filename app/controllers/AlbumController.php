<?php

    class AlbumController extends Controller {

        public function index() {
            $albums = Album::getAllAlbums();
            $this -> view('album/index');
        }

        public function create() {
            $this -> view('album/create');
        }

        // public function create() {
        //     // Handle playlist creation logic
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         $playlistId = Playlist::create($_POST);
        //         header("Location: /playlist/view/$playlistId");
        //         exit;
        //     }
        //     require_once __DIR__ . '/../views/playlist/create.php';
        // }

        // public function view($playlist_id) {
        //     $playlist = Playlist::find($playlist_id);
        //     $songs = Song::getByPlaylist($playlist_id);

        //     require_once __DIR__ . '/../views/playlist/view.php';
        // }

        // public function addSong($playlist_id, $songId) {
        //     // Add a song to the playlist
        //     Playlist::addSong($playlist_id, $songId);
        //     header("Location: /playlist/view/$playlist_id");
        //     exit;
        // }

        // public function removeSong($playlist_id, $songId) {
        //     // Remove a song from the playlist
        //     Playlist::removeSong($playlist_id, $songId);
        //     header("Location: /playlist/view/$playlist_id");
        //     exit;
        // }
    }