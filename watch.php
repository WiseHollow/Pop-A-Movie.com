<?php
require('data/endpoints/watch.php');

function notFound() {
  header('Location: /404.php');
}
$title = str_replace("%20", " ", explode("watch/", $_SERVER['REQUEST_URI'])[1]);
$movie = getMovie($conn, $title);
// echo(json_encode($movie));
if (isset($movie['title'])) {
  $id = $movie['id'];
  $urls = getMovieUrls($conn, $id);
  $countriesArray = getCountries($conn, $id);
  $countries = implode(', ', $countriesArray);
  $trailer = getTrailer($conn, $id);
  $genres_array = getGenres($conn, $id);
  $genres = implode(', ', $genres_array);
} else {
  notFound();
}


?>

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
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script>
    var url = "<?php echo($trailer); ?>";
    var title = "<?php echo($movie['title']); ?>";
      $(function() {
        $("#nav").load("/includes/nav.html");
        $("#footer").load("/includes/footer.html");
      });
      $(document).on("click", function(e) {
        if ($(e.target).is('#black-background')) {
          $('#black-background').hide();
          $('#trailer-div').hide();
          $('#report-video-div').hide();
          // url = $('#trailer-iframe').attr('src');
          $('#trailer-iframe').attr('src', '');
        } else if ($(e.target).is('#trailer-btn')) {
          $('#black-background').toggle();
          $('#trailer-div').toggle();
          if (  $('#trailer-iframe').attr('src') != url) {
            $('#trailer-iframe').attr('src', url);
          }
        } else if ($(e.target).is('#report-video-btn')) {
          $('#black-background').toggle();
          $('#report-video-div').toggle();
        } else if ($(e.target).is('#search-subtitles-btn')) {
          subtitles(title);
        }
      });
    </script>

  </head>

  <body class="container-fluid text-white" style="background-color: #262626;">
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
          <iframe src="<?php echo($urls[0]['url']); ?>" scrolling="no" frameborder="0" width="1280" height="720" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
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
            <div class="col-10">
            <h3><?php echo($movie['views']); ?> Views</h3>
              <div class="video-description">
                <p class="card-text"><b>Description: </b><?php echo($movie['description']); ?></p>
              </div>
              <div class="video-description">
                <p class="card-text"><b>Genres: </b><?php echo($genres); ?></p>
              </div>
              <div class="video-description">
                <p class="card-text"><?php echo($countries != "" ? '<b>Country: </b>' . $countries : ''); ?></p>
              </div>
            </div>
            <div class="col-2">
              <?php echo($trailer != '' ? '<input class="btn btn-primary btn-block" type="button" value="Watch Trailer" id="trailer-btn">' : ''); ?>
              <input class="btn btn-primary btn-block" type="button" value="Search for Subtitles" id="search-subtitles-btn">
              <input class="btn btn-primary btn-block" type="button" value="Report" id="report-video-btn">
            </div>
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
              <p>Link Status</p>
            </div>
            <div class="col-2"></div>
          </div>
          <div class="row text-muted" align="center">
            <div class="col-2"></div>
            <?php
            // $server = 'Openload.co';
            foreach ($urls as $url) {

              $server = ucfirst(explode("/", $url['url'])[2]);

              echo('<div class="col-2 table-body"><p>' . $server . '</p></div>');
              echo('<div class="col-2 table-body"><p>' . $url['language'] . '</p></div>');
              echo('<div class="col-2 table-body"><input type="button" class="btn btn-success" value="Download" onClick="download(\'' . $url['url'] . '\')"></div>');
              echo('<div class="col-2 table-body"></div>');
              // <input type="button" class="btn btn-success" value="View">
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

    <div class="black-background" id="black-background"></div>
    <div class="floatingDialog trailer" id="trailer-div" align="center">
      <iframe src="<?php echo($trailer); ?>" id="trailer-iframe" scrolling="no" frameborder="0" width="800" height="480" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
    </div>

    <div class="floatingDialog report-video-div text-white" id="report-video-div">
      <form action="/complaint-report.php">
        <h2>Copyright infringement - Complaint</h2>
        <hr>
        <h3>Who is being affected?</h3>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="affected" id="exampleRadios1" value="0" checked>
            I am.
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="affected" id="exampleRadios2" value="1">
            My company, organization, or client
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="affected" id="exampleRadios3" value="2">
            Another copyright owner
          </label>
        </div>

        <h3>Give us some additional details.</h3>

        <div class="form-group">
          <label for="company-name">Copyright Owner Name (Company Name if applicable): </label>
          <input class="form-control form-control-sm" id="company-name" type="text" placeholder="Copyright Owner Name" name="copyright-owner-name">
        </div>

        <div class="form-group">
          <label for="company-name">Your Full Legal Name (Aliases, usernames or initials not accepted): </label>
          <input class="form-control form-control-sm" id="company-name" type="text" placeholder="Full Legal Name" name="full-legal-name">
        </div>

        <div class="form-group">
          <label for="title">Your Title or Job Position (What is your authority to make this complaint?): </label>
          <input class="form-control form-control-sm" id="title" type="text" placeholder="Title/Position" name="title">
        </div>

        <div class="form-group">
          <label for="phone-number">Phone Number: </label>
          <input class="form-control form-control-sm" id="phone-number" type="text" placeholder="Phone" name="phone-number">
        </div>

        <div class="form-group">
          <label for="email">Email Address: </label>
          <input class="form-control form-control-sm" id="email" type="text" placeholder="Email" name="email-address">
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" required>
            I am the owner, or an agent authoized to act on behalf of the owner.
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" required>
            This notification is accurate.
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" required>
            Any person who knowingly materially misrepresents under this section (<a href="https://www.law.cornell.edu/uscode/text/17/512" target="_blank">details</a>), shall be liable for any damages.
          </label>
        </div>

        <div class="form-group">
          <label for="movie-title">Movie Title </label>
          <input id="movie-title" type="text" name="movie-title" value="<?php echo($title); ?>" class="form-control form-control-sm" readonly>
        </div>

        <div class="g-recaptcha" data-sitekey="6LeAoTwUAAAAAJJxvbb1K0cezLGZvbTZwX_41jXt"></div>

        <input class="btn btn-primary btn-block" type="submit" value="Submit Report">
      </form>
    </div>

    <script lang="jquery">
      $(function() {
        $('.scroll-pane').jScrollPane();
      });
    </script>

  </body>

</html>
