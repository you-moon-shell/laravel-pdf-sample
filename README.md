### <ホスト OS 上>

`mkdir [dir]`

`cd [dir]`

`git clone git@github.com:you-moon-shell/laravel-graph-pdf-sample.git .`

以下よりフォントの zip ファイルを取得(ここから zip ファイルをダウンロードしないと identifier ファイルが生成されない)

http://moji.or.jp/wp-content/ipafont/IPAfont/IPAfont00303.zip

zip ファイル内の\*.ttf ファイルを./graph-pdf-project/storage/fonts 配下に配置

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

- ※input にいれた日本語が PDF 上で化けてしまっているのは開発途中のため気にしないでください。。。
