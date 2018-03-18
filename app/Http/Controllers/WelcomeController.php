<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class WelcomeController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | 前台公共控制器
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /**
     * 前台首页
     *
     * @return mixed
     */
    public function index()
    {
        return frontend_view('welcome');
    }

    public function message(){
        Article::create(['id'=>1, 'author'=>'管理员', 'is_link' => '0', 'type'=>'article', 'created_op'=>1, 'updated_op'=>1, 'object_id'=>'1593889566486881', 'title'=>'享受购置税减半的B级车推荐', 'content'=>'<p><span style="color:rgb(85,85,85);font-size:15px;">前不久，一则重磅新闻引爆国内汽车市场，那就是国务院总理李克强9月29日主持召开国务院常务会议中决定，从2015年10月1日到2016年12月31日，对购买1.6升及以下排量乘用车实施减半征收车辆购置税的优惠政策。这便意味着市场上那些符合这一标准的车型，在消费者交全款买车前，就已经有了几千元甚至上万元的优惠！应该说此项举措对于目前比较消沉的车市以及不少持币观望合适买车的消费者来说，能起不少推动和促进的效果。</span></p><p><span style="color:rgb(85,85,85);font-size:15px;">但在不少消费者心中，总是认为符合这一标准的车型基本都集中在了紧凑级以及微型车，对于那些想买级别再高车型的朋友来说有点不沾边。其实有这种想法的朋友大可不必担心，因为在目前的市场上，配有小排量涡轮增压发动机的B级车有很多，完全满足市场的要求。今天，我们特意选出了4款在这个级别比较有特点的车型，希望能对您有些帮助。</span></p>',])->giveCategoryTo([1]);

        return '在线留言.';
    }

    /**
     * 关于我们
     */
    public function company(){
        return frontend_view('company');
    }
}
