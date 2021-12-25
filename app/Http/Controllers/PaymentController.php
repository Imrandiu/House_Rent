<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class PaymentController extends Controller
{
   
public function all_payment(){
   // $payment = DB::table('booking')->select('id','name','payment_method','transaction_no','created_at','phone','taka','email','status')->get();
    $payment = DB::table('booking')->join('posts','posts.id','booking.post_id')->join('users','users.id','posts.user_id')->select('booking.*','users.name as owner_name','users.phone_no')->get();
        return view('Admin.all_payment')->with('payment', $payment);
        }
        
        
    public function booking($id){
        $post=Post::find($id);
        return view('give_payment',compact('post'));
    }
    
    public function save_paymentss(Request $save){
       
          	$data=array();
          	$nid = $save->file('nid');
    //	$data['user_id']=Auth::user()->id;    
    	$data['post_id']=$save->post_id;    
    	$data['name']=$save->name;    
    	$data['email']=$save->email;    
    	$data['payment_method']=$save->title;
    	$data['transaction_no']=$save->transaction;
    	$data['taka']=$save->taka;
        $data['phone']=$save->phone;
        $data['present_address']=$save->present_address;
        if($nid){
            $data['nid']=$save->post_id.'.jpg';
            $nid->storeAs('public/user_nid',$save->post_id.'.jpg');

        }
    	DB::table('booking')->insert($data);
    	
    	return view('success_message');
    }
    
    
   


}






