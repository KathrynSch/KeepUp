@extends('user.profile')

@section('profileContent')

	@foreach($photos as $photo)

			<div>
				<img src="{{asset('images/photo/'.$photo->name) }}" width="100" height="100">
				<div>
					<h4>When: {{$photo->date}}</h4>
					<h4>Where: {{$photo->lieu}}</h4>
					<h4>What: {{$photo->description}}</h4>
				</div>
				<div>
					<!--comments-->
					
					
					@foreach($comments=array_pop($allComments) as $item)
						<div>
							<span>{{$item->first_name}} {{$item->last_name}}</span> <span>{{$item->comm}}</span>
							<span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
						</div> 
					@endforeach
					<!--form/input text/submit-->
					<div class="col-lg-6">
					<form role="form" method="POST" action="{{route('postComment', ['id_post' => $photo->id_post])}}">
					{{ csrf_field() }}
					    <div class="input-group">
					      <input type="text" class="form-control" name="comment" placeholder="Comment...">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="submit">Comment</button>
					      </span>
					    </div><!-- /input-group -->
					</form>
					</div><!-- /.col-lg-6 -->

				</div>
				<div>
					<!--reactions-->
				</div>
			</div>
		
	@endforeach

@endsection
