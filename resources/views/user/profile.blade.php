@extends('layouts.app')
@section('content')
<!--Display Name -->
	<h1>{{$user->first_name}} {{$user->last_name}}</h1>
<!--Display profile picture -->
@if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp))
        <img src="{{ asset('images/pp/'.$user->id.'.'.$user->extension_pp) }}" class="img-rounded" height="30" width="30px">
    @else
        <img src="{{ asset('images/pp/default.png') }}" class="img-rounded" height="30" width="30px">
    @endif
<div>
		<ul class="nav nav-tabs">
		<li role="presentation" ><a href="{{ route('about',['id' => $user->id]) }}">About</a></li>
	 @if(Auth::id() == $user->id)
		<li role="presentation" ><a href="{{ route('addPhoto',['id' => $user->id]) }}"><span class="glyphicon glyphicon-plus"></span></a></li>
	@endif
	  	<li role="presentation" ><a href="{{ route('profilePhotos',['id' => $user->id]) }}">Photos</a></li>

	@if(Auth::id() == $user->id)
		<li role="presentation" ><a href="{{ route('addVideo',['id' => $user->id]) }}"><span class="glyphicon glyphicon-plus"></span></a></li>
	@endif
	  	<li role="presentation"><a href="{{ route('profileVideos',['id' => $user->id]) }}">Videos</a></li>
	@if(Auth::id() == $user->id)
		<li role="presentation" ><a href="{{ route('addEvent',['id' => $user->id]) }}"><span class="glyphicon glyphicon-plus"></span></a></li>
	@endif
	  	<li role="presentation"><a href="{{ route('profileEvents',['id' => $user->id]) }}">Events</a></li>
	  	<!-- if user account profile-->
    @if(Auth::id() == $user->id)
        <li role="presentation"><a href="{{ route('userMessages',['id' => $user->id]) }}">Messages</a></li>
    @endif
	</ul>
@yield('profileContent')
</div>

@endsection
	




