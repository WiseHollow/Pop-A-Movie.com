<html lang="en">

  <head>
    <title>Pop A Movie - Watch <?php echo($movie['title']); ?></title>
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
    <script src="/js/pages/video.js"></script>
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
          </div>
        </div>
      </div>
    </div>

    <div id="footer"></div>
  </body>

  </html>
