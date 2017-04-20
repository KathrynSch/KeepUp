@extends('user.profile')

@section('profileContent')

<div class="tab">

	@foreach($videos as $video)

			<div class="pic";>
				<video width="500" controls>

  					<source  src="{{asset('videos/'.$video->name) }}" >
				</video>
			</div>



			<div class="dessous">

				<div class="desc">
				<div class="option">
					<div class="supp">
						<a href="{{ route('deleteVideo',['id' => $video->id_post]) }}">Delete</a>
					</div>
				</div>

					<h4>When: {{$video->date}}</h4>
					<h4>Where: {{$video->lieu}}</h4>
					<h4>What: {{$video->description}}</h4>
				</div>


				<div class="reac">
						<!--reactions-->
						<table  class="likes">
					  <tr>
					    <th style="text-align: center"><a href="{{ route('likes',['id' => $video->id_post]) }}"><img src="{{asset('images/like.png')}}" alt="love" height="30"/></a></th>
					    <th style="text-align: center"><a href="{{ route('loves',['id' => $video->id_post]) }}"><img src="{{asset('images/love.png')}}" alt="love" height="30"/></a></th> 
					    <th style="text-align: center"><a href="{{ route('laughs',['id' => $video->id_post]) }}"><img src="{{asset('images/angry.png')}}" alt="love" height="30"/></a></th>
					    <th style="text-align: center"><a href="{{ route('hates',['id' => $video->id_post]) }}"><img src="{{asset('images/laugh.png')}}" alt="love" height="30"/></a></th>
					  </tr>
					  <tr>
							<!--Reactions count-->
						    @foreach($table=array_pop($allReactions) as $reaction)
						    		<th style="text-align: center">{{($reaction)}}</th>   
						    @endforeach
						</tr>
						</table>
				</div>
				


				
					<!--comments-->
					
					
					@foreach($comments=array_pop($allComments) as $item)
							<div class="comments">
								<div class="name-commment">
									<span>{{$item->first_name}} {{$item->last_name}}</span> 
									<span>{{$item->comm}}</span>
								</div> 

								<div class="time">
									<span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
							 		
							 	</div>
						</div>	
					@endforeach


					<!--form/input text/submit-->
					<div class="textsub">
						<div class="col-lg-6">
							<form role="form" method="POST" action="{{route('postComment', ['id_post' => $video->id_post])}}">
							{{ csrf_field() }}
							    <div class="input-group">
							      <input type="text" class="form-control" name="comment" placeholder="Comment...">
							      <span class="input-group-btn"> <button class="btn btn-default" type="submit">Comment</button>
							      </span>
							    </div><!-- /input-group -->

							</form>
						</div><!-- /.col-lg-6 -->

					</div>

			
				
			</div>

	</div>
		
	@endforeach

@endsection
