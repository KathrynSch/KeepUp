@extends('user.profile')

@section('profileContent')

	@foreach($photos as $photo)
			<div>
				<img src="{{asset('images/photo/'.$photo->name) }}" width="100" height="100">
				<div>
					<h4>{{$photo->date}}</h4>
					<h4>{{$photo->lieu}}</h4>
					<h4>{{$photo->description}}</h4>
				</div>
				<div>
					<!--comments-->
					<!--form/input text/submit-->

				</div>
				<div>
					<!--reactions-->
				</div>
			</div>
		
	@endforeach

@endsection
