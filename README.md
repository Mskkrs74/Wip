# Wip-Where is a parking?
PHP自作

## 概要
駐車場検索アプリ（関東の観光地用）を作成しました。<br>
ゲスト、ユーザー、管理者に分けています。<br>

## 使い方
Google Maps APIキーを取得します。<br>
プロジェクトを以下のリンクからAPIキーを取得します。<br>
[https://console.cloud.google.com/?hl=ja](https://console.cloud.google.com/?hl=ja)<br>
以下のapiを有効にしてください。<br>
- Distance Matrix API<br>
* Geocoding API<br>
+ Geolocation API<br>
- Maps JavaScript API<br>

 
プロジェクト直下の.env.exampleファイルをご自身の環境に合わせて編集し、ファイル名を.envに変更してください。<br>
また、GOOGLE_MAP_API=には先ほど取得したapiキーを取得し入力してください。


管理者<br>
ユーザー一覧の表示、ユーザーの削除、駐車場一覧の表示、駐車場追加、駐車場編集、駐車場削除ができます。<br>

テストアカウント<br>
メールアドレス kanri@gmail.com<br>
パスワード     KanriKanri001<br>

ユーザー<br>
ユーザー（アカウント）削除、駐車場検索、駐車場追加、駐車場編集、駐車場のお気に入り登録ができます。<br>

テストアカウント<br>
メールアドレス user001@gmail.com<br>
パスワード     UserUser001<br>

ゲスト<br>
駐車場検索ができます。<br>

## 環境
XAMPP/MySQL/PHP/jQuery<br>

## データベース
データベース名：wip<br>

テーブル

お使いのphpMyAdminに上のデータベースを作り、入っているDB.sqlをインポートしていただければお使いいただけるようになると思います。
