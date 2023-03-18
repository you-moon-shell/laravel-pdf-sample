### <ホスト OS 上>

`mkdir [dir]`

`cd [dir]`

`git clone git@github.com:you-moon-shell/laravel-graph-pdf-sample.git .`

vscode より [dir] を開く

「ms-vscode-remote.remote-containers」拡張をインストール

コマンドパレットより「Remonote-Containers: Open Folder in Container…」を選択

### <ここから container 内>

`cd graph-pdf-project/`

`composer install`

`php artisan serve`

これで laravel の welcome 画面がでるはずです。

- 「localhost:8000/export」にアクセスすると pdf 出力ページに飛びます。

- 「app/Http/Controllers/PDFController.php」にグラフ生成ロジックがあります。
