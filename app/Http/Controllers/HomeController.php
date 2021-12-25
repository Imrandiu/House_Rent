<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Payment;
use App\Image;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $id=Auth::user()->id;
       $posts= Post::where('user_id',$id)->get();
       return view('home',compact('posts'));
       /* $payment= Payment::where('user_id',$id)->get();
       return view('home',compact('payment'));*/
    }
    
    
     public function give_paymentss(){
         $posts= Post::where('user_id',Auth::user()->id)->get();
         $post_id = array();
         foreach($posts as $post){
             $post_id[] = $post->id;
         }
          $payment = DB::table('booking')->whereIn('post_id',$post_id)->get();
    	return view ('payment_list',compact('payment'));
    }
  /*  public function save_paymentss(Request $save){
       
          	$data=array();
    	$data['name']=$save->name;    
    	$data['title']=$save->title;
    	$data['transaction']=$save->transaction;
    	$data['taka']=$save->taka;
        $data['phone']=$save->phone;
    	$data['email']=$save->email;
         
    	DB::table('payment')->insert($data);
    	
    	return Redirect::to('/home');
    }*/
  
public function all_payment(){
    $payment = DB::table('payment')->select('id','name','title','transaction','phone','taka','email','created_at')->get();

        return view('Admin.all_payment')->with('payment', $payment);
        }
    
    
    

    public function give_post(){
        $address=Auth::user()->address;
        $lat=Auth::user()->lat;
        $longi=Auth::user()->longi;
     return view('give_post' ,compact('address','lat','longi'));
    }

    public function submit_post(Request $request){
       /* $request->validate([
            'image' => 'max:1500',
        ]);*/
        $data=$request->all();
        $post =new Post; $i=0;
        $post->save();$post_id=$post->id;

        $data['image'][0]->storeAs('public/post_image','a'.$post_id.'.jpg');
        $data['image'][1]->storeAs('public/post_image','b'.$post_id.'.jpg');
        $data['image'][2]->storeAs('public/post_image','c'.$post_id.'.jpg');
        $data['image'][3]->storeAs('public/post_image','d'.$post_id.'.jpg');

        $image_up=Image::insert([
                ['post_id' => $post_id,'image_name'=>'a'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'b'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'c'.$post_id.'.jpg'],
                ['post_id' => $post_id,'image_name'=>'d'.$post_id.'.jpg'],
                ]);

        $post=Post::find($post_id);
        $post->user_id=Auth::user()->id;
        foreach ($data as $key => $value) {
            if ($i>0) {
                if ($key !='image') {
                     $post->$key=$value;
                }
               
            }
            $i++;
        }
        if ($post->save()) {
            return redirect('home');
        }
        else{
            return redirect()->back();
        }
    }
    
    
    
    
 
 public function edit_post($id){
    $check=Post::where('id',$id)->where('user_id',Auth::user()->id)->count();
        if($check==1){
            $data=Post::find($id);
            $images=Post::find($id)->images;
          return view('edit_post',compact('data','images'));       
        }
        return redirect()->back();
    }

  public function submit_update_post(Request $request){
      
        $data=$request->all();
        $i=0;
        $image0= $request->file('image0');
        $image1= $request->file('image1');
        $image2= $request->file('image2');
        $image3= $request->file('image3');
        if($image0)
        $image0->storeAs('public/post_image','a'.$data['post_id'].'.jpg');
        if($image1)
        $image1->storeAs('public/post_image','b'.$data['post_id'].'.jpg');
       if($image2)
        $image2->storeAs('public/post_image','c'.$data['post_id'].'.jpg');
        if($image3)
        $image3->storeAs('public/post_image','d'.$data['post_id'].'.jpg');

        $post=Post::find($data['post_id']);
        foreach ($data as $key => $value) {
            if ($i>1) {
                if ($key !='image0' && $key !='image1' && $key !='image2' && $key !='image3') {
                     $post->$key=$value;
                }
               
            }
            $i++;
        }
        if ($post->save()) {
            return redirect('home');
        }
        else{
            return redirect()->back();
        }

 }
    public function delete_post($id){
       $check=Post::where([['user_id',Auth::user()->id],['id',$id]])->count();
        if($check==1){
          Post::find($id)->delete();
          return redirect()->back();
        }
    }

    
    public function view_profile(Request $request){
      $data = User::find(Auth::user()->id);
      return view('view_profile',compact('data'));
    }

    public function edit_profile(Request $request){
       $image= $request->file('image');
       $user = User::find(Auth::user()->id);
        if($image)
        {
        $image->storeAs('public/user_image',Auth::user()->id.'.jpg');
        $user->photo = Auth::user()->id.'.jpg';
        }
       $name= $request->input('name');
       $address= $request->input('address');
       $optional_phone= $request->input('optional_phone');
       $optional_email= $request->input('optional_email');

       
       $user->name = $name;
       $user->address = $address;
        $user->lat = $request->input('lat');
         $user->longi = $request->input('longi');
       $user->optional_phone = $optional_phone;
       $user->optional_email = $optional_email;
 
      if ($user->save()) {
          return redirect()->back();
      }
      else{return redirect()->back()->with($error_msg,'There Have Some Problems...Please Try Again..!!');}
    }
    


}
