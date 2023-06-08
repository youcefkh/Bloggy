<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Traits\Media;

class ArticleController extends Controller
{
    use Media;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {

                    return $row->subcategory->category->name;
                })
                ->addColumn('subcategory', function ($row) {

                    return $row->subcategory->name;
                })
                ->addColumn('created_at', function ($row) {

                    return  Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="' . route('articles.edit', ['id' => $row->id]) . '" data-toggle="tooltip"  data-original-title="Edit" style="text-decoration: none" class="text-success"><i class="ti-eye"></i></a> ';
                    $html .= '<button id="delete-compnay" onClick="deleteFunc(' .  $row->id . ')" data-toggle="tooltip" data-original-title="Delete" style="border: none" class="text-danger"><i class="ti-trash"></i></button>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.articles.articles');
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', ['categories' => $categories, 'article' => null]);
    }
    public function upload()
    {
        $imgpath =  $this->uploads(request()->file('file'), 'uploads/', request()->file('file')->getClientOriginalName());
        return response()->json(['location' => asset($imgpath['filePath'])]);
    }
    public function store(Request $request)
    {
        $companyId = $request->id;

        $dataValidation = [
            'subcategory_id' => 'required',
            'title' => 'required',
            'article' => 'required',
            'status' => 'required',
        ];

        /* the thumbnail_ar is required only from the create page */
        if (!$companyId) {
            $dataValidation['thumbnail_ar'] = 'required | image';
        } else {
            $dataValidation['thumbnail_ar'] = 'image';
        }

        $request->validate($dataValidation);

        $data = [
            'title' => $request->title,
            'article' => $request->article,
            'title_ar' => $request->has('title_ar') ? $request->title_ar : null,
            'article_ar' => $request->has('article_ar') ? $request->article_ar : null,
            'status' => $request->has('status') ? $request->status : 'pending',
            'subcategory_id' => $request->subcategory_id,
        ];

        if ($request->hasFile('thumbnail_ar') && $request->thumbnail_ar) {
            $result = $this->uploads($request->thumbnail_ar, 'uploads/article-thumbnails/', $request->thumbnail_ar->getClientOriginalName() . time() . '.' . $request->thumbnail_ar->getClientOriginalExtension());
            $data['thumbnail_ar'] = $result['filePath'];
        }
        if ($request->hasFile('thumbnail_fr') && $request->thumbnail_fr) {
            $result = $this->uploads($request->thumbnail_fr, 'uploads/article-thumbnails/', $request->thumbnail_fr->getClientOriginalName() . time() . '.' . $request->thumbnail_fr->getClientOriginalExtension());

            $dataValidation['thumbnail_fr'] = 'image';
            $data['thumbnail_fr'] = $result['filePath'];
        }

        Article::updateOrCreate(
            [
                'id' => $companyId
            ],
            $data
        );

        session()->flash('create', 'articles updated successfully');
        return redirect()->route('articles');
    }

    public function edit($id)
    {

        $where = array('id' => $id);
        $company  = Article::where($where)->with(['subcategory.category'])->first();
        $categories = Category::all();
        return view('admin.articles.create', ['categories' => $categories, 'article' => $company]);
        //        return redirect()->route('articles.create')->with(['article'=>$company,'categories'=>$categories]);
    }
    public function destroy(Request $request)
    {
        $company = Article::where('id', $request->id)->delete();

        return Response()->json($company);
    }
}
