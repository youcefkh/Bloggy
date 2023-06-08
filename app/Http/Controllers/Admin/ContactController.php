<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {

                    return  Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" data-toggle="tooltip" id="edit-'. $row->id .'" onClick="editFunc(' .  $row->id . ')" data-original-title="Edit" style="text-decoration: none" class="text-success"><i class="ti-eye"></i></a> ';
                    $html .= '<button id="delete-compnay" onClick="deleteFunc(' .  $row->id . ')" data-toggle="tooltip" data-original-title="Delete" style="border: none" class="text-danger"><i class="ti-trash"></i></button>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.contacts');
    }

    public function edit(Request $request)
    {

        $where = array('id' => $request->id);
        $company  = Contact::where($where)->first();

        return Response()->json($company);
    }
    public function destroy(Request $request)
    {
        $company = Contact::where('id', $request->id)->delete();

        return Response()->json($company);
    }

    public function notification(Request $request)
    {
        if ($request->id) {
            $contact = Contact::find($request->id);

            $contact->condition = true;

            $contact->save();
        }

        $count = Contact::where('condition', 0)->count();
        return Response()->json($count);
    }
}
