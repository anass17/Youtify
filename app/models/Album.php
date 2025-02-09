<?php

    class Album {
        private int $album_id;
        private string $name;
        private string $create_date;

        public function __construct($album_id = 0, $name = '', $create_date = '') {
            $this -> album_id = $album_id;
            $this -> name = $name;
            $this -> create_date = $create_date;
        }


        public function getAlbumId() {
            return $this -> album_id;
        }
        public function getName() {
            return htmlspecialchars($this -> name);
        }
        public function getCreateDate() {
            return htmlspecialchars($this -> create_date);
        }


        public function setName($name) {
            $this -> name = $name;
        }

        public static function getAllAlbums() {

            $db = Database::getInstance();
            
            $result = $db->selectAll("SELECT * FROM albums");

            $albums = [];

            foreach($result as $row) {

                $album = new Album($row['user_id'], $row['name'], $row['create_date']);

                $albums[] = $album;
                
            }

            return $albums;
        }

        public function createAlbum($user_id) {

            $db = Database::getInstance();

            $columns = [
                'name',
                'created_by'
            ];

            $data = [
                $this -> name,
                $user_id
            ];
            
            $inserted_id = $db->insert('albums', $columns, $data);

            return $inserted_id;
        }

        public function loadAlbum($album_id) {

            $db = Database::getInstance();
            
            $playlist = $db->select('SELECT * from albums WHERE album_id = ?', [$album_id]);

            $this -> album_id = $playlist['album_id'];
            $this -> name = $playlist['name'];
            $this -> create_date = $playlist['create_date'];
            
        }

    }
