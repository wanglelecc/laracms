<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Block;

class SyncBlock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laracms:sync-block';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'synchronous block structure...';

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
    public function handle()
    {
        $blocks = config('blocks.structure');
        foreach($blocks as $block){
            $this->synchronousBlock($block);
        }
        $this->info("Block structure Synchronization completed.");
    }

    // 同步区块

    public function synchronousBlock($block){
        if( Block::where('object_id', $block['object_id'])->first() ){
            return false;
        }
        if(Block::create($block)){
            $this->info("Block {$block['object_id']} Synchronization Success!");
        }else{
            $this->info("Block {$block['object_id']} Synchronization Failed!");
        }
    }

    // 示例调用其它命令
    public function demo(){
        $this->call('email:send', [
            'user' => 1, '--queue' => 'default'
        ]);
    }
}
