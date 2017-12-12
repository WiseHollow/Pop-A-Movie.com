<?php

require('data/keys.php');

if (!isset($_POST['movie-uuid']) || !isset($_POST['affected']) || !isset($_POST['copyright-owner-name']) || !isset($_POST['full-legal-name']) || !isset($_POST['title']) || !isset($_POST['phone-number']) || !isset($_POST['email-address'])) {
  $verified = false;
} else {
  $verified = true;
}

function post_captcha($user_response, $re_secret_key) {
    $fields_string = '';
    $fields = array(
        'secret' => $re_secret_key,
        'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
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

            <?php
            if ($verified) {

              // Call the function post_captcha
              $res = post_captcha($_POST['g-recaptcha-response'], $re_secret_key);
              // $res['success'] = true;
              if (!$res['success']) {
                  echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
              } else {
                include('data/endpoints/complaint-report.php');
                $conn = getConnection();

                $movie_uuid = $conn->real_escape_string($_POST['movie-uuid']);
                $affected = (int) $conn->real_escape_string($_POST['affected']);
                $company = $conn->real_escape_string($_POST['copyright-owner-name']);
                $legal_name = $conn->real_escape_string($_POST['full-legal-name']);
                $title = $conn->real_escape_string($_POST['title']);
                $phone_number = $conn->real_escape_string($_POST['phone-number']);
                $email = $conn->real_escape_string($_POST['email-address']);

                $response = recordComplaint($conn, $movie_uuid, $affected, $company, $title, $legal_name, $phone_number, $email);

                if ($response == 0) {
                  echo('<br>Error when submitting complaint report. Please contact support about this problem.');
                } else {
                  echo("<p>Thanks! We've received your legal request.</p> <p>We've sent you a verification email about this case. If we comply with your notice in full, you will not receive any further emails about it. </p>");
                  sendEmail($email, $legal_name);
                }
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
