<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Subcategory;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::select('*')->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                /* ->addColumn('category', function ($row) {

                    return $row->article->subcategory->category->name;
                })
                ->addColumn('subcategory', function ($row) {

                    return $row->article->subcategory->name;
                }) */
                ->addColumn('created_at', function ($row) {

                    return  Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="javascript:void(0);" data-toggle="tooltip" onClick="editFunc(' .  $row->id . ')" data-original-title="Edit" style="text-decoration: none" class="text-success"><i class="ti-pencil"></i></a> ';
                    $html .= '<button id="delete-compnay" onClick="deleteFunc(' .  $row->id . ')" data-toggle="tooltip" data-original-title="Delete" style="border: none" class="text-danger"><i class="ti-trash"></i></button>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.faqs');
    }

    public function create(Request $request)
    {
        if ($request->category_id) {
            $subcategories = Subcategory::where('category_id', $request->category_id)->get();
            return response()->json(['subcategories' => $subcategories]);
        } elseif ($request->subcategory_id) {
            $articles = Article::where('subcategory_id', $request->subcategory_id)->get();
            return response()->json(['articles' => $articles]);
        }
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $companyId = $request->id;
        $request->validate([
            'question_fr' => 'required | string',
            'question_ar' => 'required | string',
        ]);

        $data = [
            'question_fr' => $request->question_fr,
            'question_ar' => $request->question_ar,
        ];

        if($request->response_fr){
            $data['response_fr'] = $request->response_fr;
            $data['response_ar'] = $request->response_ar;
            $data['article_id'] = null;
        }else{
            $data['response_fr'] = null;
            $data['response_ar'] = null;
            $data['article_id'] = $request->article_id;
        }

        $company   =   Faq::updateOrCreate(
            [
                'id' => $companyId
            ],
            $data
        );

        session()->flash('create', 'question created successfully');
        return Response()->json($company);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $company  = Faq::where('id', $id)->first();
        $categories = Category::all();
        $cat_id = $company->article_id ? $company->article->subcategory->category->id : [];
        $subcategories = Subcategory::where('category_id', $cat_id)->get();
        $subcat_id = $company->article_id ? $company->article->subcategory->id : [];
        $articles = $company->article_id ? Article::where('subcategory_id', $subcat_id)->get() : [];

        return Response()->json(['faq' => $company, 'categories' => $categories, 'cat_id' => $cat_id, 'subcategories' => $subcategories, 'subcat_id' => $subcat_id, 'articles' => $articles]);

        //return Response()->json($company);
    }
    public function destroy(Request $request)
    {
        $company = Faq::where('id', $request->id)->delete();

        return Response()->json($company);
    }
}
