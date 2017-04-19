<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Post;
use App\User;      
use App\Photo;
use App\Video;
use App\Event;
use App\Comment;
use App\Reaction;     
use Illuminate\Http\Request;

class PostController extends Controller
{
    //ajouter une photo
    function addPhoto($id)
    {
        $user = User::find($id);
        return view('user.addPhoto',["user" => $user]);
    }

    //Ajouter la submission d'une photo
    function addPhotoSubmit(Request $request, $id){
        $user = User::find($id);
        //Validation
        if($request->file('photo') != null){

            // Creation post
            $post=new Post();
            $post->id_user=$user->id;
            $post->type=1;

            $post->save();
            //$request->user()->post()->save($post);

            //Creation post photo
            $photo=new Photo();
            $photo->id_post=$post->id;
            //File
            $file = $request->file('photo');
            $photo->name= $file->getClientOriginalName(); //get file name with extension
            $file->move('images/photo/', $photo->name);
            //Where
            $photo->lieu=$request->where;
            //When
            $date=$request->when;
            //$date=explode('/', $date);
            //$date=array_reverse($date);
            //$date=implode('-',$date);
            $photo->date=$date;
            //What
            $photo->description=$request->what;
            
            $photo->save();

            return redirect()->route('profilePhotos', ['id' => $id]);
        }
    }


    //Ajouter une video
    function addVideo($id)
    {
        $user = User::find($id);
        return view('user.addVideo',["user" => $user]);
    }

    //Ajouter la submission d'une video
    function addVideoSubmit(Request $request, $id){
        $user = User::find($id);
        //Validation
        if($request->file('video') != null){

            // Creation post
            $post=new Post();
            $post->id_user=$user->id;
            $post->type=2;

            $post->save();

            //Creation post video
            $video=new Video();
            $video->id_post=$post->id;
            //File
            $file = $request->file('video');
            $video->name= $file->getClientOriginalName(); //get file name with extension
            $file->move('videos/', $video->name);
            //Where
            $video->lieu=$request->where;
            //When
            $date=$request->when;
            $video->date=$date;
            //What
            $video->description=$request->what;
            
            $video->save();

            return redirect()->route('profileVideos', ['id' => $id]);
        }
    }


    //Ajouter un event
    function addEvent($id)
    {
        $user = User::find($id);
        return view('user.addEvent',["user" => $user]);
    }

    //Ajouter la submission d'un event
    function addEventSubmit(Request $request, $id){
        $user = User::find($id);

        // Creation post
        $post=new Post();
        $post->id_user=$user->id;
        $post->type=3;

        $post->save();

        //Creation post event
        $event=new Event();
        $event->id_post=$post->id;
        //Where
        $event->name=$request->name;
        //Where
        $event->lieu=$request->where;
        //When
        $event->date=$request->when;
        //What
        $event->description=$request->what;
        
        $event->save();

        return redirect()->route('profileEvents', ['id' => $id]);

    }

    function addComment(Request $request, $id_post) //id du post commenté
    {
        $user = User::find(Auth::id()); //user qui commente
        //crée commentaire
        $comment=new Comment();
        //id user
        $comment->id_user=$user->id;
        //id post
        $comment->id_post=$id_post;
        //comment
        $comment->comm=$request->comment;

        $comment->save();

        return redirect()->back();
    }
}
 