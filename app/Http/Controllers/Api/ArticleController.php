<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;

class ArticleController extends Controller
{
    public function index()
    {
        //return Article::orderBy('id', 'DESC')->limit(2)->get();
        $article = DB::table('articles')
            ->join('subcategories', 'subcategories.id', '=', 'articles.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->select('articles.*', 'categories.name as cat_name_fr', 'categories.name_ar as cat_name_ar')
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();

        return $article;
    }

    public function show($id)
    {
        /* update views */
        $model = Article::find($id);
        $model->views += 1;
        $model->save();

        /*get article with its subcategory and category*/
        $article = DB::table('articles')
            ->join('subcategories', 'subcategories.id', '=', 'articles.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('articles.id', '=', $id)
            ->select('articles.*', 'subcategories.name as sub_name', 'categories.name as cat_name', 'subcategories.name_ar as sub_name_ar', 'categories.name_ar as cat_name_ar')
            ->first();

        return $article;
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $articles = Subcategory::withCount(['articles' => function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('title_ar', 'like', '%' . $search . '%')
                    ->orWhere('article', 'like', '%' . $search . '%')
                    ->orWhere('article_ar', 'like', '%' . $search . '%');
            }])
            ->with(['articles' => function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('title_ar', 'like', '%' . $search . '%')
                    ->orWhere('article', 'like', '%' . $search . '%')
                    ->orWhere('article_ar', 'like', '%' . $search . '%');
            }])
            ->get();

        return $articles;
    }
}
