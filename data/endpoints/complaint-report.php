<?php

require('data/connection.php');

function recordComplaint($conn, $movie_title, $affected, $company, $title, $legal_name, $phone_number, $email) {
  $sql = $conn->prepare('INSERT INTO complaints
    (movie_title, affected, company_name, job_title, full_legal_name, phone_number, email_address)
    VALUES (?, ?, ?, ?, ?, ?, ?)');

  $sql->bind_param('sisssss', $movie_title, $affected, $company, $title, $legal_name, $phone_number, $email);
  $sql->execute();

  $rows_altered = mysqli_affected_rows($conn);

  $sql->close();
  $conn->close();

  return $rows_altered;
}

?>
