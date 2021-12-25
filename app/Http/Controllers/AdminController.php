<?php

namespace App\Http\Controllers;
use App\Admin;
use App\User;
use App\Post;
use DB;
use Illuminate\Http\Request;
use Hash;
class AdminController extends Controller
{
     public function all_payment(){
    	$payment = Post::all()->toArray();
    	return view('Admin.all_payment',compact('payment'));
    }
    public function login(Request $request){
    	  $email=$request->input('email');
        $password=$request->input('password');
        $data=Admin::where('email',$email)->first();
        if ($data != null) {
            if (Hash::check($password, $data->password)) {
                session(['Admin'=>true,'auth'=>true,'id'=>$data->id,'name'=>$data->name]);
               return redirect('admin/home');
            }
            else{
                $error=['password'=>'Password is not correct !!'];
                return redirect()->back()->withErrors($error); 
            }
        }
        else{
            $error=['email'=>'Email is not correct !!'];
            return redirect()->back()->withErrors($error);
        }
    }

    public function home(){
        $users = User::orderBy('id','desc')->paginate(15);
    	return view('Admin.home',compact('users'));
    }
    public function all_users(){
    	$users=User::orderBy('id','desc')->paginate(15);
    	return view('Admin.all_users',compact('users'));
    }
    public function view_user_info($id){
    	$user_info = User::find($id);
    	return view('Admin.user_info',compact('user_info'));
    }
    public function edit_user_info($id){
        $user_info = User::find($id);
    	return view('Admin.edit_user_info',compact('user_info'));
    }
    public function update_user_info(Request $request,$id){
    	$data = $request->all();
    	$user = User::find($id);
    	$i=0;
    	foreach($data as $key=>$value){
    		if($i != 0){
              $user->$key = $value;
    		}
    		$i++;
    	}
    	$user->save();
    	return redirect('admin/all_users');
    }
    public function delete_user_info($id){
    	 User::destroy($id);
    	return redirect()->back();
    }
    public function all_posts(){
    	$posts = Post::orderBy('id','desc')->paginate(15);
    	return view('Admin.all_posts',compact('posts'));
    }
    
    
    public function view_user_post($id){
      $data=Post::where('id',$id)->count();
    if($data>0){
    $data=Post::find($id);
    $user_phone=User::select('phone_no')->where('id',$data->user_id)->first();
    $data->phone=$user_phone->phone_no;
    return view('view_details',compact('data'));
     }
     return redirect()->back();
    }

    public function user_posts($user_id){
       $posts=Post::where('user_id',$user_id)->get();
       return view('Admin.user_posts',compact('posts'));
    }
    
    public function approve_post($id){
        $posts=Post::find($id);
        $posts->approve ="true";
        $posts->save();
        return redirect()->back();
    }
  
    
    public function deactive_post($id){
         $posts=Post::find($id);
        $posts->approve ="false";
        $posts->save();
        return redirect()->back();
    }

    public function delete_user_post($id){
      Post::destroy($id);
      unlink('storage/app/public/user_image/a'.$id.'.jpg');
      unlink('storage/app/public/user_image/b'.$id.'.jpg');
      unlink('storage/app/public/user_image/c'.$id.'.jpg');
      unlink('storage/app/public/user_image/d'.$id.'.jpg');
    	return redirect()->back();
    }

public function update_status(Request $request){
     $booking_id = $request->input('booking_id');
     $status = $request->input('status');
     if($status == 'Pending'){
         DB::table('booking')->where('id',$booking_id)->update(['status'=>'<span class="pending-color">Pending</span>']);
     }
     elseif($status == 'Accepted'){
         DB::table('booking')->where('id',$booking_id)->update(['status'=>'<span class="accepted-color">Accepted</span>']);
     }
     else{DB::table('booking')->where('id',$booking_id)->update(['status'=>'<span class="rejected-color">Rejected</span>']);}
     
     return redirect()->back();
}
}
