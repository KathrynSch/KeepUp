@extends('user.profile')

@section('profileContent')

    <div class="about">
    <div class="container1">
        @if($typeProfile==2)
            <!--Display Button UnFollow -->
               
            <a href="{{route('unfollow',['id' => $user->id])}}">Unfollow </a>
         @endif
         @if($typeProfile==3)
            <!--Display Button UnFollow -->
               
            <a href="{{route('follow',['id' => $user->id])}}">Follow </a>
         @endif


        <div class="item">
        <!--Display Name -->
        	<h1>{{$user->first_name}} {{$user->last_name}}</h1>
            
        <!--Display Email -->
        	<h3>{{$user->email}}</h3>
        <!--Display Status -->
        	<h3>{{$user->status}}</h3>
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


            <footer>
                @if(Auth::id() == $user->id)
                    <a class="edit" href="{{route('edit',['id' => $user->id])}}">  Edit profile</a>
                @endif
               
            </footer>
        </div>
    </div>

</div>



@endsection

