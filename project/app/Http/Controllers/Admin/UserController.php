<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\Currency;
use App\Models\Deposit;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Classes\Common;

class UserController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth:admin');
        }

        //*** JSON Request
        public function datatables()
        {
             $datas = User::orderBy('id')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('action', function(User $data) {
                                    $class = $data->ban == 0 ? 'drop-success' : 'drop-danger';
                                    $s = $data->ban == 1 ? 'selected' : '';
                                    $ns = $data->ban == 0 ? 'selected' : '';
                                    $ban = '<select class="process select droplinks '.$class.'">'.
                '<option data-val="0" value="'. route('admin-user-ban',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Block</option>'.
                '<option data-val="1" value="'. route('admin-user-ban',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>UnBlock</option></select>';
                                    return '<div class="action-list"><a href="javascript:;" data-toggle="modal" data-target="#modal1" class="deposit" data-href="' . route('admin-user-deposit',$data->id) . '" > <i class="fas fa-dollar-sign"></i> Manage Deposit</a><a href="' . route('admin-user-show',$data->id) . '" > <i class="fas fa-eye"></i> Details</a><a data-href="' . route('admin-user-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" class="send" data-email="'. $data->email .'" data-toggle="modal" data-target="#vendorform"><i class="fas fa-envelope"></i> Send</a>'.$ban.'<a href="javascript:;" data-href="' . route('admin-user-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                                }) 
                                ->rawColumns(['action'])
                                ->toJson(); //--- Returning Json Data To Client Side
        }




        //*** JSON Request
        public function transdatatables()
        {
             $datas = Transaction::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('name', function(Transaction $data) {
                                    $name = '<a href="'.route('admin-user-show',$data->user_id).'" target="_blank">'.$data->user['name'].'</a>';
                                    return $name;
                                })
                                ->addColumn('date', function(Transaction $data) {
                                    $date = date('Y-m-d',strtotime($data->created_at));
                                    return $date;
                                })
                                ->editColumn('amount', function(Transaction $data) {
                                    $price = Common::formatPrice($data->amount);
                                    if($data->type == 'plus'){
                                        $price ='+'.$price;
                                    } else {
                                        $price ='-'.$price;
                                    }
                                    return  $price;
                                })
                                ->addColumn('action', function(Transaction $data) {
                                    return '<div class="action-list"><a href="javascript:;" data-href="' . route('admin-trans-show',$data->id) . '" class="view" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i> Details</a></div>';
                                }) 
                                ->rawColumns(['name','action'])
                                ->toJson(); //--- Returning Json Data To Client Side
        }

        //*** GET Request
        public function index()
        {
            return view('admin.user.index');
        }

        //*** GET Request
        public function image()
        {  
            return view('admin.generalsetting.user_image');
        }

        //*** GET Request
        public function show($id)
        {
            $data = User::findOrFail($id);
            return view('admin.user.show',compact('data'));
        }

        //*** GET Request
        public function ban($id1,$id2)
        {
            $user = User::findOrFail($id1);
            $user->ban = $id2;
            $user->update();

        }

        //*** GET Request    
        public function edit($id)
        {
            $data = User::findOrFail($id);
            return view('admin.user.edit',compact('data'));
        }

        //*** POST Request
        public function update(Request $request, $id)
        {
            //--- Validation Section
            $rules = [
                   'photo' => 'mimes:jpeg,jpg,png,svg',
                    ];

            $validator = Validator::make(Input::all(), $rules);
            
            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            $user = User::findOrFail($id);
            $data = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/users',$name);
                if($user->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/users/'.$user->photo)) {
                        unlink(public_path().'/assets/images/users/'.$user->photo);
                    }
                }
                $data['photo'] = $name;
            }
            $user->update($data);
            $msg = 'Customer Information Updated Successfully.';
            return response()->json($msg);   
        }

        //*** GET Request Delete
        public function destroy($id)
        {
        $user = User::findOrFail($id);

        Deposit::where('user_id', $user->id)->delete();
        if($user->reports->count() > 0)
        {
            foreach ($user->reports as $gal) {
                $gal->delete();
            }
        }


        if($user->shippings->count() > 0)
        {
            foreach ($user->shippings as $gal) {
                $gal->delete();
            }
        }


        if($user->packages->count() > 0)
        {
            foreach ($user->packages as $gal) {
                $gal->delete();
            }
        }
        

        if($user->ratings->count() > 0)
        {
            foreach ($user->ratings as $gal) {
                $gal->delete();
            }
        }

        if($user->notifications->count() > 0)
        {
            foreach ($user->notifications as $gal) {
                $gal->delete();
            }
        }

        if($user->wishlists->count() > 0)
        {
            foreach ($user->wishlists as $gal) {
                $gal->delete();
            }
        }

        if($user->withdraws->count() > 0)
        {
            foreach ($user->withdraws as $gal) {
                $gal->delete();
            }
        }

        if($user->socialProviders->count() > 0)
        {
            foreach ($user->socialProviders as $gal) {
                $gal->delete();
            }
        }

        if($user->conversations->count() > 0)
        {
            foreach ($user->conversations as $gal) {
            if($gal->messages->count() > 0)
            {
                foreach ($gal->messages as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }
        if($user->comments->count() > 0)
        {
            foreach ($user->comments as $gal) {
            if($gal->replies->count() > 0)
            {
                foreach ($gal->replies as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }

            if($user->replies->count() > 0)
            {
                foreach ($user->replies as $gal) {
                    if($gal->subreplies->count() > 0)
                    {
                        foreach ($gal->subreplies as $key) {
                            $key->delete();
                        }
                    }
                    $gal->delete();
                }
            }


        if($user->favorites->count() > 0)
        {
            foreach ($user->favorites as $gal) {
                $gal->delete();
            }
        }


        if($user->subscribes->count() > 0)
        {
            foreach ($user->subscribes as $gal) {
                $gal->delete();
            }
        }

        if($user->services->count() > 0)
        {
            foreach ($user->services as $gal) {
                if (file_exists(public_path().'/assets/images/services/'.$gal->photo)) {
                    unlink(public_path().'/assets/images/services/'.$gal->photo);
                }
                $gal->delete();
            }
        }


        if($user->withdraws->count() > 0)
        {
            foreach ($user->withdraws as $gal) {
                $gal->delete();
            }
        }


        if($user->products->count() > 0)
        {

// PRODUCT

            foreach ($user->products as $prod) {
                if($prod->galleries->count() > 0)
                {
                    foreach ($prod->galleries as $gal) {
                            if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                                unlink(public_path().'/assets/images/galleries/'.$gal->photo);
                            }
                        $gal->delete();
                    }

                }
                if($prod->ratings->count() > 0)
                {
                    foreach ($prod->ratings as $gal) {
                        $gal->delete();
                    }
                }
                if($prod->wishlists->count() > 0)
                {
                    foreach ($prod->wishlists as $gal) {
                        $gal->delete();
                    }
                }

                if($prod->clicks->count() > 0)
                {
                    foreach ($prod->clicks as $gal) {
                        $gal->delete();
                    }
                }

                if($prod->comments->count() > 0)
                {
                    foreach ($prod->comments as $gal) {
                    if($gal->replies->count() > 0)
                    {
                        foreach ($gal->replies as $key) {
                            $key->delete();
                        }
                    }
                        $gal->delete();
                    }
                }

                if (file_exists(public_path().'/assets/images/products/'.$prod->photo)) {
                    unlink(public_path().'/assets/images/products/'.$prod->photo);
                }

                $prod->delete();
            }


// PRODUCT ENDS

        }
// OTHER SECTION 



        if($user->senders->count() > 0)
        {
            foreach ($user->senders as $gal) {
            if($gal->messages->count() > 0)
            {
                foreach ($gal->messages as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }


        if($user->recievers->count() > 0)
        {
            foreach ($user->recievers as $gal) {
            if($gal->messages->count() > 0)
            {
                foreach ($gal->messages as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }


        if($user->conversations->count() > 0)
        {
            foreach ($user->conversations as $gal) {
            if($gal->messages->count() > 0)
            {
                foreach ($gal->messages as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }


        if($user->vendororders->count() > 0)
        {
            foreach ($user->vendororders as $gal) {
                $gal->delete();
            }
        }

        if($user->notivications->count() > 0)
        {
            foreach ($user->notivications as $gal) {
                $gal->delete();
            }
        }

// OTHER SECTION ENDS

            //If Photo Doesn't Exist
            if($user->photo == null){
                $user->delete();
                //--- Redirect Section     
                $msg = 'Data Deleted Successfully.';
                return response()->json($msg);      
                //--- Redirect Section Ends 
            }
            //If Photo Exist
            if (file_exists(public_path().'/assets/images/users/'.$user->photo)) {
                    unlink(public_path().'/assets/images/users/'.$user->photo);
                 }
            $user->delete();
            //--- Redirect Section     
            $msg = 'Data Deleted Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends    
        }

        //*** JSON Request
        public function withdrawdatatables()
        {
             $datas = Withdraw::where('type','=','user')->orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('email', function(Withdraw $data) {
                                    $email = $data->user->email;
                                    return $email;
                                }) 
                                ->addColumn('phone', function(Withdraw $data) {
                                    $phone = $data->user->phone;
                                    return $phone;
                                }) 
                                ->editColumn('status', function(Withdraw $data) {
                                    $status = ucfirst($data->status);
                                    return $status;
                                }) 
                                ->editColumn('amount', function(Withdraw $data) {
                                    $amount = Common::formatPrice($data->amount);
                                    return $amount;
                                }) 
                                ->addColumn('action', function(Withdraw $data) {
                                    $action = '<div class="action-list"><a data-href="' . route('admin-withdraw-show',$data->id) . '" class="view details-width" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i> Details</a>';
                                    if($data->status == "pending") {
                                    $action .= '<a data-href="' . route('admin-withdraw-accept',$data->id) . '" data-toggle="modal" data-target="#confirm-delete"> <i class="fas fa-check"></i> Accept</a><a data-href="' . route('admin-withdraw-reject',$data->id) . '" data-toggle="modal" data-target="#confirm-delete1"> <i class="fas fa-trash-alt"></i> Reject</a>';
                                    }
                                    $action .= '</div>';
                                    return $action;
                                }) 
                                ->rawColumns(['name','action'])
                                ->toJson(); //--- Returning Json Data To Client Side
        }

        //*** GET Request
        public function withdraws()
        {
            return view('admin.user.withdraws');
        }

        //*** GET Request       
        public function withdrawdetails($id)
        {
            $sign = Currency::where('is_default','=',1)->first();
            $withdraw = Withdraw::findOrFail($id);
            return view('admin.user.withdraw-details',compact('withdraw','sign'));
        }

        //*** GET Request   
        public function accept($id)
        {
            $withdraw = Withdraw::findOrFail($id);
            $data['status'] = "completed";
            $withdraw->update($data);
            //--- Redirect Section     
            $msg = 'Withdraw Accepted Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends   
        }

        //*** GET Request   
        public function reject($id)
        {
            $withdraw = Withdraw::findOrFail($id);
            $account = User::findOrFail($withdraw->user->id);
            //$account->affilate_income = $account->affilate_income + $withdraw->amount + $withdraw->fee;
            $account->balance = $account->balance + $withdraw->amount + $withdraw->fee;
            $account->update();
            $data['status'] = "rejected";
            $withdraw->update($data);
            //--- Redirect Section     
            $msg = 'Withdraw Rejected Successfully.';
            return response()->json($msg);      
            //--- Redirect Section Ends   
        }

        //*** GET Request
        public function transactions()
        {
            return view('admin.trans.index');
        }

        //*** GET Request
        public function transhow($id)
        {
            $data = Transaction::find($id);
            return view('admin.trans.show',compact('data'));
        }

        //*** GET Request
        public function deposit($id)
        {
            $sign = Currency::where('is_default','=',1)->first();
            $data = User::findOrFail($id);
            return view('admin.user.deposit',compact('data','sign'));
        }

        public function depositupdate(Request $request, $id)
        {
            $sign = Currency::where('is_default','=',1)->first();

            $user = User::findOrFail($id);
            if($request->type == 'plus') {
                $user->balance += (double)$request->amount;
            }else{
                $user->balance -= (double)$request->amount;
            }
            $user->update();

            $transaction = new Transaction;
            $transaction->txn_number = str_random(3).substr(time(), 6,8).str_random(3);
            $transaction->amount = $request->amount;
            $transaction->user_id = $id;
            $transaction->currency_sign = $sign->sign;
            $transaction->currency_code = $sign->name;
            $transaction->currency_value = $sign->value;
            $transaction->method = null;
            $transaction->txnid = null;
            $transaction->details = $request->details;
            $transaction->type = $request->type;
            $transaction->save();
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);   
        }
}