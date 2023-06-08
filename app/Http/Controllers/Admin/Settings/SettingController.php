<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\Media;

class SettingController extends Controller
{
    use Media;
    public function index(){
        $social = Setting::where('name','Social Media')->get();
        $logo = Setting::where('key','logo')->first();
        $name = Setting::where('key','title')->first();
        $subname = Setting::where('key','subtitle')->first();
        return view('admin.settings',['socials'=>$social,'logo'=>$logo,'name'=>$name,'subname'=>$subname]);
    }
    public function store(Request $request){

        $companyId = $request->id;
        $request->validate([
            'value'=>'required',
            'name'=>'required',
            'key'=>'required',
        ]);
       $value = $request->value;
        if($request->hasFile('value')){
          $url = $this->uploads($request->file('value'),'uploads/',time().$request->value->getClientOriginalName());
          $value=$url['filePath'];
        }
        $value;
        $company   =   Setting::updateOrCreate(
            [
                'id' => $companyId
            ],
            [
                'name' => $request->name,
                'value' => $value,
                'value_ar' => $request->has('value_ar')?$request->value_ar:null,
                'key' => $request->key,

            ]
        );
        $social = Setting::where('name','Social Media')->get();
        $logo = Setting::where('key','logo')->first();
        $name = Setting::where('key','title')->first();
        $subname = Setting::where('key','subtitle')->first();
        session()->flash('create','Setting updated successfully');
        return redirect()->back()->with(['socials'=>$social,'logo'=>$logo,'name'=>$name,'subname'=>$subname]);
    }
    public function edit(Request $request){

        $where = array('id' => $request->id);
        $company  = Setting::where($where)->first();

        return Response()->json($company);
    }
}
