<?php

namespace App\Http\Controllers\Admin;


use App\Models\Seotool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\ProductClick;

class SeoToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function analytics()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.googleanalytics',compact('tool'));
    }

    public function analyticsupdate(Request $request)
    {
        $tool = Seotool::findOrFail(1);
        $tool->update($request->all());
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);  
    }  

    public function keywords()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.meta-keywords',compact('tool'));
    }

    public function keywordsupdate(Request $request)
    {
        $tool = Seotool::findOrFail(1);
        $tool->update($request->all());
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);  
    }
     
    public function popular($id)
    {
        $expDate = Carbon::now()->subDays($id);
        $productss = ProductClick::whereDate('date', '>',$expDate)->get()->groupBy('product_id');
        $val = $id;
        return view('admin.seotool.popular',compact('val','productss'));
    }  

}
