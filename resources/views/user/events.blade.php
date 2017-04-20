@extends('user.profile')

@section('profileContent')

<div class="tab">

	@foreach($events as $event)
	<div class="dessous">

			<div class="desc-event">
			
				<div class="option">
					<div class="supp">
						<a href="{{ route('deleteEvent',['id' => $event->id_post]) }}">Delete</a>
					</div>
				</div>

				<h2>{{$event->name}}</h2>
				<h3>When: {{$event->date}}</h3>
				<h3>Where: {{$event->lieu}}</h3>
				<h3>What: {{$event->description}}</h3>
			</div>
					<!--comments-->
					
			<div class="reac">
				<!--reactions-->
					<table  class="likes">
				  <tr>
				    <th style="text-align: center"><a href="{{ route('likes',['id' => $event->id_post]) }}"><img src="{{asset('images/like.png')}}" alt="love" height="30"/></a></th>
				    <th style="text-align: center"><a href="{{ route('loves',['id' => $event->id_post]) }}"><img src="{{asset('images/love.png')}}" alt="love" height="30"/></a></th> 
				    <th style="text-align: center"><a href="{{ route('laughs',['id' => $event->id_post]) }}"><img src="{{asset('images/angry.png')}}" alt="love" height="30"/></a></th>
				    <th style="text-align: center"><a href="{{ route('hates',['id' => $event->id_post]) }}"><img src="{{asset('images/laugh.png')}}" alt="l" height="30"/></a></th>
				  </tr>
				  <tr>
						<!--Reactions count-->
					    @foreach($table=array_pop($allReactions) as $reaction)
					    		<th style="text-align: center" width="10" >{{($reaction)}}</th>   
					    @endforeach
				  </tr>
					</table>
			</div>
					
				
		
					@foreach($comments=array_pop($allComments) as $item)

						<div class="comments">
								<div class="name-commment">
									<span style="font-weight:bold">{{$item->first_name}} {{$item->last_name}}</span> 
									<span>{{$item->comm}}</span>
								</div> 

								<div class="time">
									<span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
							 		
							 	</div>
						</div>	
					@endforeach
		

		<div class="textsub">
				<!-- <div class="textsub"> -->
					<!--form/input text/submit-->
					<div class="col-lg-6">
					<form role="form" method="POST" action="{{route('postComment', ['id_post' => $event->id_post])}}">
					{{ csrf_field() }}
					    
					    <div class="input-group">
					      <input type="text" class="form-control" name="comment" placeholder="Comment...">
					      <div class="input-group-btn">
					        <button class="btn btn-default" type="submit">Comment</button>
					      </div>
					    </div><!-- /input-group -->
					</form>
				<!-- 	</div> -->
		
	</div>
		</div>


	</div>
				
		
	@endforeach
	
</div>

@endsection
