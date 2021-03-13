<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Auth;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;

class AffiliateUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  	public function index()
    {        
        return view('admin.affiliate_users');
    }

    public function get(Request $request) {
        $parent = $request->parent;
        $data = array();
        if(empty($parent) || $parent == '#') {
            $users = User::where('is_vendor','=',0)->where('sup_id', '=', 0)->get();
        } else {
            $users = User::where('is_vendor','=',0)->where('sup_id', '=', $parent)->get();
        }
        if($users->count()>0) {
            foreach($users as $user) {
                $children = User::where('is_vendor','=',0)->where('sup_id', '=', $user->id)->get()->count()>0;
                $icon = 'fas fa-user';
                if($children) $icon .= 's';
                $tmp = array(
                    'id' => $user->id,
                    'text' => $user->name.' ('.$user->email.')',
                    'icon' => $icon.' icon-lg',
                    'children' => $children
                );
                if($parent == '#') $tmp['type'] = 'root';
                $data[] = $tmp;
            }
        }
        return response()->json($data);
    }
}
