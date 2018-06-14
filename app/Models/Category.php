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

/**
 * 分类模型
 *
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['id','name', 'keywords', 'description', 'parent', 'order', 'path', 'type', 'link', 'template', ];

    public function articles(){
        return $this->belongsToMany(
            'App\Models\Article',
            'article_category',
            'category_id',
            'article_id'
        );
    }
}