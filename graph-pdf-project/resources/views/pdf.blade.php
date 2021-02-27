<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>PDF</title>
  <style>
    html {
      margin: 0;
    }

    body {
      margin: 0;
      font-family: ipag;
    }
  </style>
</head>

<body>
  <h1>Hello World!!</h1>
  <p>{{ $post_data['text'] }}</p>
  <img src="data:image/jpeg;base64,{{ $graph }}" alt="">
</body>

</html>