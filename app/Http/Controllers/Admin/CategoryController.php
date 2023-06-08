<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Traits\Media;
class CategoryController extends Controller
{
    use Media;
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
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

        return view('admin.categories');
    }
    public function store(Request $request)
    {
        $companyId = $request->id;
        $request->validate([

            'name_ar' => 'required',
            'name' => 'required',
        ]);
        $toBeCreated=[
            'name' => $request->name,
            'name_ar' => $request->name_ar
        ];
        if($request->has('image') && $request->image){
            $result=$this->uploads($request->image, 'uploads/category-thumbnails/', $request->image->getClientOriginalName().time().'.'.$request->image->getClientOriginalExtension());
          $toBeCreated=[
              'name' => $request->name,
              'name_ar' => $request->name_ar,
              'image' => $result['filePath'],
          ];
        }
        $company   =   Category::updateOrCreate(
            [
                'id' => $companyId
            ],
            $toBeCreated
        );

        session()->flash('create','category created successfully');
        return Response()->json($company);
    }
    public function edit(Request $request){

        $where = array('id' => $request->id);
        $company  = Category::where($where)->first();

        return Response()->json($company);
    }
    public function destroy(Request $request){
        $company = Category::where('id',$request->id)->delete();

        return Response()->json($company);
    }
}
