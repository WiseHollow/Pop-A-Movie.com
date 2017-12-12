<?php

require('data/connection.php');

function recordComplaint($conn, $movie_uuid, $affected, $company, $title, $legal_name, $phone_number, $email) {
  $sql = $conn->prepare('INSERT INTO complaints
    (movie_uuid, affected, company_name, job_title, full_legal_name, phone_number, email_address)
    VALUES (?, ?, ?, ?, ?, ?, ?)');

  $sql->bind_param('sisssss', $movie_uuid, $affected, $company, $title, $legal_name, $phone_number, $email);
  $sql->execute();

  $rows_altered = mysqli_affected_rows($conn);
  // echo('Success: ' . mysqli_error($conn));
  $sql->close();
  $conn->close();

  return $rows_altered;
}

function sendEmail($email, $legal_name) {
  if ($_SERVER['REMOTE_ADDR'] == '::1') {
    return;
  }

  $message = 'Hello ' . $legal_name . "\r\n\r\n";
  $message .= 'We have received your legal claim and will process as soon as possible. We take these claims very seriously and appologize for the inconvience. \r\n';
  $message .= "If a full action is taken on your claim, you will not receive any further emails about it. If the claim is valid, the content will be disabled and unaccessable for users. \r\n\r\n";
  $message .= "Thank you very much, \r\n\r\n";
  $message .= "Pop A Movie - Staff";

  $message = wordwrap($message, 70, "\r\n");

  $to      = $email;
  $subject = 'PopAMovie Complaint';
  $headers = 'From: noreply@popamovie.com' . "\r\n" .
      'Reply-To: noreply@popamovie.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $message, $headers);


}

?>
