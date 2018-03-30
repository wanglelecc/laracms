<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Transformers\ArticleTransformer;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index($category_id = 0, Request $request)
    {
//        $maxId = $request->max_id ?? 0;
        if( ! ($category = Category::find($category_id)) ){ abort(404); }
        $articles = $category->articles();
//        if($maxId > 0){ $articles = $articles->where('id', '>', $maxId); }
        $articles = $articles->ordered()->recent()->paginate(10);
        return $this->response->paginator($articles, new ArticleTransformer());
    }
}
