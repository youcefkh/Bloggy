<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){

        $result=DB::table('categories')
            ->join('subcategories', 'categories.id', '=', 'subcategories.category_id')
            ->join('articles', 'subcategories.id', '=', 'articles.subcategory_id')
            ->when(!empty($request->input('query')), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('categories.name_ar', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('categories.name', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('subcategories.name', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('subcategories.name_ar', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('articles.title_ar', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('articles.title', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('articles.article', 'like', '%' . $request->input('query') . '%')
                        ->orWhere('articles.article_ar', 'like', '%' . $request->input('query') . '%');
                });
            })
            ->select(
                app()->getLocale() =="ar"? 'articles.title_ar as name':
                'articles.title as name',

            )->get();
        // $reservations = Reservation::with('center')->where('vaccination_centers.id', '=', auth()->user()->center->id)->get();
        return response()->json($result);
    }
    public function index(Request $request){
        $result=DB::table('categories')
            ->join('subcategories', 'categories.id', '=', 'subcategories.category_id')
            ->join('articles', 'subcategories.id', '=', 'articles.subcategory_id')
            ->when(!empty($request->input('keyword')), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('categories.name_ar', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('categories.name', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('subcategories.name', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('subcategories.name_ar', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('articles.title_ar', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('articles.title', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('articles.article', 'like', '%' . $request->input('keyword') . '%')
                        ->orWhere('articles.article_ar', 'like', '%' . $request->input('keyword') . '%');
                });
            })->select(
                app()->getLocale() =="ar"? 'articles.title_ar as title': 'articles.title as title',
                app()->getLocale() =="ar"? 'categories.name_ar as category': 'categories.name as category',
                app()->getLocale() =="ar"? 'subcategories.name_ar as subcategory': 'subcategories.name as subcategory',
                 'articles.id as article_id',
                DB::raw('sum(articles.views) as count'),
                'categories.id as category_id',
                'subcategories.id as subcategory_id',

            )->groupBy('category_id','subcategory_id','title')->orderBy('count' ,'DESC')->get();
        // $reservations = Reservation::with('center')->where('vaccination_centers.id', '=', auth()->user()->center->id)->get();
        return view('search',['search'=>$result]);
    }
}
