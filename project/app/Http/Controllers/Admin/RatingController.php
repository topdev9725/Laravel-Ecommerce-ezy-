<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;

class RatingController extends Controller
{
	public function __construct()
	    {
	        $this->middleware('auth:admin');
	    }

	    //*** JSON Request
	    public function datatables()
	    {
	         $datas = Rating::orderBy('id')->get();
	         //--- Integrating This Collection Into Datatables
	         return Datatables::of($datas)
	                            ->addColumn('product', function(Rating $data) {
	                                $name = mb_strlen(strip_tags($data->product->name),'utf-8') > 50 ? mb_substr(strip_tags($data->product->name),0,50,'utf-8').'...' : strip_tags($data->product->name);
	                                $product = '<a href="'.route('front.product',$data->product->slug).'" target="_blank">'.$name.'</a>';
	                                return $product;
	                            })
	                            ->addColumn('reviewer', function(Rating $data) {
	                                $name = $data->user->name;
	                                return $name;
	                            })
	                            ->addColumn('review', function(Rating $data) {
	                                $text = mb_strlen(strip_tags($data->review),'utf-8') > 250 ? mb_substr(strip_tags($data->review),0,250,'utf-8').'...' : strip_tags($data->review);
	                                return $text;
	                            })
	                            ->addColumn('action', function(Rating $data) {
	                                return '<div class="action-list"><a data-href="' . route('admin-rating-show',$data->id) . '" class="view details-width" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i>Details</a><a href="javascript:;" data-href="' . route('admin-rating-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
	                            }) 
	                            ->rawColumns(['product','action'])
	                            ->toJson(); //--- Returning Json Data To Client Side
	    }
	    //*** GET Request
	    public function index()
	    {
	        return view('admin.rating.index');
	    }

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Rating::findOrFail($id);
	        return view('admin.rating.show',compact('data'));
	    }


	    //*** GET Request Delete
		public function destroy($id)
		{
		    $rating = Rating::findOrFail($id);
		    $rating->delete();
		    //--- Redirect Section     
		    $msg = 'Data Deleted Successfully.';
		    return response()->json($msg);      
		    //--- Redirect Section Ends    
		}
}
