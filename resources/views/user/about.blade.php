@extends('user.profile')

@section('profileContent')
<!--Display Name -->
	<h1>{{$user->first_name}} {{$user->last_name}}</h1>
<!--Display Email -->
	<h3>{{$user->email}}</h3>
<!--Display Status -->
	<h3>{{$user->status}}</h3>
<!--Display profile picture -->
@if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp))
        <img src="{{ asset('images/pp/'.$user->id.'.'.$user->extension_pp) }}" style="max-height: 100%;max-width: 100%">
    @else
        <img src="{{ asset('images/pp/default.png') }}">
    @endif
<!--Display cover picture -->
@if(file_exists('images/cp/'.$user->id.'.'.$user->extension_cp))
        <img src="{{ asset('images/cp/'.$user->id.'.'.$user->extension_cp) }}">
    @else
        <img src="{{ asset('images/cp/default.jpg') }}">
    @endif
<!-- if user account profile-->
    @if(Auth::id() == $user->id)
        <a href="{{route('edit',['id' => $user->id])}}">Edit profile</a>
    @endif
@stop

@include('user.profile')