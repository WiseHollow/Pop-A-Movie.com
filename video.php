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
          Title
        </span>
      </ul>

      <div class="tab-content card-block" align="center">
        <div class="tab-pane active" id="home" role="tabpanel">
          <img class="video-thumbnail-large" src="http://via.placeholder.com/1280x720">
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
              <h3>483 Views</h3>
            </div>
            <div class="col-2">
              <i class="fa fa-thumbs-up fa-2x align-top" aria-hidden="true"><span style="font-size: 32px;"> 63 </span></i> &nbsp;
              <i class="fa fa-thumbs-down fa-2x align-top" aria-hidden="true"><span style="font-size: 32px;"> 1 </span></i>
            </div>
            <div class="col-8">
              <i class="fa fa-share-square-o fa-2x" aria-hidden="true">Share</i>
            </div>
          </div>
          <div class="row video-description">
            <p class="card-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis lacus enim, in rutrum nulla pretium ut. Praesent laoreet hendrerit dolor. Maecenas volutpat convallis tristique. Mauris mauris augue, sollicitudin sed porttitor quis, mollis
              porta quam. Nullam vel rutrum elit. Morbi feugiat sit amet arcu id posuere. Nullam rhoncus justo nec metus posuere facilisis sed eget elit. Curabitur porta, tellus eget aliquet sollicitudin, purus nulla molestie est, ac egestas nunc augue
              id est. Pellentesque mollis ex eu neque accumsan, quis vehicula tellus placerat. Nunc nec orci vel urna sodales ornare id vitae neque. Aenean felis libero, ornare sit amet porta et, fringilla quis eros. Nunc ut suscipit nibh.</p>
            <p class="card-text">
              In dignissim, nisi in pharetra tincidunt, diam nisl imperdiet elit, ut placerat metus sapien laoreet augue. Nunc varius urna quis lectus rhoncus, eu ullamcorper ex congue. In commodo, nulla et pulvinar euismod, est massa consequat erat, id venenatis nisl
              velit in nulla. Vivamus mi neque, accumsan cursus est quis, placerat ornare massa. Praesent quis erat sed eros gravida mattis. Ut sed tortor pharetra, cursus massa in, euismod enim. Curabitur bibendum sodales quam ut efficitur. Duis sit
              amet est sodales lorem aliquet maximus. Curabitur lacinia metus nec erat imperdiet, et lacinia enim maximus. Morbi velit eros, luctus ut viverra vitae, viverra id magna. Etiam at mi consectetur diam blandit luctus. In quis malesuada quam.
              Maecenas enim nibh, finibus sit amet eleifend a, condimentum eget sapien. Nulla posuere urna sit amet rhoncus lacinia. Sed consequat ante nisi, nec posuere odio maximus ac. Vestibulum id molestie lacus.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Related videos -->
    <div class="card bg-inverse text-white">
      <ul class="nav nav-tabs" role="tablist">
        <span class="card-title align-middle">
          Related Movies & Shows &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content card-block" align="center">
        <div class="tab-pane active" id="home" role="tabpanel">
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
          <a href="#"><img class="video-thumbnail-large" src="http://via.placeholder.com/200x200"></a>
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