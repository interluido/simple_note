# ひとこと日記

Laravelを用いて開発した、一行日記のWebアプリです。
日記ごとに画像アップロードやイメージカラー設定が可能です。

### スクリーンショット

|<img src="https://private-user-images.githubusercontent.com/299044717/619401976-112d2d40-d67a-4b2c-9e7f-c06345606962.png?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3ODM1OTUzOTksIm5iZiI6MTc4MzU5NTA5OSwicGF0aCI6Ii8yOTkwNDQ3MTcvNjE5NDAxOTc2LTExMmQyZDQwLWQ2N2EtNGIyYy05ZTdmLWMwNjM0NTYwNjk2Mi5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjYwNzA5JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI2MDcwOVQxMTA0NTlaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT0zNjQ3YjBlZGFiMjA3ZjBiOWFjYWE2YWU5ODMzYzkzZWJiMmVlOGZjMjZlZWFjMWEwMmI4MTM2ZThlZTMzZTQ3JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZyZXNwb25zZS1jb250ZW50LXR5cGU9aW1hZ2UlMkZwbmcifQ.stawG3SMaUVlBBaMvjtG1OjtWvrZFKBIcsbTUpca_TI" alt="top" width="768" height="435" style="border: 1px solid;">
|:-:|

|<img src="https://private-user-images.githubusercontent.com/299044717/619402011-a3d330c2-7d02-4dde-8990-49a888fa1b2b.png?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3ODM1OTU2NDcsIm5iZiI6MTc4MzU5NTM0NywicGF0aCI6Ii8yOTkwNDQ3MTcvNjE5NDAyMDExLWEzZDMzMGMyLTdkMDItNGRkZS04OTkwLTQ5YTg4OGZhMWIyYi5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjYwNzA5JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI2MDcwOVQxMTA5MDdaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT0yMTZjMjA4ZGVhMGEzMWZkZTYyNWU4NWVjNmEwNDIwMDZjYzAyZTYyYWExMDNkMDhiZGFhZDNmZTRkNjU3MTQ1JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZyZXNwb25zZS1jb250ZW50LXR5cGU9aW1hZ2UlMkZwbmcifQ.NAXvn1T6c2Hoi_4BqihL7tomoktco09uvhUseWLNYTg" alt="list" width="768" height="435" style="border: 1px solid;">
|:-:|

|<img src="https://private-user-images.githubusercontent.com/299044717/619402038-2286c4a1-d47d-4049-85d4-50cacaa3e3e0.png?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3ODM1OTU2NDcsIm5iZiI6MTc4MzU5NTM0NywicGF0aCI6Ii8yOTkwNDQ3MTcvNjE5NDAyMDM4LTIyODZjNGExLWQ0N2QtNDA0OS04NWQ0LTUwY2FjYWEzZTNlMC5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjYwNzA5JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI2MDcwOVQxMTA5MDdaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1mNWMzYzE5MjJiNDgzNTQ1OTQ2NmVjZjI5ZWJhZTFjZmMyZjNjMzY3ZDk3YWFjYWJjNzI5MjJlYjk3NjFiZjk5JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZyZXNwb25zZS1jb250ZW50LXR5cGU9aW1hZ2UlMkZwbmcifQ.GizIyYsrlVbev7mO5PL10eWsWI8qDfANeMj9c1yg2NQ" alt="preview" width="768" height="435" style="border: 1px solid;">
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

### テストユーザー

| メールアドレス   | パスワード |
| ---------------- | ---------- |
| test@example.com | 1qaz2wsx   |

### 開発時に意識した点

- シンプルで直感的に操作できるUIを目指しました。
- 日記ごとにイメージカラーを設定できるようにし、一覧画面でも識別しやすくしました。
- 一覧画面はカード形式を採用し、画像付きでも見やすいレイアウトにしました。
- スマートフォンでも利用しやすいよう、レスポンシブ対応を行いました。

### 補足事項

- 認証はLaravel Breezeを利用しております。
- メーラー設定については未実装となります。
    - パスワードリセット等のメール送信時の本文は `storage/logs/laravel.log` にてご確認いただけます。

### 参考資料等

- Laravelの教科書 [バージョン10対応 初版]
- 使用素材：[Photock](https://photock.jp/)
