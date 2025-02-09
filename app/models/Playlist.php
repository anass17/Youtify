<?php

    class Playlist {
        private int $playlist_id;
        private string $name;
        private string $visibility;
        private string $create_date;
        private array $songs = [];

        public function __construct($playlist_id = 0, $name = '', $visibility = '', $create_date = '') {
            $this -> playlist_id = $playlist_id;
            $this -> name = $name;
            $this -> visibility = $visibility;
            $this -> create_date = $create_date;
        }


        public function getPlaylistId() {
            return $this -> playlist_id;
        }
        public function getName() {
            return htmlspecialchars($this -> name);
        }
        public function getVisibility() {
            return htmlspecialchars($this -> visibility);
        }
        public function getCreateDate() {
            return htmlspecialchars($this -> create_date);
        }
        public function getSongs() {
            return $this -> songs;
        }


        public function setName($name) {
            $this -> name = $name;
        }
        public function setVisibility($visibility) {
            $this -> visibility = $visibility;
        }


        public static function getAllPlaylists() {

            $db = Database::getInstance();
            
            $result = $db->selectAll("SELECT * FROM playlists");

            $platlists = [];

            foreach($result as $row) {

                $platlist = new Playlist($row['playlist_id'], $row['name'], $row['visibility'], $row['create_date']);

                $platlists[] = $platlist;
                
            }

            return $platlists;
        }

        public function createPlaylist($user_id) {

            $db = Database::getInstance();

            $columns = [
                'name',
                'visibility',
                'created_by'
            ];

            $data = [
                $this -> name,
                $this -> visibility,
                $user_id
            ];
            
            $inserted_id = $db->insert('playlists', $columns, $data);

            return $inserted_id;
        }

        public function loadPlaylist($playlist_id) {

            $db = Database::getInstance();
            
            $playlist = $db->select('SELECT * from playlists WHERE playlist_id = ?', [$playlist_id]);

            $this -> playlist_id = $playlist['playlist_id'];
            $this -> name = $playlist['name'];
            $this -> visibility = $playlist['visibility'];
            $this -> create_date = $playlist['create_date'];

            $songs = $db->select('SELECT S.song_id as id, S.name as name, S.path as path from songs S JOIN playlist_songs PS on S.song_id = PS.song_id WHERE playlist_id = ?', [$playlist_id]);

            foreach($songs as $row) {

                $song = new Song($row['id'], $row['name'], $row['path']);

                $this -> songs[] = $song;
                
            }

        }

    }
