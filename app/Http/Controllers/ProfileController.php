<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
	return redirect()->route('profile',["id" => $user->id]);

   	}

   	function photos($id){
   		$user = User::find($id);
   		return view('user.photos',["user"=>$user]);
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