<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $privacy = Setting::where('name','about us')->first();
        return view('admin.aboutus',['about'=>$privacy]);
    }
    public function store(Request $request){
        $companyId = $request->id;
        $request->validate([
            'value'=>'required',
            'value_ar'=>'required',
        ]);
        $company   =   Setting::updateOrCreate(
            [
                'id' => $companyId
            ],
            [
                'name' => 'about us',
                'value' => $request->value,
                'value_ar' => $request->has('value_ar')?$request->value_ar:null,
                'key' => 'about us ',

            ]
        );

        session()->flash('create','about us  updated successfully');
        return redirect()->back()->with('privacy',$company);
    }
}
