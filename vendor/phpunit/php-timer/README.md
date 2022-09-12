<<<<<<< HEAD
[![Build Status](https://travis-ci.org/sebastianbergmann/php-timer.svg?branch=master)](https://travis-ci.org/sebastianbergmann/php-timer)

# PHP_Timer
=======
# phpunit/php-timer

[![CI Status](https://github.com/sebastianbergmann/php-timer/workflows/CI/badge.svg)](https://github.com/sebastianbergmann/php-timer/actions)
[![Type Coverage](https://shepherd.dev/github/sebastianbergmann/php-timer/coverage.svg)](https://shepherd.dev/github/sebastianbergmann/php-timer)
>>>>>>> update

Utility class for timing things, factored out of PHPUnit into a stand-alone component.

## Installation

<<<<<<< HEAD
To add this package as a local, per-project dependency to your project, simply add a dependency on `phpunit/php-timer` to your project's `composer.json` file. Here is a minimal example of a `composer.json` file that just defines a dependency on PHP_Timer:

    {
        "require": {
            "phpunit/php-timer": "~1.0"
        }
    }
=======
You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require phpunit/php-timer
```

If you only need this library during development, for instance to run your project's test suite, then you should add it as a development-time dependency:

```
composer require --dev phpunit/php-timer
```
>>>>>>> update

## Usage

### Basic Timing

```php
<<<<<<< HEAD
PHP_Timer::start();

$timer->start();

// ...

$time = PHP_Timer::stop();
var_dump($time);

print PHP_Timer::secondsToTimeString($time);
=======
require __DIR__ . '/vendor/autoload.php';

use SebastianBergmann\Timer\Timer;

$timer = new Timer;

$timer->start();

foreach (\range(0, 100000) as $i) {
    // ...
}

$duration = $timer->stop();

var_dump(get_class($duration));
var_dump($duration->asString());
var_dump($duration->asSeconds());
var_dump($duration->asMilliseconds());
var_dump($duration->asMicroseconds());
var_dump($duration->asNanoseconds());
>>>>>>> update
```

The code above yields the output below:

<<<<<<< HEAD
    double(1.0967254638672E-5)
    0 ms

### Resource Consumption Since PHP Startup

```php
print PHP_Timer::resourceUsage();
=======
```
string(32) "SebastianBergmann\Timer\Duration"
string(9) "00:00.002"
float(0.002851062)
float(2.851062)
float(2851.062)
int(2851062)
```

### Resource Consumption

#### Explicit duration

```php
require __DIR__ . '/vendor/autoload.php';

use SebastianBergmann\Timer\ResourceUsageFormatter;
use SebastianBergmann\Timer\Timer;

$timer = new Timer;
$timer->start();

foreach (\range(0, 100000) as $i) {
    // ...
}

print (new ResourceUsageFormatter)->resourceUsage($timer->stop());
>>>>>>> update
```

The code above yields the output below:

<<<<<<< HEAD
    Time: 0 ms, Memory: 0.50MB
=======
```
Time: 00:00.002, Memory: 6.00 MB
```

#### Duration since PHP Startup (using unreliable `$_SERVER['REQUEST_TIME_FLOAT']`)

```php
require __DIR__ . '/vendor/autoload.php';

use SebastianBergmann\Timer\ResourceUsageFormatter;

foreach (\range(0, 100000) as $i) {
    // ...
}

print (new ResourceUsageFormatter)->resourceUsageSinceStartOfRequest();
```

The code above yields the output below:

```
Time: 00:00.002, Memory: 6.00 MB
```
>>>>>>> update
