<?php
require('data/endpoints/watch.php');

if (isset($_GET['id'])) {
  $id = explode('.', $_GET['id'])[0];
  if ($id != '' && is_numeric($id)) {
    $movie = getMovie($conn, $id);
    $genres_array = getGenres($conn, $id);
    $genres = implode(', ', $genres_array);
    if (!isset($movie['title'])) {
      goHome();
    }
  } else {
    goHome();
  }
} else {
  goHome();
}

function goHome() {
  header('Location: /');
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

    <!-- Video Display -->
    <br><br><br>
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          You Are Watching &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
        <span class="card-video-title">
          <?php echo($movie['title']);  ?>
        </span>
      </ul>

      <div class="tab-content card-block" align="center">
        <div class="tab-pane active" id="home" role="tabpanel">
          <!--<img class="video-thumbnail-large" src="http://via.placeholder.com/1280x720">-->
          <iframe src="<?php echo($movie['url']); ?>" scrolling="no" frameborder="0" width="1280" height="720" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
        </div>
      </div>
    </div>

    <!-- Description -->
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          Description &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <div class="tab-content card-block">
        <!-- style="padding-top: 10px;" -->
        <div class="tab-pane active text-muted">
          <div class="row">
            <div class="col-2">
              <h3><?php echo($movie['views']); ?> Views</h3>
            </div>
            <div class="col-2">
              <i class="fa fa-thumbs-up fa-2x align-top" aria-hidden="true"><span style="font-size: 32px;"> <?php echo(isset($movie['thumbs_up']) ? $movie['thumbs_up'] : '0'); ?> </span></i> &nbsp;
              <i class="fa fa-thumbs-down fa-2x align-top" aria-hidden="true"><span style="font-size: 32px;"> <?php echo(isset($movie['thumbs_down']) ? $movie['thumbs_down'] : '0'); ?> </span></i>
            </div>
            <div class="col-8">
              <i class="fa fa-share-square-o fa-2x" aria-hidden="true">Share</i>
            </div>
          </div>
          <div class="row video-description">
            <p class="card-text">Description: <?php echo($movie['description']); ?></p>
          </div>
          <div class="row video-description">
            <p class="card-text">Genres: <?php echo($genres); ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Related videos -->
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          Similar Movies To Watch &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <div class="scroll-pane" style="height: 330px;">
        <?php
        $movies = getSimilarMovies($conn, $genres_array);
        foreach ($movies as $movie) {
          echo('<figure class="figure">');
          echo('<a href="/watch/' . $movie['id'] . '"><img src="data:image/jpeg;base64,' . base64_encode($movie['thumbnail']) . '" class="figure-img img-fluid rounded movie-thumbnail"></a>');
          echo('<figcaption class="figure-caption"><a href="/watch/' . $movie['id'] . '">' . $movie['title'] . '</a></figcaption>');
          echo('</figure>');
        }
        ?>
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
