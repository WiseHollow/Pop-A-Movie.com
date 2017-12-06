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
    <link href="/css/pages/search.css" rel="stylesheet">
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

          <h3>Results for: QUERY HERE</h3>
          <figure class="figure">
            <a href="#"><img src="http://via.placeholder.com/150x150" class="figure-img img-fluid rounded" alt="Movie Title 1"></a>
            <figcaption class="figure-caption title"><a href="#">Movie Title 1</a></figcaption>
            <figcaption class="figure-caption">
              <a href="#">Drama</a>,
              <a href="#">Romance</a>,
              <a href="#">Asian</a>
            </figcaption>
            <figcaption class="figure-caption">
              <a href="#">korean drama</a>,
              <a href="#">k-drama</a>
            </figcaption>
          </figure>

          <figure class="figure">
            <a href="#"><img src="http://via.placeholder.com/150x150" class="figure-img img-fluid rounded" alt="Movie Title 2"></a>
            <figcaption class="figure-caption title"><a href="#">Movie Title 2</a></figcaption>
            <figcaption class="figure-caption">
              <a href="#">Drama</a>,
              <a href="#">Romance</a>,
              <a href="#">Asian</a>
            </figcaption>
            <figcaption class="figure-caption">
              <a href="#">korean drama</a>,
              <a href="#">k-drama</a>
            </figcaption>
          </figure>

          <figure class="figure">
            <a href="#"><img src="http://via.placeholder.com/150x150" class="figure-img img-fluid rounded" alt="Movie Title 3"></a>
            <figcaption class="figure-caption title"><a href="#">Movie Title 3</a></figcaption>
            <figcaption class="figure-caption">
              <a href="#">Drama</a>,
              <a href="#">Romance</a>,
              <a href="#">Asian</a>
            </figcaption>
            <figcaption class="figure-caption">
              <a href="#">korean drama</a>,
              <a href="#">k-drama</a>
            </figcaption>
          </figure>

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
