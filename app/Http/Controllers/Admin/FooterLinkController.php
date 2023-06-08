<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\FooterLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class FooterLinkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FooterLink::select('*')->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
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

        return view('admin.footerLinks');
    }

    public function store(Request $request)
    {
        $companyId = $request->id;
        $request->validate([

            'name_fr' => 'required | string',
            'name_ar' => 'required | string',
            'url' => 'required | url',
        ]);

        $company = FooterLink::updateOrCreate(
            [
                'id' => $companyId
            ],
            [
                'name_fr' => $request->name_fr,
                'name_ar' => $request->name_ar,
                'url' => $request->url,
            ]
        );

        session()->flash('create', 'footer link created successfully');
        return Response()->json($company);
    }

    public function edit(Request $request)
    {

        $where = array('id' => $request->id);
        $company  = FooterLink::where($where)->first();

        return Response()->json($company);
    }
    public function destroy(Request $request)
    {
        $company = FooterLink::where('id', $request->id)->delete();

        return Response()->json($company);
    }
}
