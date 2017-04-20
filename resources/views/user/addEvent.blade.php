@extends('user.profile')

@section('profileContent')
	<!-- <div class="container">
    	<div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default"> -->
            <div class="editprofile">Create your event</div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('postAddEvent', ['id' => $user->id])}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <!--Name-->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>

                        <!--Where-->
                        <div class="form-group">
                            <label for="where" class="col-md-4 control-label">Where</label>

                            <div class="col-md-6">
                                <input id="where" type="text" class="form-control" name="where" value="" required autofocus>
                            </div>
                        </div>
                        <!--When-->
                        <div class="form-group">
                            <label for="when" class="col-md-4 control-label">When</label>

                            <div class="col-md-6">
                                <input id="when" type="date" class="form-control" name="when" value="" required autofocus>
                            </div>
                        </div>
                        <!--What-->
                        <div class="form-group">
                            <label for="what" class="col-md-4 control-label">What</label>

                            <div class="col-md-6">
                                <input id="what" type="textarea" rows="10" class="form-control" name="what" value="" required autofocus>
                            </div>
                        </div>
                        <!--SUBMIT-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="bttneditprofile">
                                    Publish
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection