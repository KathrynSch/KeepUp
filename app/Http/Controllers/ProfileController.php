<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Post;
use App\User;      
use App\Photo;
use App\Video;
use App\Event;
use App\Comment;
use App\Reaction; 
class ProfileController extends Controller
{
	function show($id){
		$user = User::find($id);
		return view('user.about', ["user" => $user]);
	}
	function edit($id){
    $user = User::find($id);
		return view('user.edit',["user" => $user]);
	}

	function editSubmit(Request $request, $id){
	$user = User::find($id);
	// Edit first name
	// Edit last name
	// Edit email
	// Edit status
		if($request->input('status')!=null){
			$user->status=$request->input('status');
		}
	// Edit profile pic
		if($request->file('profile') != null){
        	$file = $request->file('profile');
        	$file_name = $file->getClientOriginalName();
        	$extension = pathinfo($file_name, PATHINFO_EXTENSION);

        	if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp)){
        		unlink('images/pp/'.$user->id.'.'.$user->extension_pp);
        	}

        	$file->move('images/pp/', $user->id.'.'.$extension);

        	$user->extension_pp = $extension;
        }
        	
	// Edit cover pic
        if($request->file('cover') != null){
        	$file = $request->file('cover');
        	$file_name = $file->getClientOriginalName();
        	$extension = pathinfo($file_name, PATHINFO_EXTENSION);

        	if(file_exists('images/cp/'.$user->id.'.'.$user->extension_cp)){
        		unlink('images/cp/'.$user->id.'.'.$user->extension_cp);
        	}

        	$file->move('images/cp/', $user->id.'.'.$extension);

        	$user->extension_cp = $extension;
        }
		
	$user->save();
	return redirect()->route('about',["id" => $user->id]);

   	}

   	function photos($id){
   		$user = User::find($id);
      //fetch photos
      $photos= DB::table('photos')
                ->select('photos.*')
                ->orderBy('id','desc')
                ->join('posts','photos.id_post','=','posts.id')
                ->where('posts.id_user',$id)
                ->where('posts.type',1)
                ->get();
      //dd($photos);
      //dd($user);
      //fetch commentaires
      //fetch reactions
   		return view('user.photos',["photos"=>$photos],["user"=>$user]);
   	}
   	function videos($id){
   		echo $id;
   	}
   	function events($id){
   		echo $id;
   	}
   	function messages($id){
   		echo $id;
   	}

}