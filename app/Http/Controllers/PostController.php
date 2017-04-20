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
use App\Follow;     
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



//// REACTIONS

//likes

    function likes($id_post){    //id du post réagit
        $user=User::find(Auth::id());

         //verifie si autre reaction
        $isReacted=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->get());
            //si aucune reaction ailleurs --> on peut liker
        if($isReacted==0)
        {
            $like=new Reaction();
            $like->id_post=$id_post;
            $like->id_user=$user->id;
            $like->type=1;

            $like->save();
        }
            // si reaction ailleurs --> on regarde si c'est un like
        else{
            $isLiked=count(DB::table('reactions')
            ->select('reactions.*')
            ->where('reactions.id_user',$user->id)
            ->where('reactions.id_post',$id_post)
            ->where('reactions.type',1)
            ->get());
                // si c'est un like --> on unlike
            if($isLiked==1){
                $unLike=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->where('reactions.type',1)
                    ->delete();
            }
                // sinon = autre reac --> on delete et on like
            else{
                $unReact=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->delete();
                $like=new Reaction();
                    $like->id_post=$id_post;
                    $like->id_user=$user->id;
                    $like->type=1;
                    $isReacted=1;

                    $like->save();
            }
        }

        return redirect()->back();
    }

//loves
function loves($id_post){    //id du post réagit
        $user=User::find(Auth::id());

         //verifie si autre reaction
        $isReacted=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->get());
            //si aucune reaction ailleurs --> on peut love
        if($isReacted==0)
        {
            $love=new Reaction();
            $love->id_post=$id_post;
            $love->id_user=$user->id;
            $love->type=2;

            $love->save();
        }
            // si reaction ailleurs --> on regarde si c'est un love
        else{
            $isLoved=count(DB::table('reactions')
            ->select('reactions.*')
            ->where('reactions.id_user',$user->id)
            ->where('reactions.id_post',$id_post)
            ->where('reactions.type',2)
            ->get());
                // si c'est un love --> on unlove
            if($isLoved==1){
                $unLove=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->where('reactions.type',2)
                    ->delete();
            }
                // sinon = autre reac --> on delete et on love
            else{
                $unReact=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->delete();
                $love=new Reaction();
                    $love->id_post=$id_post;
                    $love->id_user=$user->id;
                    $love->type=2;

                    $love->save();
            }
        }

        return redirect()->back();
    }

//laughs
function laughs($id_post){    //id du post réagit
        $user=User::find(Auth::id());

         //verifie si autre reaction
        $isReacted=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->get());
            //si aucune reaction ailleurs --> on peut laugh
        if($isReacted==0)
        {
            $laugh=new Reaction();
            $laugh->id_post=$id_post;
            $laugh->id_user=$user->id;
            $laugh->type=3;

            $laugh->save();
        }
            // si reaction ailleurs --> on regarde si c'est un laugh
        else{
            $isLaughed=count(DB::table('reactions')
            ->select('reactions.*')
            ->where('reactions.id_user',$user->id)
            ->where('reactions.id_post',$id_post)
            ->where('reactions.type',3)
            ->get());
                // si c'est un laugh --> on unlaugh
            if($isLaughed==1){
                $unlaugh=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->where('reactions.type',3)
                    ->delete();
            }
                // sinon = autre reac --> on delete et on laugh
            else{
                $unReact=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->delete();
                $laugh=new Reaction();
                    $laugh->id_post=$id_post;
                    $laugh->id_user=$user->id;
                    $laugh->type=3;

                    $laugh->save();
            }
        }

        return redirect()->back();
    }


//hates
function hates($id_post){    //id du post réagit
$user=User::find(Auth::id());

         //verifie si autre reaction
        $isReacted=count(DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->get());
            //si aucune reaction ailleurs --> on peut hate
        if($isReacted==0)
        {
            $hate=new Reaction();
            $hate->id_post=$id_post;
            $hate->id_user=$user->id;
            $hate->type=4;

            $hate->save();
        }
            // si reaction ailleurs --> on regarde si c'est un hate
        else{
            $isHated=count(DB::table('reactions')
            ->select('reactions.*')
            ->where('reactions.id_user',$user->id)
            ->where('reactions.id_post',$id_post)
            ->where('reactions.type',4)
            ->get());
                // si c'est un hate --> on unhate
            if($isHated==1){
                $unHate=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->where('reactions.type',4)
                    ->delete();
            }
                // sinon = autre reac --> on delete et on hate
            else{
                $unReact=DB::table('reactions')
                    ->select('reactions.*')
                    ->where('reactions.id_user',$user->id)
                    ->where('reactions.id_post',$id_post)
                    ->delete();
                $hate=new Reaction();
                    $hate->id_post=$id_post;
                    $hate->id_user=$user->id;
                    $hate->type=4;

                    $hate->save();
            }
        }

        return redirect()->back();
    }
}