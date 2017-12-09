<?php

require('data/connection.php');
$conn = getConnection();

function getGenreId($conn, $genre) {
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
  return $genre_id;
}

function getAllGenres($conn) {
  $sql = "SELECT genre from genres
  WHERE hidden = 0
  ORDER BY genre ASC";
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

function getAllGenreThumbnails($conn) {
  $sql = $conn->prepare('SELECT genre, thumbnail FROM genres
    JOIN genres_thumbnails ON genres_thumbnails.id = genres.id');
  $sql->execute();
  $result = $sql->get_result();

  $thumbnails = array();

  while($row = $result->fetch_assoc()) {
    $thumbnails[$row['genre']] = $row['thumbnail'];
  }

  return $thumbnails;
}

function getMovies($conn, $genre) {
  $genre_id = getGenreId($conn, $genre);
  // Prepare to get all movies with that genre id.
  $sql = $conn->prepare('SELECT * FROM movies
    JOIN movies_genres ON movies_genres.genre_id = ?
    JOIN movies_thumbnails ON movies_thumbnails.id = movies_genres.movie_id
    WHERE movies.id = movies_genres.movie_id
    AND movies.active = 1
    ORDER BY movies.added DESC');
  $sql->bind_param('i', $genre_id);
  $sql->execute();
  $result = $sql->get_result();
  $movies = array();
  // We will get all of the movies of the genre given.
  while($row = $result->fetch_assoc()) {
    array_push($movies, $row);
  }

  return $movies;
}

function generateThumbnailUrl($genre, $thumbnails) {
  if (isset($thumbnails[$genre])) {
    return 'data:image/jpeg;base64,' . base64_encode($thumbnails[$genre]);
  } else {
    return 'https://via.placeholder.com/170x260';
  }
}

?>
