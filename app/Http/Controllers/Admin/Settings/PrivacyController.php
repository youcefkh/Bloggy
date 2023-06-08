<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(){
        $privacy = Setting::where('name','privacy policy')->first();
        return view('admin.privacy',['privacy'=>$privacy]);
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
                'name' => 'privacy policy',
                'value' => $request->value,
                'value_ar' => $request->has('value_ar')?$request->value_ar:null,
                'key' => 'privacy policy',

            ]
        );

        session()->flash('create','privacy policies updated successfully');
        return redirect()->back()->with(['privacy',$company]);
    }
}
