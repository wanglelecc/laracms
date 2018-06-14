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

namespace App\Models;

use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;

/**
 * 页面模型
 *
 * Class Page
 * @package App\Models
 */
class Page extends Model
{
    use WithCommonHelper;

    public $table = 'articles';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id', 'object_id', 'alias','title', 'subtitle', 'keywords', 'description', 'author', 'source', 'order', 'content', 'thumb', 'type', 'is_link','link', 'template', 'status', 'views', 'weight', 'css', 'js', 'top', 'created_op', 'updated_op',
    ];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith(){
        return $this->where('type','page')->with(['created_user','updated_user']);
    }

    /**
     * 生成单页面URL
     *
     * @param int $navigation_id
     * @return string
     */
    public function getLink($navigation_id = 0){
        if($this->is_link == 1 && !empty($this->link)){
            return $this->link;
        }
        return route('page.show',[$navigation_id, $this->id]);
    }

}
