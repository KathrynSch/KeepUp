<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Auth;
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
    if($request->input('first_name')!=null){
      $user->first_name=$request->input('first_name');
    }
  	// Edit last name
    if($request->input('last_name')!=null){
      $user->last_name=$request->input('last_name');
    }
  	// Edit email
    if($request->input('email')!=null){
      $user->email=$request->input('email');
    } 
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
    $auth_id=Auth::id();                //auth user for reactions


    //fetch photos
    $photos= DB::table('photos')
              ->select('photos.*')
              ->orderBy('id','desc')
              ->join('posts','photos.id_post','=','posts.id')
              ->where('posts.id_user',$id)
              ->where('posts.type',1)
              ->get();
    
    $allComments=array();
    $allReactions=array();
    $userReactions=array();

    foreach ($photos as $photo){

      //fetch commentaires
      $comments= DB::table('comments')
                ->select('comments.*','users.first_name','users.last_name')
                ->join('posts','comments.id_post','=','posts.id')
                ->join('users','comments.id_user','=','users.id')
                ->where('posts.id',$photo->id_post)
                ->get();  
      array_push($allComments,$comments);


      //fetch reactions
    $countLikes=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$photo->id_post)
                ->where('reactions.type',1)
                ->get());

    $countLoves=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$photo->id_post)
                ->where('reactions.type',2)
                ->get());
    $countLaughs=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$photo->id_post)
                ->where('reactions.type',3)
                ->get());

    $countHates=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$photo->id_post)
                ->where('reactions.type',4)
                ->get());

    $counts=array($countLikes,$countLoves,$countLaughs,$countHates);
    array_push($allReactions, $counts);

    //fetch authenticated user reactions
    $hasReacted=DB::table('reactions')
              ->select('reactions.type')
              ->where('reactions.id_post',$photo->id_post)
              ->where('reactions.id_user',$auth_id)
              ->get();
      array_push($userReactions, $hasReacted);
    }

    $allComments=array_reverse($allComments);
    $allReactions=array_reverse($allReactions);
    $userReactions=array_reverse($userReactions);


    return view('user.photos',["photos"=>$photos],["user"=>$user])->with(compact('allComments','allReactions','userReactions'));
 	}


 	function videos($id){

    $user = User::find($id);
    $auth_id=Auth::id();                //auth user for reactions

    //fetch videos
    $videos= DB::table('videos')
              ->select('videos.*')
              ->orderBy('id','desc')
              ->join('posts','videos.id_post','=','posts.id')
               ->where('posts.id_user',$id)
              ->where('posts.type',2)
              ->get();

   
    $allComments=array();
    $allReactions=array();
    $userReactions=array();



    foreach ($videos as $video){

      //fetch commentaires
      $comments= DB::table('comments')
                ->select('comments.*','users.first_name','users.last_name')
                ->join('posts','comments.id_post','=','posts.id')
                ->join('users','comments.id_user','=','users.id')
                ->where('posts.id',$video->id_post)
                ->get();  
      array_push($allComments,$comments);
    
    
     //fetch reactions
    $countLikes=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$video->id_post)
                ->where('reactions.type',1)
                ->get());

    $countLoves=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$video->id_post)
                ->where('reactions.type',2)
                ->get());
    $countLaughs=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$video->id_post)
                ->where('reactions.type',3)
                ->get());

    $countHates=count(DB::table('reactions')
                ->select('reactions.*')
                ->where('reactions.id_post',$video->id_post)
                ->where('reactions.type',4)
                ->get());

    $counts=array($countLikes,$countLoves,$countLaughs,$countHates);
    array_push($allReactions, $counts);

    //fetch authenticated user reactions
    $hasReacted=DB::table('reactions')
              ->select('reactions.type')
              ->where('reactions.id_post',$video->id_post)
              ->where('reactions.id_user',$auth_id)
              ->get();
      array_push($userReactions, $hasReacted);
    }

    $allComments=array_reverse($allComments);
    $allReactions=array_reverse($allReactions);
    $userReactions=array_reverse($userReactions);


    return view('user.videos',["videos"=>$videos],["user"=>$user])->with(compact('allComments','allReactions','userReactions'));
 	}


 	


    //Display user events
  function events($id){
        $user = User::find($id);
        $auth_id=Auth::id();                //auth user for reactions


        //fetch events
        $events= DB::table('events')
                  ->select('events.*')
                  ->orderBy('id','desc')
                  ->join('posts','events.id_post','=','posts.id')
                  ->where('posts.id_user',$id)
                  ->where('posts.type',3)
                  ->get();

      $allComments=array();
      $allReactions=array();
      $userReactions=array();
        
    
        foreach ($events as $event){
          //fetch commentaires
          $comments= DB::table('comments')
                    ->select('comments.*','users.first_name','users.last_name')
                    ->join('posts','comments.id_post','=','posts.id')
                    ->join('users','comments.id_user','=','users.id')
                    ->where('posts.id',$event->id_post)
                    ->get();  
          array_push($allComments,$comments);
        
        //fetch reactions
        $countLikes=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_post',$event->id_post)
                    ->where('reactions.type',1)
                    ->get());

        $countLoves=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_post',$event->id_post)
                    ->where('reactions.type',2)
                    ->get());
        $countLaughs=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_post',$event->id_post)
                    ->where('reactions.type',3)
                    ->get());

        $countHates=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_post',$event->id_post)
                    ->where('reactions.type',4)
                    ->get());

        $counts=array($countLikes,$countLoves,$countLaughs,$countHates);
        array_push($allReactions, $counts);

        //fetch authenticated user reactions
        $hasReacted=DB::table('reactions')
                  ->select('reactions.type')
                  ->where('reactions.id_post',$event->id_post)
                  ->where('reactions.id_user',$auth_id)
                  ->get();
          array_push($userReactions, $hasReacted);
        }

        $allComments=array_reverse($allComments);
        $allReactions=array_reverse($allReactions);
        $userReactions=array_reverse($userReactions);








        return view('user.events',["events"=>$events],["user"=>$user])->with(compact('allComments','allReactions','userReactions'));
    }
}

