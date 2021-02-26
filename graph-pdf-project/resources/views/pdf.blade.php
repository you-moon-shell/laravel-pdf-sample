<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>PDF</title>
  <style>
    @font-face {
      font-family: ipagp;
      font-style: normal;
      font-weight: normal;
      src:url("{{ storage_path('fonts/ipagp.ttf')}}");
    }

    html {
      margin: 0;
    }

    body {
      margin: 0;
      font-family: ipagp;
    }
  </style>
</head>

<body>
  <h1>Hello World!!</h1>
  <p>{{ $post_data['text'] }}</p>
  <img src="data:image/jpeg;base64,{{ $graph }}" alt="">
</body>

</html>