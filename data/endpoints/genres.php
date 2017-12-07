<?php

require('data/connection.php');

function getGenres() {
  $conn = getConnection();
  $sql = "SELECT genre from genres";
  $result = $conn->query($sql);

  if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
  } else {
    $genres = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($genres, $row["genre"]);
      }
    }
    return $genres;
  }
}

function getMovies($genre) {
  $conn = getConnection();
  // Prepare to get the genre id of the given genre string.
  $sql = $conn->prepare('SELECT id FROM genres WHERE genres.genre = ?');
  $sql->bind_param('s', $genre);
  $sql->execute();
  $result = $sql->get_result();
  $genre_id = '';
  // We will get the id of the genre we specified.
  while($row = $result->fetch_assoc()) {
    $genre_id = $row["id"];
    break;
  }
  // Prepare to get all movies with that genre id.
  $sql = $conn->prepare('SELECT * FROM videos
    JOIN videos_genres ON videos_genres.genre_id = ?
    JOIN videos_thumbnails ON videos_thumbnails.id = videos_genres.video_id
    WHERE videos.id = videos_genres.video_id');
  $sql->bind_param('i', $genre_id);
  $sql->execute();
  $result = $sql->get_result();
  $videos = array();
  // We will get all of the movies of the genre given.
  while($row = $result->fetch_assoc()) {
    array_push($videos, $row);
  }

  return $videos;
}

?>
