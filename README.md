### ホスト OS

`mkdir [dir]`

`cd [dir]`

`git clone git@github.com:you-moon-shell/laravel-graph-pdf-sample.git .`

vscode より [dir] を開く

「ms-vscode-remote.remote-containers」拡張をインストール

コマンドパレットより「Remonote-Containers: Open Folder in Container…」を選択

### Docker Container

`cd graph-pdf-project/`

`composer install`

`php artisan serve`

これで laravel の welcome 画面が出る

- 「localhost:8000/export」にアクセスすると pdf 出力ページに飛ぶ

- 「app/Http/Controllers/PDFController.php」にグラフ生成ロジックを配置
