<?php

// Get our connection function.
require('data/connection.php');
// Establish connection to database.
$conn = getConnection();

function getMovie($conn, $title) {
  // Prepare statement to get all data related to movie of id.
  // Here is the sql for ratings when we want it. JOIN movies_ratings ON movies.id = movies_ratings.id
  $title = str_replace("%20", " ", $title);
  $title = str_replace("%E2%80%99", "\'", $title);
  // $title = $conn->real_escape_string($title);
  // $title = filter_var($title, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); // FILTER_FLAG_STRIP_HIGH
  echo($title);

  // $sql = "SELECT movies.id, title, views, description FROM movies
  //   JOIN movies_description ON movies.id = movies_description.id
  //   WHERE movies.title = '" . $title . "' AND active = 1";
  // $result = $conn->query($sql);

  $sql = $conn->prepare('SELECT movies.id, title, views, description FROM movies
    JOIN movies_description ON movies.id = movies_description.id
    WHERE movies.title = ? AND active = 1');
  $success = $sql->bind_param('s', $title);
  $sql->execute();
  $result = $sql->get_result();

  // Create variable to store movie data.
  $movie = array();

  while ($row = $result->fetch_assoc()) {
    // Store movie data and break out of loop. Should only be 1 result.
    $movie = $row;
    break;
  }

  // We must increment our movie views on the server, plus what is being sent to the client.
  // First we have to check if the movie data was populated.
  if (isset($movie['views'])) {
    incrementViews($conn, $title);
    $movie['views'] = $movie['views'] + 1;
  }

  // Return movie.
  return $movie;
}

function incrementViews($conn, $title) {
  $sql = $conn->prepare('UPDATE movies SET views = views + 1 WHERE movies.title = ?');
  $sql->bind_param('s', $title);
  $sql->execute();
}

function getMovieUrls($conn, $id) {
  $sql = $conn->prepare('SELECT url, language
    FROM movies_urls
    WHERE movies_urls.movie_id = ?');
  $sql->bind_param('i', $id);
  $sql->execute();
  $result = $sql->get_result();

  $urls = array();

  while ($row = $result->fetch_assoc()) {
    array_push($urls, $row);
  }

  return $urls;
}

function getGenres($conn, $id) {
  $sql = $conn->prepare('SELECT genre FROM genres
    JOIN movies_genres ON movies_genres.movie_id = ?
    WHERE genres.id = movies_genres.genre_id');
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

function getSimilarMovies($conn, $genres) {
  $inArray = array();
  foreach ($genres as $genre) {
    array_push($inArray, "'" . $genre . "'");
  }
  $in = implode(', ', $inArray);

  $sql = 'SELECT DISTINCT v.id, title, thumbnail
    FROM movies v
    JOIN movies_genres vg ON vg.movie_id = v.id
    JOIN movies_thumbnails vt ON vt.id = v.id
    WHERE vg.genre_id IN
    (
      SELECT g.id
      FROM genres g
      WHERE g.genre IN (' . $in . ')
    )';
  $result = $conn->query($sql);
  $movies = array();
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      array_push($movies, $row);
    }
  }
  return $movies;
}

function getTags($conn, $id) {

}

function getTrailer($conn, $id) {
  $sql = $conn->prepare('SELECT url FROM movies_trailers WHERE id = ?');
  $sql->bind_param('i', $id);
  $sql->execute();
  $result = $sql->get_result();
  $trailer = '';
  while ($row = $result->fetch_assoc()) {
    $trailer = $row['url'];
    break;
  }
  return $trailer;
}

function getCountries($conn, $id) {
  $sql = $conn->prepare('SELECT country FROM countries
    JOIN movies_countries ON movies_countries.movie_id = ?
    WHERE countries.id = movies_countries.country_id');
  $sql->bind_param('i', $id);
  $sql->execute();
  $result = $sql->get_result();
  $countries = array();
  while ($row = $result->fetch_assoc()) {
    array_push($countries, $row['country']);
  }
  return $countries;
}

function thumbsUp($conn, $id) {
  // TODO: Requires IP address to be checked.
}

function thumbsDown($conn, $id) {
  // TODO: Requires IP address to be checked.
}

?>
