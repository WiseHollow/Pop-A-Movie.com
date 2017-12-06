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

?>
