<html>
  <head>
    <title>Books API Example</title>
  </head>
  <body>
    <nav>
      <a href="/">Home</a>
      <a href="map">Map</a>
      <a href="youtube">Youtube</a>
      <a href="books">Books</a>
      <a href="fonts">Fonts</a>
    </nav>
    <div id="content"></div>
    <script>
      function handleResponse(response) {
      for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
        // in production code, item.text should have the HTML entities escaped.
        document.getElementById("content").innerHTML += "<br>" + item.volumeInfo.title;
      }
    }
    </script>
    <script src="https://www.googleapis.com/books/v1/volumes?q=harry+potter&callback=handleResponse"></script>
  </body>
</html>