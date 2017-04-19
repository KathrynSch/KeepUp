@extends('user.profile')

@section('profileContent')

	@foreach($videos as $video)

			<div>
				<video width="320" height="240" controls>
  					<source src="{{asset('videos/'.$video->name) }}" >
				</video>
				
				<div>
					<h4>When: {{$video->date}}</h4>
					<h4>Where: {{$video->lieu}}</h4>
					<h4>What: {{$video->description}}</h4>
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
					<form role="form" method="POST" action="{{route('postComment', ['id_post' => $video->id_post])}}">
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
