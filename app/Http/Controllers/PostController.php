<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;      
use App\Photo; 
use Illuminate\Http\Request;

class PostController extends Controller
{
    function addPhoto($id)
    {
        $user = User::find($id);
        return view('user.addPhoto',["user" => $user]);
    }

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

            return view('user.photos',["user"=>$user]);
        }
    }
}
 