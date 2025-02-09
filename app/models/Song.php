<?php

    class Song {
        private int $song_id;
        private string $name;
        private string $song_path;

        public function __construct($song_id = 0, $name = '', $song_path = '') {
            $this -> song_id = $song_id;
            $this -> name = $name;
            $this -> song_path = $song_path;
        }


        public function getPlaylistId() {
            return $this -> song_id;
        }
        public function getName() {
            return htmlspecialchars($this -> name);
        }
        public function getSongPath() {
            return htmlspecialchars($this -> song_path);
        }


        public function setName($name) {
            $this -> name = $name;
        }
        public function setSongPath($song_path) {
            $this -> song_path = $song_path;
        }

    }
