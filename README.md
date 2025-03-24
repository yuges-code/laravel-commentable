<div align="center">
    <img src="https://raw.githubusercontent.com/yuges-code/laravel-commentable/master/assets/logo.png">
</div>

<div align="center">
    <b>Build<b>
    <div>
        <img
            alt="GitHub Branch Check Runs"
            src="https://img.shields.io/github/check-runs/yuges-code/laravel-commentable/main"
        >
        <img
            alt="GitHub Tests Action Status"
            src="https://img.shields.io/github/actions/workflow/status/yuges-code/laravel-commentable/testing.yml?branch=main&label=tests&style=flat-square"
        >
    </div>
</div>

<div align="center">
    <b>Project</b>
    <div>
        <img alt="GitHub Release" src="https://img.shields.io/github/v/release/yuges-code/laravel-commentable">
        <img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/yuges-code/laravel-commentable">
        <img alt="GitHub License" src="https://img.shields.io/github/license/yuges-code/laravel-commentable">
        <img alt="Packagist Stars" src="https://img.shields.io/packagist/stars/yuges-code/laravel-commentable">
        <img
            alt="Packagist Dependency Version"
            src="https://img.shields.io/packagist/dependency-v/yuges-code/laravel-commentable/php"
        >
    </div>
</div>

<div align="center">
    <b>Quality</b>
</div>

<div align="center">
    <h1>Laravel Commentable</h1>
</div>

<div align="center">
    <h3>🗯️ Package for easily attaching comments to Laravel eloquent models</h3>
</div>

<br>

# 💿 Installation

### → Composer

You can install the package via composer:

```
composer require yuges-code/laravel-commentable
```

### → Publishing Config

Publishing the config file (config/commentable.php) is optional:

```
php artisan vendor:publish --provider="Yuges\Commentable\Providers\CommentableServiceProvider" --tag="commentable-config"
```

### → Publishing Migrations

You need to publish the migration to create the comments table:

```
php artisan vendor:publish --provider="Yuges\Commentable\Providers\CommentableServiceProvider" --tag="commentable-migrations"
```

### → Running Migrations

After that, you need to run migrations:

```
php artisan migrate
```

<br>

# 🧪 Running Tests

### → PHPUnit tests

To run tests, run the following command:

```
composer test
```

<br>

# ⚖️ License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

<br>

# 🙆🏼‍♂️ Authors Information

Created in 2025 by:

- [Yuges-code](https://github.com/yuges-code)
- [All Contributors](../../contributors)
