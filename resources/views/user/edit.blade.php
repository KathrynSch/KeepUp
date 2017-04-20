@extends('layouts.app')

@section('content')
    <!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> -->
                <div class="editprofile">Edit your profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('postEdit', ['id' => $user->id])}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Your Status</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="{{ $user->status }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Profile picture</label>
	                        <span class="btn btn-default btn-file">
							    <input type="file" name="profile">
							</span>
						</div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Cover picture</label>
                            <span class="btn btn-default btn-file">
                                <input type="file" name="cover">
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="bttneditprofile">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
           <!--  </div>
        </div>
    </div>
</div> -->
@endsection