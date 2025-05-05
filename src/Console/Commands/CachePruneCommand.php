<?php

namespace EncoreDigitalGroup\LaravelCachePrune\Console\Commands;

use Illuminate\Cache\DatabaseStore;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CachePruneCommand extends Command
{
    protected $signature = "cache:prune";
    protected $description = "Prune expired cache entries from the database cache store";

    public function handle(): void
    {
        $cache = Cache::getStore();

        if (!$cache instanceof DatabaseStore) {
            throw new RuntimeException("The cache:prune command only supports the DatabaseStore driver.");
        }

        $table = Config::get("cache.stores.database.table", "cache");

        $deleted = DB::table($table)
            ->where("expiration", "<=", Carbon::now()->getTimestamp())
            ->delete();

        $this->info("Successfully pruned {$deleted} expired cache entries from the database.");
    }
}