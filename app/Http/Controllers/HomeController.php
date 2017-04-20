<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\User;

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
        return view('home');
    }

    public function search(Request $request)
    {
        $content=$request->input('content');

        if(strchr($content," "))
        {
             $content=explode(" ", $content);
            $result=DB::table('users')
                    ->select('id')
                    ->where('users.first_name',$content[0])
                    ->where('users.last_name',$content[1])
                    ->first();

        $isFound=count($result);
       
            if($isFound==1)
            {
                return redirect()-> route('about',["id"=>$result->id]);
            }

            else {return view('searchError');
            }

        }

        else
        {
            return view('searchError');

        }

    }
}
