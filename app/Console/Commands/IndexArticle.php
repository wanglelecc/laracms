<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TeamTNT\TNTSearch\TNTSearch;
use App\Models\Article;
use App\Handlers\TokenizerHandler;

class IndexArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index the article table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Article $article)
    {
        $driver = config('database.default');
        $connections = config("database.connections.$driver");
        $prefix = $connections['prefix'];
        $config = config('scout.tntsearch') + $connections;
        $table = $prefix.$article->getTable();

        $tnt = new TNTSearch;
        $tnt->loadConfig($config);
        $tnt->setTokenizer(new TokenizerHandler(config('scout.tntsearch.tokenizer.jieba')));
        $tnt->setDatabaseHandle(app('db')->connection()->getPdo());

        $indexer = $tnt->createIndex('articles.index');
        $indexer->query("SELECT id, alias, title, subtitle, keywords, description, author, content FROM {$table}");
//        $indexer->setLanguage('no');
        $indexer->run();
    }
}
