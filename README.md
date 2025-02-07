# Laravel-commentable
Package for easily attaching comments to Laravel eloquent models

![GitHub Release](https://img.shields.io/github/v/release/yuges-code/laravel-commentable)
![Packagist Downloads](https://img.shields.io/packagist/dt/yuges-code/laravel-commentable)
![GitHub License](https://img.shields.io/github/license/yuges-code/laravel-commentable)
![Packagist Stars](https://img.shields.io/packagist/stars/yuges-code/laravel-commentable)

## Installation

### Preparing the database
You need to publish the migration to create the comments table:

```
php artisan vendor:publish --provider="Yuges\Commentable\Providers\CommentableServiceProvider" --tag="commentable-migrations"
```

After that, you need to run migrations.

```
php artisan migrate
```

### Publishing the config file
Publishing the config file (`config/commentable.php`) is optional:

```
php artisan vendor:publish --provider="Yuges\Commentable\Providers\CommentableServiceProvider" --tag="commentable-config"
```
