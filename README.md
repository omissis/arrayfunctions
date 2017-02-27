# ArrayFunctions

PHP Utilities to operate on arrays.

```php
use Omissis\ArrayFunctions;
use function Omissis\ArrayFunctions\get as array_get;
use function Omissis\ArrayFunctions\set as array_set;

// Retrieve a value by its key, optionally returning a default if the value is not found.
// $key can be a string or an array representing the path to the key you are interested into.
ArrayFunctions\get($array, $key, $default);

// Alternatively, use the function alias
array_get($array, $key, $default);

// Set the value of a key, returning the previous value if it was set.
// $key can be a string or an array representing the path to the key you are interested into.
ArrayFunctions\set($array, $key, $value)

// Alternatively, use the function alias
array_set($array, $key, $value);
```

## Installation

You can install ArrayFunctions with Composer:

```
composer require omissis/arrayfunctions
```

Run `composer install` or `composer update` and you're ready to start.
