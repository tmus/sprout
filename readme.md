# Sprout

Make your Laravel seeds meaningful.

## Usage

1. Pull in the package with composer:

```shell
composer require tommus/sprout
```

Laravel will automatically discover the Sprout Service Provider, meaning you
don't need to manually add it.

2. Publish the Sprout vendor files:

```shell
php artisan vendor:publish --tag=sprout
```

3. Create a new Sprout:

```shell
php artisan sprout:make Example
```

This will make a new Sprout at `App/Sprouts/Example.php`. In the `run()`
method, you can add any factories or calls you'd like.

4. Add the Sprout to `config/sprout.php`:

```php
return [
  'list' => [
    \App\Sprouts\Example::class,
  ],
];
```

5. Run the Sprout:

```shell
php artisan sprout:run
```

This allows you to choose a Sprout to run from the list defined in the
Sprout config.
