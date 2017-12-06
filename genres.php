<?php
require('data/endpoints/genres.php');
$genres = getGenres();
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
    <link href="/css/pages/video.css" rel="stylesheet">
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
          Genres &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content card-block" align="center">
        <div class="tab-pane active">
          <?php
          for ($x = 0; $x < sizeof($genres); $x++) {
            // Lets create all the thumbnails for each genre
            // echo($genres[$x] . "<br>");
            echo('<figure class="figure" style="margin: 12px 4px 12px 4px;">');
            echo('<img src="http://via.placeholder.com/200x200" class="figure-img img-fluid rounded">');
            echo('<figcaption class="figure-caption">' . $genres[$x] . '</figcaption>');
            echo('</figure>');
          }
          ?>
          <!-- <figure class="figure">
            <img src="http://via.placeholder.com/100x100" class="figure-img img-fluid rounded">
            <figcaption class="figure-caption">Sub-Category Name</figcaption>
          </figure>
          <figure class="figure">
            <img src="http://via.placeholder.com/100x100" class="figure-img img-fluid rounded">
            <figcaption class="figure-caption">Sub-Category Name</figcaption>
          </figure>
          <figure class="figure">
            <img src="http://via.placeholder.com/100x100" class="figure-img img-fluid rounded">
            <figcaption class="figure-caption">Sub-Category Name</figcaption>
          </figure> -->


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
