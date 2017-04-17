<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
	function show($id){
		$user = User::find($id);
		return view('user.profile', ["user" => $user]);
	}
	function edit($id){
        $user = User::find($id);
		return view('user.edit',["user" => $user]);
	}

	function editSubmit(Request $request, $id){
		if($request->file('pic') != null){
			$user = User::find($id);
        	$file = $request->file('pic');
        	$file_name = $file->getClientOriginalName();
        	$extension = pathinfo($file_name, PATHINFO_EXTENSION);

        	if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp)){
        		unlink('images/pp/'.$user->id.'.'.$user->extension_pp);
        	}

        	$file->move('images/pp/', $user->id.'.'.$extension);

        	$user->extension_pp = $extension;
        	$user->save();
		}

		return redirect()->route('profile',["id" => $user->id]);

   	}
}