@extends('user.profile')

@section('profileContent')

    <div class="about">
    <div class="container1">

        <div class="item">
        <!--Display Name -->
        <div class="name">
        	<h1>{{$user->first_name}} {{$user->last_name}}</h1> 
        </div>
        <!--Display Email -->
        	<h3>{{$user->email}}</h3>
        <!--Display Status -->
        	<h3>{{$user->status}}</h3>

                <div class="editpro">
                @if(Auth::id() == $user->id)
                    <a class="edit" href="{{route('edit',['id' => $user->id])}}">  Edit profile</a> 
                    
                   
                @endif
               </div>
        </div>

        <div class="item">
            <!--Display profile picture -->
           

            @if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp))
                    <img  class ="ppicture" src="{{ asset('images/pp/'.$user->id.'.'.$user->extension_pp) }}" style="max-height: 100%;max-width: 100%">
                @else
                    <img class ="ppicture" src="{{ asset('images/pp/default.png') }}">
                @endif

        </div>
        
    </div>

    <div class="container2">
            
            <div class="item2">
            <!--Display cover picture -->

            @if(file_exists('images/cp/'.$user->id.'.'.$user->extension_cp))
                    <img class="coverpicture" src="{{ asset('images/cp/'.$user->id.'.'.$user->extension_cp) }}">
                @else
                    <img class="coverpicture" src="{{ asset('images/cp/default.jpg') }}">
                @endif
            </div>
        
       

        <div class="item2">
            <!-- if user account profile-->


           
        </div>
    </div>

</div>



@endsection

