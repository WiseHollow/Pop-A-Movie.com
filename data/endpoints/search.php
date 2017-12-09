<?php

require('data/connection.php');
$conn = getConnection();

function getSearchResults($conn, $keywords) {
  // Create useable string for SQL with no characters that could break the query or make it work unintended.
  $keywords = $conn->real_escape_string($keywords);
  $sql = 'SELECT movies.id, title, thumbnail FROM movies
    JOIN movies_thumbnails ON movies.id = movies_thumbnails.id
    WHERE movies.title LIKE "%' . $keywords . '%"';
  $result = $conn->query($sql);

  $movies = array();
  // We will get all of the movies given.
  while($row = $result->fetch_assoc()) {
    array_push($movies, $row);
  }

  return $movies;
}
?>
