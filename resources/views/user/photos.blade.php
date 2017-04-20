@extends('user.profile')

@section('profileContent')

		

<div class="tab">
			
	@foreach($photos as $photo)

	

					<div class="pic">
						<img  class ="image" src="{{asset('images/photo/'.$photo->name) }}">

					</div>

			<div class="dessous">

					<div class="desc">
						<h4>When: {{$photo->date}}</h4>
						<h4>Where: {{$photo->lieu}}</h4>
						<h4>What: {{$photo->description}}</h4>
					</div>
				
				<!--reactions-->

				
					<div class="reac">
				
							
							<table style="width:60%" class="likes" >
						  <tr>

						    <th style="text-align: center"> <a href="{{ route('likes',['id' => $photo->id_post]) }}"> <img src="{{asset('images/like.png')}}" alt="love" height="30"/> </a></th> 

						    <th style="text-align: center"><a href="{{ route('loves',['id' => $photo->id_post]) }}"> <img src="{{asset('images/love.png')}}" alt="love" height="30"/></a></th> 
						    <th style="text-align: center"><a href="{{ route('laughs',['id' => $photo->id_post]) }}"><img src="{{asset('images/laugh.png')}}" alt="love" height="30"/></a></th>
						    <th style="text-align: center"><a href="{{ route('hates',['id' => $photo->id_post]) }}"><img src="{{asset('images/angry.png')}}" alt="love" height="30"/></a></th>
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

						<form role="form" method="POST" action="{{route('postComment', ['id_post' => $photo->id_post])}}">
						{{ csrf_field() }}
						    <div class="input-group">
						      <input type="text" class="form-control" size="500" name="comment" placeholder="Comment...">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="submit">Comment</button>
						      </span>
						    </div><!-- /input-group -->
						</form>
						</div><!-- /.col-lg-6 -->

					</div>
			</div>
			
	</div>

	
			
					


	
		
	@endforeach

@endsection
	