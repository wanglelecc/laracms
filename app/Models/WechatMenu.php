<?php

namespace App\Models;

use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;

class WechatMenu extends Model
{
    public $table = 'wechat_menu';
    protected $fillable = ['group', 'parent', 'name', 'type', 'data', 'order'];

    public function handle(){
        switch (strtolower($this->type)){
            case 'text':
                $text = new Text(get_json_params($this->data,'text'));
                return $text;
                break;
            case 'content':
                $items = [];

                $data = is_json($this->data) ? json_decode($this->data) : new \stdClass();
                $category_id = get_value($data, 'category_id', 0);
                $limit = get_value($data, 'limit', 6);

                $results =  Category::find($category_id)->articles()->recent()->offset(0)->limit($limit)->get();
                foreach($results as $article){
                    $items[] = new NewsItem([
                        'title'       => $article->title,
                        'description' => $article->description,
                        'url'         => $article->getLink(),
                        'image'       => $article->getThumb(),
                    ]);
                }

                return new News($items);
                break;
            case 'event':
                // 扩展自定义事件....
                // return Event::$action($this->wechat_id);
                return null;
                break;
            default:
                return null;
                break;
        }
    }
}
