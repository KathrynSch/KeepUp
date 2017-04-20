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
      //fetch commentaires
      $allComments=array();
      foreach ($photos as $photo){
        $comments= DB::table('comments')
                  ->select('comments.*','users.first_name','users.last_name')
                  ->join('posts','comments.id_post','=','posts.id')
                  ->join('users','comments.id_user','=','users.id')
                  ->where('posts.id',$photo->id_post)
                  ->get();  
        array_push($allComments,$comments);
      }

      $allComments=array_reverse($allComments);

      //fetch reactions

   		return view('user.photos',["photos"=>$photos],["user"=>$user])->with('allComments',$allComments);
   	}


   	function videos($id){
      $user = User::find($id);

      //fetch videos
      $videos= DB::table('videos')
                ->select('videos.*')
                ->orderBy('id','desc')
                ->join('posts','videos.id_post','=','posts.id')
                ->where('posts.id_user',$id)
                ->where('posts.type',2)
                ->get();

      //fetch commentaires
      $allComments=array();
      foreach ($videos as $video){
        $comments= DB::table('comments')
                  ->select('comments.*','users.first_name','users.last_name')
                  ->join('posts','comments.id_post','=','posts.id')
                  ->join('users','comments.id_user','=','users.id')
                  ->where('posts.id',$video->id_post)
                  ->get();  
        array_push($allComments,$comments);
      }
      $allComments=array_reverse($allComments);

      //fetch reactions

      return view('user.videos',["videos"=>$videos],["user"=>$user])->with('allComments',$allComments);
   	}

   	function messages($id){
   		echo $id;
   	}
}

//Display user events
function events($id){
      $user = User::find($id);
      //fetch events
      $events= DB::table('events')
                ->select('events.*')
                ->orderBy('id','desc')
                ->join('posts','events.id_post','=','posts.id')
                ->where('posts.id_user',$id)
                ->where('posts.type',3)
                ->get();

                dd($events);
      //fetch commentaires
      $allComments=array();
      foreach ($events as $event){
        $comments= DB::table('comments')
                  ->select('comments.*','users.first_name','users.last_name')
                  ->join('posts','comments.id_post','=','posts.id')
                  ->join('users','comments.id_user','=','users.id')
                  ->where('posts.id',$event->id_post)
                  ->get();  
        array_push($allComments,$comments);
      }

      $allComments=array_reverse($allComments);

      //fetch reactions

      return view('user.events',["events"=>$events],["user"=>$user])->with('allComments',$allComments);
}
