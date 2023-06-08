<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Subcategory::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category',function ($row){

                    return $row->category->name;
                })
                ->addColumn('created_at',function ($row){

                    return  Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="javascript:void(0);" data-toggle="tooltip" onClick="editFunc('.  $row->id .')" data-original-title="Edit" style="text-decoration: none" class="text-success"><i class="ti-pencil"></i></a> ';
                    $html .= '<button id="delete-compnay" onClick="deleteFunc('.  $row->id .')" data-toggle="tooltip" data-original-title="Delete" style="border: none" class="text-danger"><i class="ti-trash"></i></button>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subcategories');
    }
    public function create()
    {
        $categories = Category::all();
        return response()->json(['categories'=>$categories]);
    }
    public function getAll(Request $request)
    {
        $subcategories = Category::find($request->id)->subcategories;
        return response()->json(['subcategories'=>$subcategories]);
    }
    public function store(Request $request)
    {
        $companyId = $request->id;
        $request->validate([
            'category_id'=>'required',
            'name_ar' => 'required',
            'name' => 'required',
        ]);
        $company   =   Subcategory::updateOrCreate(
            [
                'id' => $companyId
            ],
            [
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'category_id' => $request->category_id,
            ]
        );

        session()->flash('create','subcategory created successfully');
        return Response()->json($company);
    }

    public function edit(Request $request){

        $where = array('id' => $request->id);
        $company  = Subcategory::where($where)->first();
        $categories = Category::all();
        return Response()->json(['subcategory'=>$company,'categories'=>$categories]);
    }
    public function destroy(Request $request){
        $company = Subcategory::where('id',$request->id)->delete();

        return Response()->json($company);
    }
}
