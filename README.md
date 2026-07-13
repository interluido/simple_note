# ひとこと日記

Laravelを用いて学習用に開発した、一行日記のWebアプリ。  
日記ごとに画像アップロードやイメージカラー設定が可能。

### スクリーンショット

|<img src="https://github.com/user-attachments/assets/112d2d40-d67a-4b2c-9e7f-c06345606962" alt="top" width="768" height="435" style="border: 1px solid;">
|:-:|

|<img src="https://github.com/user-attachments/assets/a3d330c2-7d02-4dde-8990-49a888fa1b2b" alt="list" width="768" height="435" style="border: 1px solid;">
|:-:|

|<img src="https://github.com/user-attachments/assets/2286c4a1-d47d-4049-85d4-50cacaa3e3e0" alt="preview" width="768" height="435" style="border: 1px solid;">
|:-:|

### 機能

- ログイン、アカウント管理
- 日記
    - 追加、編集、削除
    - 一覧表示、検索、ページネーション
    - 画像アップロード
    - 日記のイメージカラー選択

### 環境

| Software       | Version |
| -------------- | ------- |
| Laravel        | 13.18.1 |
| PHP            | 8.5.8   |
| MySQL          | 8.4     |
| Composer       | 2.10.2  |
| Node.js        | 24.18.0 |
| npm            | 11.18.0 |
| Laravel Sail   | 1.63.0  |
| Laravel Breeze | 2.4.2   |
| Tailwind CSS   | 3.4.19  |
| Vite           | 8.1.3   |

### セットアップ

- プロジェクトのクローン  
   `git clone git@github.com:interluido/simple_note.git`

- パスの移動  
   `cd simple_note`

- .envファイルの作成と変更  
   `cp .env.example .env`

.envファイルを以下の内容に変更

```
APP_LOCALE=ja
APP_FAKER_LOCALE=ja_JP

PHP_CLI_SERVER_WORKERS=4

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

- パッケージのインストール  
  `composer install`

- コンテナ起動  
  `./vendor/bin/sail up -d`

- APP_KEYの生成  
  `./vendor/bin/sail artisan key:generate`

- DBのマイグレーション、テストデータの追加  
  `./vendor/bin/sail php artisan migrate --seed`

- フロントエンドパッケージのインストール、ビルド  
  `./vendor/bin/sail npm install`  
  `./vendor/bin/sail npm run build`

- ストレージディレクトリのリンク  
  `./vendor/bin/sail artisan storage:link`

- ローカル環境での起動  
  以下にアクセス  
  `http://localhost/`


### 補足事項

- 認証はLaravel Breezeを利用。
- メーラー設定については未実装。

### 参考資料等

- Laravelの教科書 [バージョン10対応 初版]
- 使用素材：[Photock](https://photock.jp/)
