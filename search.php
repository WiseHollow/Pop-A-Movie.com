<?php
require('data/endpoints/search.php');
$keywords = explode("?query=", $_SERVER['REQUEST_URI'])[1];
$movies = getSearchResults($conn, $keywords);
?>

<html lang="en">

  <head>
    <title>PopAMovie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Pathway+Gothic+One" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jscrollpane.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/pages/search.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <script src="/js/popper.js"></script>
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

    <!-- Search Results -->
    <br><br><br>
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          Categories &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content card-block" align="center">
        <div class="tab-pane active">

          <h3>Results for: <?php echo($keywords); ?></h3>
          <figure class="figure">
            <?php
            foreach ($movies as $movie) {
              echo('<figure class="figure">');
              echo('<a href="/watch/' . $movie['id'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movie['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
              echo('<figcaption class="figure-caption title"><a href="/watch/' . $movie['id'] . '">' . $movie['title'] . '</a></figcaption>');
              echo('</figure>');
            }
            ?>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <div id="footer"></div>

    <script>
      $(function() {
        $('.scroll-pane').jScrollPane();
      });
    </script>

  </body>

</html>
