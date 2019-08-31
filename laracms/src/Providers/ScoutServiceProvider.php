<?php
namespace Wanglelecc\Laracms\Providers;

use TeamTNT\TNTSearch\TNTSearch;
use Laravel\Scout\EngineManager;
use TeamTNT\Scout\Console\ImportCommand;
use TeamTNT\Scout\Engines\TNTSearchEngine;
use TeamTNT\Scout\TNTSearchScoutServiceProvider;
use Wanglelecc\Laracms\Handlers\TokenizerHandler;

class ScoutServiceProvider extends TNTSearchScoutServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->app[EngineManager::class]->extend('tntsearch', function ($app) {
//            $tnt = new TNTSearch();
//
//            $driver = config('database.default');
//            $config = config('scout.tntsearch') + config("database.connections.{$driver}");
//
//            $tnt->loadConfig($config);
////            $tnt->setTokenizer(new TokenizerHandler(config('scout.tntsearch.tokenizer.jieba')));
//            $tnt->setDatabaseHandle(app('db')->connection()->getPdo());
//
//
//            $this->setFuzziness($tnt);
//            $this->setAsYouType($tnt);
//
//            return new TNTSearchEngine($tnt);
//        });
//
//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                ImportCommand::class,
//            ]);
//        }
    }

    
}
