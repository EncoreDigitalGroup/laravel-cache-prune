# EncoreDigitalGroup/LaravelCachePrune

### Overview

This is a very simple package. It provides a singular command `cache:prune`. This command mimics the `cache:clear` command's functionality with one
slight difference; it only works on expired cache items in the `DatabaseStore`. If this command is used on any other cache driver, it will throw a
`RuntimeException`.

### Installation

Run `composer require encoredigitalgroup/laravel-cache-prune`. There is no need to do anything else; this package will automatically register the command
from its Service Provider.

### Why?

When using the database store in Laravel, when a cache item expires, it is not automatically removed from the cache table. Instead it stays there forever,
or until that same cache key is reused with a new value. Running this command will clean up any lingering database rows in the cache table.

### Usage

Simply run `php artisan cache:prune` from your terminal and let this command cleanup your cache table. You can also add this to you `routes/console.php`
to run this on a set schedule:

```php

use EncoreDigitalGroup\LaravelCachePrune\Console\Commands\CachePruneCommand;use Illuminate\Support\Facades\Schedule;

Schedule::command("cache:prune")->daily(); // Or any other interval you prefer.

//OR

Schedule::command(CachePruneCommand::class)->daily(); // Or any other interval you prefer.

```