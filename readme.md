# Sprout

Grow your Laravel seeders.

Sprout allows you to write more modular, reuseable seeders for specific scenarios
in your app.

For example, creating a "full event" by creating an event and ten
bookings. Or, creating an "empty event" by creating just an event.

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

You can call another Sprout by using `$this->call(Sprout::class)` from
within the called Sprout. This happens recursively.

Optionally, you can add a `beforeRun()` and `afterRun()` method to a
Sprout to build up and tear down specific config.

You can add a `protected $description = 'Custom Title';` to a Sprout.

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
