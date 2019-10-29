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

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Wanglelecc\Laracms\Models\File;
use Wanglelecc\Laracms\Models\Slide;
use Wanglelecc\Laracms\Models\Block;
use Wanglelecc\Laracms\Models\User;


class SeedSlideAndBlockAndFilesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        File::create(['id' => 1, 'type' => 'image', 'path' => 'images/slide/201803/03/538aFhREvHFKgq5AkWRSvNyFzT3FzgvVemW6yXkD.jpeg', 'mime_type' => 'image/jpeg', 'md5' => '9d9ce9a512a9555f386e0a0f40a30fa0', 'title'=>'222.jpg', 'folder'=>'slide', 'object_id' => 1, 'size'=>116659, 'width'=>1000, 'height'=> 332, 'downloads'=> 0, 'public'=>'1','editor'=>'0','status'=>'0','created_op'=>1]);
        File::create(['id' => 2, 'type' => 'image', 'path' => 'images/slide/201803/03/jKwPxbEU4lo5ZySz887QOSZCzu4P3OKPNM9TZ4X2.jpeg', 'mime_type' => 'image/jpeg', 'md5' => 'cb3519d3b1b16415ac167e3b3df6426c', 'title'=>'333.jpg', 'folder'=>'slide', 'object_id' => 1, 'size'=>105233, 'width'=>1000, 'height'=> 332, 'downloads'=> 0, 'public'=>'1','editor'=>'0','status'=>'0','created_op'=>1]);
        File::create(['id' => 3, 'type' => 'image', 'path' => 'images/slide/201803/03/GrEN5y7OH8Ps1FM3lDzGFMe2P1aP5pMgPRnd62aT.jpeg', 'mime_type' => 'image/jpeg', 'md5' => 'b843de23efe8a64b6c6a643174632413', 'title'=>'555.jpg', 'folder'=>'slide', 'object_id' => 1, 'size'=>94325, 'width'=>1000, 'height'=> 332, 'downloads'=> 0, 'public'=>'1','editor'=>'0','status'=>'0','created_op'=>1]);
        File::create(['id' => 4, 'type' => 'image', 'path' => 'images/slide/201803/03/yq9VLRIKJty8orH8Vq7CO8D5WhRZx1h6OJqVDyPb.jpeg', 'mime_type' => 'image/jpeg', 'md5' => 'a7016cb9c662784e86428bd1ebc79172', 'title'=>'444.jpg', 'folder'=>'slide', 'object_id' => 1, 'size'=>81432, 'width'=>1000, 'height'=> 332, 'downloads'=> 0, 'public'=>'1','editor'=>'0','status'=>'0','created_op'=>1]);
        File::create(['id' => 5, 'type' => 'image', 'path' => 'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg', 'mime_type' => 'image/jpeg', 'md5' => '21463f816eb9b8595bfec72d720b6823', 'title'=>'20180106112335.jpg', 'folder'=>'avatar', 'object_id' => 1, 'size'=>14353, 'width'=>300, 'height'=> 330, 'downloads'=> 0, 'public'=>'1','editor'=>'0','status'=>'0','created_op'=>1]);

        Slide::create(['id' => 1, 'object_id' => '1593925271911899', 'group' => 1, 'title' => '1111', 'description' => '', 'target'=>'_self', 'link'=>'https://www.baidu.com/', 'image'=>'images/slide/201803/03/538aFhREvHFKgq5AkWRSvNyFzT3FzgvVemW6yXkD.jpeg', 'order'=>9999, 'status'=>1 ]);
        Slide::create(['id' => 2, 'object_id' => '1593925329620945', 'group' => 1, 'title' => '2222', 'description' => '', 'target'=>'_self', 'link'=>'https://www.baidu.com/', 'image'=>'images/slide/201803/03/jKwPxbEU4lo5ZySz887QOSZCzu4P3OKPNM9TZ4X2.jpeg', 'order'=>9999, 'status'=>1 ]);
        Slide::create(['id' => 3, 'object_id' => '1593925368321300', 'group' => 1, 'title' => '3333', 'description' => '', 'target'=>'_self', 'link'=>'https://www.baidu.com/', 'image'=>'images/slide/201803/03/GrEN5y7OH8Ps1FM3lDzGFMe2P1aP5pMgPRnd62aT.jpeg', 'order'=>9999, 'status'=>1 ]);
        Slide::create(['id' => 4, 'object_id' => '1593925415909278', 'group' => 1, 'title' => '4444', 'description' => '', 'target'=>'_self', 'link'=>'https://www.baidu.com/', 'image'=>'images/slide/201803/03/yq9VLRIKJty8orH8Vq7CO8D5WhRZx1h6OJqVDyPb.jpeg', 'order'=>9999, 'status'=>1 ]);

        Block::create(['id' => 1, 'object_id' => '2018_03_04_224524_index_slide_block', 'group' => 0, 'type' => 'slide', 'template' => 'default', 'title' => '首页幻灯',  'created_op'=>1, 'updated_op'=>1, 'content'=>'{"mark":"1"}',]);
        Block::create(['id' => 2, 'object_id' => '2018_03_04_234810_index_enterprise_news_block', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '企业新闻', 'more_title'=>'更多', 'more_link'=>'/article/list_2_1.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"1","display":"4"}',]);
        Block::create(['id' => 3, 'object_id' => '2018_03_04_235036_index_case_news_block', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '成功案例', 'more_title'=>'更多', 'more_link'=>'/article/list_3_2.html', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"2","display":"4"}',]);
        Block::create(['id' => 4, 'object_id' => '2018_03_04_235540_index_hot_news_block', 'group' => 0, 'type' => 'hotArticle', 'template' => 'default', 'title' => '本周热议', 'created_op'=>1, 'updated_op'=>1, 'content'=>'{"category_id":"3","display":"10"}',]);

//        User::find(1)->update(['avatar'=>'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        File::query()->delete();
        Slide::query()->delete();
        Block::query()->delete();
    }
}
