@extends('user.profile')

@section('profileContent')

	@foreach($events as $event)

			<div>
				<h2>{{$event->name}}</h2>
				<h3>When: {{$event->date}}</h3>
				<h3>Where: {{$event->lieu}}</h3>
				<h3>What: {{$event->description}}</h3>
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
					<form role="form" method="POST" action="{{route('postComment', ['id_post' => $event->id_post])}}">
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
					<table style="width:15%">
				  <tr>
				    <th width="10"><a href="{{ route('likes',['id' => $event->id_post]) }}">Like</a></th>
				    <th><a href="{{ route('loves',['id' => $event->id_post]) }}">Love</a></th> 
				    <th><a href="{{ route('laughs',['id' => $event->id_post]) }}">Laugh</a></th>
				    <th><a href="{{ route('hates',['id' => $event->id_post]) }}">Hate</a></th>
				  </tr>
				  <tr>
						<!--Reactions count-->
					    @foreach($table=array_pop($allReactions) as $reaction)
					    		<th width="10">{{($reaction)}}</th>   
					    @endforeach
					</tr>
					</table>
				</div>
			</div>
		
	@endforeach

@endsection
