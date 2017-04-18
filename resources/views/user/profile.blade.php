@extends('layouts.app')

@section('Content')
<div>
		<ul class="nav nav-tabs">
		<li role="presentation" ><a href="{{ route('about',['id' => $user->id]) }}">About</a></li>
	  	<li role="presentation" ><a href="{{ route('profilePhotos',['id' => $user->id]) }}">Photos</a></li>
	  	<li role="presentation"><a href="{{ route('profileVideos',['id' => $user->id]) }}">Videos</a></li>
	  	<li role="presentation"><a href="{{ route('profileEvents',['id' => $user->id]) }}">Events</a></li>
	  	<!-- if user account profile-->
    @if(Auth::id() == $user->id)
        <li role="presentation"><a href="{{ route('userMessages',['id' => $user->id]) }}">Messages</a></li>
    @endif
	</ul>
@yield('profileContent')
</div>

@show
	




