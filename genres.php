<?php
require('data/endpoints/genres.php');
$genre = "Genres"; // No genre defined yet (Going to list choices).
if (isset($_GET["genre"])) {
  $genre = explode(".", $_GET["genre"])[0];
  $movies = getMovies($genre);
} else {
  $genres = getGenres();
}
?>

<html lang="en">

  <head>
    <title>Films Today</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Pathway+Gothic+One" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jscrollpane.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/pages/genres.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <script src="/js/popper.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/view/video.js"></script>
    <script src="/js/mousewheel.js"></script>
    <script src="/js/jscrollpane.js"></script>

    <script>
      $(function() {
        $("#nav").load("/includes/nav.html");
        $("#footer").load("/includes/footer.html");
      });
    </script>

  </head>

  <body class="text-white" style="background-color: #262626;">
    <!-- Navbar -->
    <div id="nav"></div>

    <!-- Categories -->
    <br><br><br>
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          <?php echo($genre); ?> &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content card-block" align="center">
        <div class="tab-pane active">
          <?php
          if (isset($genres)) {
            for ($x = 0; $x < sizeof($genres); $x++) {
              // Lets create all the thumbnails for each genre
              // echo($genres[$x] . "<br>");
              echo('<figure class="figure" style="margin: 12px 4px 12px 4px;">');
              echo('<a href="/genres/' . $genres[$x] . '"><img src="http://via.placeholder.com/170x260" class="figure-img img-fluid rounded"></a>');
              echo('<figcaption class="figure-caption"><a href="#">' . $genres[$x] . '</a></figcaption>');
              echo('</figure>');
            }
          } else if (isset($movies)) {
            for ($x = 0; $x < sizeof($movies); $x++) {
              // echo($movies[$x]['title'] . '<br>');
              echo('<figure class="figure">');
              echo('<a href="/watch/' . $movies[$x]['id'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movies[$x]['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
              echo('<figcaption class="figure-caption"><a href="/watch/' . $movies[$x]['id'] . '">' . $movies[$x]['title'] . '</a></figcaption>');
              echo('</figure>');
            }
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
