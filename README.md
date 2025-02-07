# Laravel-commentable
Package for easily attaching comments to Laravel eloquent models

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
