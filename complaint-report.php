<?php

if (!isset($_GET['movie-title']) || !isset($_GET['affected']) || !isset($_GET['copyright-owner-name']) || !isset($_GET['full-legal-name']) || !isset($_GET['title']) || !isset($_GET['phone-number']) || !isset($_GET['email-address'])) {
  $verified = false;
} else {
  $verified = true;
}

?>

<html lang="en">

  <head>
    <title>Pop A Movie - Complaint Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Pathway+Gothic+One" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jscrollpane.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/pages/watch.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <script src="/js/popper.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mousewheel.js"></script>
    <script src="/js/jscrollpane.js"></script>

    <script>
      $(function() {
        $("#nav").load("/includes/nav.html");
        $("#footer").load("/includes/footer.html");
      });
    </script>

  </head>

  <body class="container-fluid text-white" style="background-color: #262626;">
    <!-- Navbar -->
    <div id="nav"></div>
    <br><br><br><br><br>

    <div class="card bg-inverse text-white">

      <div class="tab-content card-block">
        <div class="tab-pane active" id="home" role="tabpanel">
          <div>
            <h2>Pop A Movie - Complaint Verification</h2>
            <p>Thanks! We've received your legal request.</p>
            <p>We've sent you a verification email about this case. If we comply with your notice in full, you will not receive any further emails about it. </p>

            <?php
            if ($verified) {

              include('data/endpoints/complaint-report.php');
              $conn = getConnection();

              $movie_title = $conn->real_escape_string($_GET['movie-title']);
              $affected = (int) $conn->real_escape_string($_GET['affected']);
              $company = $conn->real_escape_string($_GET['copyright-owner-name']);
              $legal_name = $conn->real_escape_string($_GET['full-legal-name']);
              $title = $conn->real_escape_string($_GET['title']);
              $phone_number = $conn->real_escape_string($_GET['phone-number']);
              $email = $conn->real_escape_string($_GET['email-address']);

              $response = recordComplaint($conn, $movie_title, $affected, $company, $title, $legal_name, $phone_number, $email);

              echo('<br><br>' . $response . '<br>');
              if ($response == 0) {
                echo('Error when submitting complaint report. Please contact support about this problem.');
              } else {
                // Send email
              }


            } else {
              echo ('An issue was detected with your report. Please make sure you completed the form in the page prior to coming here.');
            }
            ?>

          </div>
        </div>
      </div>
    </div>

    <div id="footer"></div>
  </body>

  </html>
