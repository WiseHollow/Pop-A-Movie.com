<?php

require('data/connection.php');
$conn = getConnection();

function getMostViewedMovies($conn) {
  $sql = 'SELECT videos.id, views, title, thumbnail
    FROM videos
    JOIN videos_thumbnails ON videos_thumbnails.id = videos.id
    ORDER BY views DESC
    LIMIT 18';

  $result = $conn->query($sql);
  $movies = array();
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      array_push($movies, $row);
    }
  }
  return $movies;
}

function getLatestMovies($conn) {
  $sql = 'SELECT videos.id, title, thumbnail
  FROM videos
  JOIN videos_thumbnails ON videos_thumbnails.id = videos.id
  ORDER BY added DESC
  LIMIT 18';

  $result = $conn->query($sql);
  $movies = array();
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      array_push($movies, $row);
    }
  }
  return $movies;
}

?>
