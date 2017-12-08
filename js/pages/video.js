function download(url) {
  var key = url.split("/")[4];
  var downloadUrl = "https://openload.co/f/" + key;
  window.open(downloadUrl);
}

function subtitles(url) {
  window.open(url);
}
