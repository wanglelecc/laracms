<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace Wanglelecc\Laracms\Console\Commands;

use Illuminate\Console\Command;
use Wanglelecc\Laracms\Models\Block;

/**
 * 将区块同步到数据库
 *
 * Class SyncBlock
 * @package Wanglelecc\Laracms\Console\Commands
 */
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

    /**
     * 同步区块
     *
     * @param $block
     * @return bool
     */
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

    /**
     * 示例调用其它命令
     */
    public function demo(){
        $this->call('email:send', [
            'user' => 1, '--queue' => 'default'
        ]);
    }
}
