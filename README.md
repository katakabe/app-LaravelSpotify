# 開発環境

- Laravel 8.29.0
- PHP 7.3.25
- MySQL 8.0.16

## ルーティング

- http://localhost/

## 開発メモ

### 認証機能作成

```sh
composer require laravel/ui
```

```sh
npm i
npm i vue bootstrap
php artisan ui vue --auth
php artisan migrate
npm run dev
```

こけたら `node_modules` と `package-lock.json` を削除して `npm i` からやり直す

### Guzzle HTTP

```sh
composer require guzzlehttp/guzzle
```

### Spotify Web API PHP

```sh
composer require jwilsson/spotify-web-api-php
```

### laravel-enum

- https://github.com/BenSampo/laravel-enum

```sh
composer require bensampo/laravel-enum
```

### LaravelCollective

- https://github.com/LaravelCollective/docs

```sh
composer require "laravelcollective/html"
```
