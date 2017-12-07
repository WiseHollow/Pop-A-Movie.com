<?php

require('data/connection.php');

function getMovie($id) {
  // Establish connection to database
  $conn = getConnection();

  // Prepare statement to get all data related to video of id.
  $sql = $conn->prepare('SELECT * FROM videos
    JOIN videos_description ON videos.id = videos_description.id 
    WHERE videos.id = ?');
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

  // Return movie.
  return $video;
}

?>
