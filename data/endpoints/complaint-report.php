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

function sendEmail($email, $legal_name, $movie_title) {
  $body = 'Hello ' . $legal_name . '<br><br>' .
  'We have received your legal claim and will process as soon as possible. We take these claims very seriously and appologize for the inconvience. <br><br>' .
  "If a full action is taken on your claim, you will not receive any further emails about it. If the claim is valid, the content will be disabled and unaccessable for users. <br><br>" .
  "Thank you very much, <br><br>" .
  "Pop A Movie - Staff";
}

?>
