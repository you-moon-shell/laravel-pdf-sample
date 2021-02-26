<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDFExport</title>
</head>

<body>
  <h1> {{ $message }} </h1>

  <form action="{{ route('post.pdf') }}" method="POST">
    {{ csrf_field() }}
    <div>
      <input type="text" name="text">
    </div>
    <div>
      <button>PDFダウンロード</button>
    </div>
  </form>
</body>

</html>