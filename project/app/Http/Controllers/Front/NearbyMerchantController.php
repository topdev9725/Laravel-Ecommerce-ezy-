<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;

class NearbyMerchantController extends Controller
{
    public function nearbystoreshow(Request $request)
    {
        $category_id = $request->category_id;

        if ($category_id != 0) {
          $nearby_stores = User::whereIn('is_vendor', array(1,2))
                                  ->where('nearby', '=', 1)
                                  ->where('category_id', 'like', '%'.','.$category_id.','.'%')
                                  ->orwhere('category_id', 'like', '%'.'['.$category_id.','.'%')
                                  ->orwhere('category_id', 'like', '%'.','.$category_id.']'.'%')
                                  ->get();
          $category_info = Category::where('id', '=', $category_id)->first();
        } else {
          $nearby_stores = User::whereIn('is_vendor', array(1,2))->where('nearby', '=', 1)->get();
          $category_info = '';
        }
  
        if($request->ajax()) {
          return view('front.ajax-nearby-merchant',compact('nearby_stores', 'category_info'));
        }

        return view('front.nearby-merchant',compact('nearby_stores', 'category_info'));
    }
}
