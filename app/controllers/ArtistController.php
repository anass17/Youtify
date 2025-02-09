<?php

class ArtistController {
    public function view($artistId)
    {
        // Fetch artist details
        $artist = Artist::find($artistId);
        $albums = Artist::getAlbums($artistId);
        require_once __DIR__ . '/../views/artist/view.php';
    }

    public function albums($artistId)
    {
        // Fetch albums by the artist
        $albums = Artist::getAlbums($artistId);
        require_once __DIR__ . '/../views/artist/albums.php';
    }
}
