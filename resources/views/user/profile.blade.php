@extends('layouts.app')

@section('content')
    @if(file_exists('images/pp/'.$user->id.'.'.$user->extension_pp))
        <img src="{{ asset('images/pp/'.$user->id.'.'.$user->extension_pp) }}">
    @else
        <img src="{{ asset('images/pp/default.png') }}">
    @endif
    @if(Auth::id() == $user->id)
        <a href="{{route('edit',['id' => $user->id])}}">Edit profile</a>
    @endif
@endsection