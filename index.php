<?php

require('data/endpoints/home.php');
$most_viewed = getMostViewedMovies($conn);
$latest_movies = getLatestMovies($conn);
$random_movies = getRandomMovies($conn);
$featured_movies = getFeaturedMovies($conn);
?>

<html lang="en">

  <head>
    <title>Pop A Movie - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Pathway+Gothic+One" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jscrollpane.css" rel="stylesheet">
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/pages/home.css" rel="stylesheet">
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

    <div class="container-fluid">
      <!-- Featured Films -->
      <br><br>
      <div class="card bg-inverse text-white">

        <div class="scroll-pane">
          <?php
          for ($index = 0; $index < sizeof($featured_movies); $index++) {
            $movie = $featured_movies[$index];
            echo('<a href="/watch/' . $movie['title'] . '"><span class="featured-movie" style="left: ' . (25 + 625 * $index) . 'px;"><p>' . $movie['title'] . '</p></span><img class="video-thumbnail-large" src="data:image/jpeg;base64,' . base64_encode($movie['image']) . '"></a>');
          }
          ?>
        </div>
      </div>

      <!-- Suggestions -->
      <div class="card bg-inverse text-white">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <span class="card-title align-middle">
            Suggestions &nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </span>

          <li class="nav-item">
            <a class="nav-link active text-white" data-toggle="tab" href="#home" role="tab">Most Viewed</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link text-white" data-toggle="tab" href="#profile" role="tab">Most Favorited</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" data-toggle="tab" href="#messages" role="tab">Top Rated</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link text-white" data-toggle="tab" href="#settings" role="tab">Random</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content card-block" align="center">
          <div class="tab-pane active" id="home" role="tabpanel">
            <?php
            foreach ($most_viewed as $movie) {
              echo('<figure class="figure">');
              if ($movie['genre_id'] == 22) {
                echo('<span class="movie_overlay">18+</span>');
              }
              echo('<a href="/watch/' . $movie['uuid'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movie['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
              echo('<figcaption class="figure-caption title"><a href="/watch/' . $movie['uuid'] . '">' . $movie['title'] . '</a></figcaption>');
              echo('</figure>');
            }
            ?>
          </div>
          <div class="tab-pane" id="profile" role="tabpanel">
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
          </div>
          <div class="tab-pane" id="messages" role="tabpanel">
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
            <a href="#"><img class="video-thumbnail-large" src="https://via.placeholder.com/200x200"></a>
          </div>
          <div class="tab-pane" id="settings" role="tabpanel">
            <?php
            foreach ($random_movies as $movie) {
              echo('<figure class="figure">');
              echo('<a href="/watch/' . $movie['uuid'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movie['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
              echo('<figcaption class="figure-caption title"><a href="/watch/' . $movie['uuid'] . '">' . $movie['title'] . '</a></figcaption>');
              echo('</figure>');
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Latest -->
      <div class="card bg-inverse text-white">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <span class="card-title align-middle">
            Latest &nbsp;
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </span>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content card-block" align="center">
          <div class="tab-pane active" id="home" role="tabpanel">
            <?php
            foreach ($latest_movies as $movie) {
              echo('<figure class="figure">');
              if ($movie['genre_id'] == 22) {
                echo('<span class="movie_overlay">18+</span>');
              }
              echo('<a href="/watch/' . $movie['uuid'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movie['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
              echo('<figcaption class="figure-caption title"><a href="/watch/' . $movie['uuid'] . '">' . $movie['title'] . '</a></figcaption>');
              echo('</figure>');
            }
            ?>
          </div>
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
