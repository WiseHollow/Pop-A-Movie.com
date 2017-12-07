<?php

// Get our connection function.
require('data/connection.php');
// Establish connection to database.
$conn = getConnection();

function getMovie($conn, $id) {
  // Prepare statement to get all data related to video of id.
  $sql = $conn->prepare('SELECT * FROM videos
    JOIN videos_description ON videos.id = videos_description.id
    JOIN videos_ratings ON videos.id = videos_ratings.id
    JOIN videos_urls ON videos.id = videos_urls.video_id
    WHERE videos.id = ? AND active = 1');
  $sql->bind_param('i', $id);
  $sql->execute();
  $result = $sql->get_result();

  // Create variable to store movie data.
  $video = array();

  while ($row = $result->fetch_assoc()) {
    // Store movie data and break out of loop. Should only be 1 result.
    $video = $row;
    break;
  }

  // We must increment our movie views on the server, plus what is being sent to the client.
  // First we have to check if the movie data was populated.
  if (isset($video['views'])) {
    incrementViews($conn, $id);
    $video['views'] = $video['views'] + 1;
  }

  // Return movie.
  return $video;
}

function getGenres($conn, $id) {
  $sql = $conn->prepare('SELECT genre FROM genres
    JOIN videos_genres ON videos_genres.video_id = ?
    WHERE genres.id = videos_genres.genre_id');
  $sql->bind_param('i', $id);
  $sql->execute();
  $result = $sql->get_result();

  // Where we store all the Genres
  $genres = array();

  // Store them!
  while ($row = $result->fetch_assoc()) {
    array_push($genres, $row['genre']);
  }

  return $genres;
}

function getTags($conn, $id) {

}

function incrementViews($conn, $id) {
  $sql = $conn->prepare('UPDATE videos SET views = views + 1 WHERE videos.id = ?');
  $sql->bind_param('i', $id);
  $sql->execute();
}

function thumbsUp($conn, $id) {
  // TODO: Requires IP address to be checked.
}

function thumbsDown($conn, $id) {
  // TODO: Requires IP address to be checked.
}

?>
