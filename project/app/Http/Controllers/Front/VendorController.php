<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;


class VendorController extends Controller
{

    public function index(Request $request, $slug, $vendor_id, $store_type, $category_info=0)
    {
        $this->code_image();
        // $sort = "";
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sort;
        // $string = str_replace('-',' ', $slug);
        // $vendor_id = $request->vendor_id;
        // $store_type = $request->store_type;
        // $category_info = $request->category_info;
        $data['store_type'] = $store_type;
        $vendor = User::where('id','=',$vendor_id)->firstOrFail();
        $data['vendor'] = $vendor;
        $data['services'] = DB::table('services')->where('user_id','=',$vendor->id)->get();

        $category_ids = json_decode($vendor->category_id, true);
        $data['product_categories'] = array();
        $data['sub_categories'] = array();
        // $data['product_categories']['sub_categories']['child_categories'] = array();
        if (!empty($category_info)) {
            if ($store_type == 0) {  //when online store
                $category = Category::where('status', '=', 1)->where('id', '=', $category_info)->where('store_type', '=', 0)->first();
                if (!empty($category)) {
                    array_push($data['product_categories'], $category);
                }
            } elseif ($store_type == 1) {   //when nearby store
                $category = Category::where('status', '=', 1)->where('id', '=', $category_info)->where('store_type', '=', 1)->first();
                if (!empty($category)) {
                    array_push($data['product_categories'], $category);
                }
            }
        } else {
            if (!empty($category_ids)) {
                foreach($category_ids as $category_id) {
                    if ($store_type == 0) {  //when online store
                        $category = Category::where('status', '=', 1)->where('id', '=', $category_id)->where('store_type', '=', 0)->first();
                        if (!empty($category)) {
                            array_push($data['product_categories'], $category);
                        }
                    } elseif($store_type == 1) {  //when nearby store
                        $category = Category::where('status', '=', 1)->where('id', '=', $category_id)->where('store_type', '=', 1)->first();
                        if (!empty($category)) {
                            array_push($data['product_categories'], $category);
                        }
                    } else {  //when vendor manager
                        $category = Category::where('status', '=', 1)->where('id', '=', $category_id)->first();
                        if (!empty($category)) {
                            array_push($data['product_categories'], $category);
                        }
                    }
                }
            }
        }

        
        $sub_category = Subcategory::where('status', '=', 1)->get();
        if (!empty($sub_category)) {
            $data['sub_categories'] = $sub_category;
        }

        $child_category = Childcategory::where('status', '=', 1)->get();
        if (!empty($child_category)) {
            $data['child_categories'] = $child_category;
        }

        if (!empty($category_info)) {
            $prods = Product::where('status', 1)->where('user_id', $vendor->id)->where('category_id', $category_info)->get();
        } else {
            $prods = Product::where('status', 1)->where('user_id', $vendor->id)->get();
        }

        $vprods = (new Collection(Product::filterProducts($prods)))->paginate(9);
        $data['vprods'] = $vprods;

        // var_export($data['product_categories']);
        return view('front.vendor', $data);
    }

    //Send email to user
    public function vendorcontact(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $vendor = User::findOrFail($request->vendor_id);
        $gs = Generalsetting::findOrFail(1);
            $subject = $request->subject;
            $to = $vendor->email;
            $name = $request->name;
            $from = $request->email;
            $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else{
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }


    $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new Message();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->sent_user = $user->id;
            $msg->save();
        }
        else{
            $message = new Conversation();
            $message->subject = $subject;
            $message->sent_user= $request->user_id;
            $message->recieved_user = $request->vendor_id;
            $message->message = $request->message;
            $message->save();
            $msg = new Message();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->sent_user = $request->user_id;;
            $msg->save();

        }
    }

    // ------------------ Ezy
    public function category_products(Request $request) 
    {
        $minprice = $request->min;
        $maxprice = $request->max;
        $sort = $request->sort;
        $vendor_id = $request->vendor_id;
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $childcategory_id = $request->childcategory_id;
        $store_type = $request->store_type;
        $data['store_type'] = $store_type;

        if ($category_id == 0) {  //when show all button click
            $prods = Product::where('user_id', '=', $vendor_id)->when($minprice, function($query, $minprice) {
                                                    return $query->where('price', '>=', $minprice);
                                                })
                                                ->when($maxprice, function($query, $maxprice) {
                                                    return $query->where('price', '<=', $maxprice);
                                                })
                                                ->when($sort, function ($query, $sort) {
                                                    if ($sort=='date_desc') {
                                                        return $query->orderBy('id', 'DESC');
                                                    }
                                                    elseif($sort=='date_asc') {
                                                        return $query->orderBy('id', 'ASC');
                                                    }
                                                    elseif($sort=='price_desc') {
                                                        return $query->orderBy('price', 'DESC');
                                                    }
                                                    elseif($sort=='price_asc') {
                                                        return $query->orderBy('price', 'ASC');
                                                    }
                                                })
                                                ->when(empty($sort), function ($query, $sort) {
                                                    return $query->orderBy('id', 'DESC');
                                                })->where('status', 1)->get();
        } else {    // 
            // $prods = Product::where('user_id', '=', $vendor_id)->where('category_id', '=', $category_id)->get();
            $prods = Product::where('user_id', '=', $vendor_id)->when($category_id, function ($query, $category_id) {
                                                    return $query->where('category_id', $category_id);
                                                 })
                                                 ->when($subcategory_id, function ($query, $subcategory_id) {
                                                    return $query->where('subcategory_id', $subcategory_id);
                                                })
                                                ->when($childcategory_id, function ($query, $childcategory_id) {
                                                    return $query->where('childcategory_id', $childcategory_id);
                                                })
                                                ->when($minprice, function($query, $minprice) {
                                                    return $query->where('price', '>=', $minprice);
                                                })
                                                ->when($maxprice, function($query, $maxprice) {
                                                    return $query->where('price', '<=', $maxprice);
                                                })
                                                ->when($sort, function ($query, $sort) {
                                                    if ($sort=='date_desc') {
                                                        return $query->orderBy('id', 'DESC');
                                                    }
                                                    elseif($sort=='date_asc') {
                                                        return $query->orderBy('id', 'ASC');
                                                    }
                                                    elseif($sort=='price_desc') {
                                                        return $query->orderBy('price', 'DESC');
                                                    }
                                                    elseif($sort=='price_asc') {
                                                        return $query->orderBy('price', 'ASC');
                                                    }
                                                })
                                                ->when(empty($sort), function ($query, $sort) {
                                                    return $query->orderBy('id', 'DESC');
                                                })->where('status', 1)->get();
        }
        
        $vprods = (new Collection(Product::filterProducts($prods)))->paginate(9);
        $data['vprods'] = $vprods;
        
        if (count($prods) == 0) {
            $data = "<p style='text-align:center !important;font-size:20px;margin: 5px 15px;'>No products</p>";
            return $data;
        }

        return view('includes.product.product', $data);
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }


}
