<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class HomeController extends Controller
{
    public function index(){
//        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
//        dd($analyticsData);
        return view('admin.dashboard');
    }
}
