<?php
require('data/endpoints/watch.php');

if (isset($_GET['id'])) {
  $id = explode('.', $_GET['id'])[0];
  if ($id != '' && is_numeric($id)) {
    $movie = getMovie($conn, $id);
    $urls = getMovieUrls($conn, $id);
    $urlKey = explode('/', $urls[0]['url'])[4]; // this needs a lot of work
    $trailer = getTrailer($conn, $id);
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
    <link href="/css/pages/watch.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <script src="/js/popper.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/pages/video.js"></script>
    <script src="/js/mousewheel.js"></script>
    <script src="/js/jscrollpane.js"></script>

    <script>
    var url = $('#trailer-iframe').attr('src');
      $(function() {
        $("#nav").load("/includes/nav.html");
        $("#footer").load("/includes/footer.html");
      });
      $(document).on("click", function(e) {
        if ($(e.target).is('#trailer-back')) {
          $('#trailer-back').toggle();
          $('#trailer-div').toggle();
          url = $('#trailer-iframe').attr('src');
          $('#trailer-iframe').attr('src', '');
        } else {}
          if ($(e.target).is('#trailer-btn')) {
            $('#trailer-back').toggle();
            $('#trailer-div').toggle();
            $('#trailer-iframe').attr('src', url);
          } else {}
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
          <iframe sandbox="allow-same-origin allow-scripts" src="<?php echo($urls[0]['url']); ?>" scrolling="no" frameborder="0" width="1280" height="720" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
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
            <div class="col-6">
              <i class="fa fa-share-square-o fa-2x" aria-hidden="true">Share</i>
            </div>
            <div class="col-2">
              <?php echo($trailer != '' ? '<input class="btn btn-primary btn-block" type="button" value="Watch Trailer" id="trailer-btn">' : ''); ?>
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

    <!-- Download -->
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          Downloads &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <div class="tab-content card-block">
        <div class="tab-pane active" align="center">
          <div class="row" align="center">
            <div class="col-2"></div>
            <div class="col-2 table-header table-cell">
              <p>Server</p>
            </div>
            <div class="col-2 table-header table-cell">
              <p>Language</p>
            </div>
            <div class="col-2 table-header table-cell">
              <p>Download Link</p>
            </div>
            <div class="col-2 table-header table-cell" style="border-right: 0px;">
              <p>Subtitles Link</p>
            </div>
            <div class="col-2"></div>
          </div>
          <div class="row text-muted" align="center">
            <div class="col-2"></div>
            <?php
            $server = 'Openload.co';
            foreach ($urls as $url) {
              echo('<div class="col-2 table-body"><p>' . $server . '</p></div>');
              echo('<div class="col-2 table-body"><p>' . $url['language'] . '</p></div>');
              echo('<div class="col-2 table-body"><input type="button" class="btn btn-success" value="Download" onClick="download(\'' . $url['url'] . '\')"></div>');
              echo('<div class="col-2 table-body"><input type="button" class="btn btn-success" value="View"></div>');
            }
            ?>
            <div class="col-2"></div>
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

    <div class="trailer-back" id="trailer-back"></div>
    <div class="trailer" id="trailer-div" align="center">
      <iframe src="<?php echo($trailer); ?>" id="trailer-iframe" scrolling="no" frameborder="0" width="800" height="480" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
    </div>

    <script lang="jquery">
      $(function() {
        $('.scroll-pane').jScrollPane();
      });
    </script>

  </body>

</html>
