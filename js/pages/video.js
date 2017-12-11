function download(url) {
  var key = url.split("/")[4];
  var downloadUrl = "https://openload.co/f/" + key;
  window.open(downloadUrl);
}

function subtitles(movie_title) {
  var url = "https://subscene.com/subtitles/title?q=";
  movie_title = movie_title.replace(" ", "+");
  window.open(url + movie_title);
}
