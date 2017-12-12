<?php

require('data/connection.php');
$conn = getConnection();

function getMostViewedMovies($conn) {
  $sql = 'SELECT movies.id, uuid, views, title, thumbnail
    FROM movies
    JOIN movies_thumbnails ON movies_thumbnails.id = movies.id
    ORDER BY views DESC
    LIMIT 16';

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
  $sql = 'SELECT movies.id, uuid, title, thumbnail
  FROM movies
  JOIN movies_thumbnails ON movies_thumbnails.id = movies.id
  ORDER BY added DESC
  LIMIT 16';

  $result = $conn->query($sql);
  $movies = array();
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      array_push($movies, $row);
    }
  }
  return $movies;
}

function getRandomMovies($conn) {
  // Select random movies that are not ADULT movies.
  $sql = 'SELECT * FROM movies
    JOIN movies_thumbnails ON movies_thumbnails.id = movies.id
    WHERE movies.id NOT IN
    (
        SELECT movies_genres.movie_id FROM movies_genres
    	WHERE movies_genres.genre_id = 22
    )
    ORDER BY RAND()
    LIMIT 16';

  $result = $conn->query($sql);
  $movies = array();
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      array_push($movies, $row);
    }
  }
  return $movies;
}

function getFeaturedMovies($conn) {
  $sql = 'SELECT movies.id, uuid, title, image
  FROM movies_featured
  JOIN movies
  WHERE movies.id = movies_featured.id
  ORDER BY movies.id ASC';
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
