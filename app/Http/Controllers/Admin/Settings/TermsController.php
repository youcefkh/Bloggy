<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index(){
        $privacy = Setting::where('name','terms of use')->first();
        return view('admin.terms',['terms'=>$privacy]);
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
                'name' => 'terms of use',
                'value' => $request->value,
                'value_ar' => $request->has('value_ar')?$request->value_ar:null,
                'key' => 'terms of use',

            ]
        );

        session()->flash('create','terms of use updated successfully');
        return redirect()->back()->with(['privacy',$company]);
    }
}
