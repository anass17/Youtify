<?php include APPROOT . '/templates/header.php'; ?>

<h1>Create an Album</h1>

<form action="/submit" method="POST" enctype="multipart/form-data">
    <!-- Playlist Name Input -->
    <label for="playlistName">Playlist Name:</label><br>
    <input type="text" id="playlistName" name="playlistName" required><br><br>

    <!-- Audio Files Input (multiple files allowed) -->
    <label for="audioFiles">Add Audios:</label><br>
    <input type="file" id="audioFiles" name="audioFiles[]" accept="audio/*" multiple required><br><br>

    <!-- Submit Button -->
    <button type="submit">Create Playlist</button>
</form>

<?php include APPROOT . '/templates/footer.php'; ?>