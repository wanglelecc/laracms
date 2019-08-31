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

namespace Wanglelecc\Laracms\Jobs;

use DB;
use Vod\Request\V20170321 as Vod;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetVodCoverURL implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 5;

    /**
     * 超时时间。
     *
     * @var int
     */
    public $timeout = 30;

    protected $count = 0;

    protected $article_id;

    protected $attribute;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article_id, $attribute, $count = 0)
    {
        $this->article_id   = $article_id;
        $this->attribute    = $attribute;
        $this->count        = $count;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $vodRequest = new Vod\GetVideoInfoRequest();
            $vodRequest->setVideoId($this->attribute['video_id']);
            $vodRequest->setAcceptFormat('JSON');

            $response = get_aliyun_acs_clent()->getAcsResponse($vodRequest);

            if($response && isset($response->Video->CoverURL)){
                $this->attribute['video_thumb'] = $response->Video->CoverURL;
                DB::table('articles')->where('id', $this->article_id)->update(['attribute' => json_encode($this->attribute, true)]);
            }else{
                // 如果没有获取到，则再次投递异步任务, 最多投递三次, 每次三倍延迟
                if( 3 > $this->count ){
                    GetVodCoverURL::dispatch($this->article_id, $this->attribute, ++$this->count)->delay(now()->addMinutes($this->count * 3));
                }
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
