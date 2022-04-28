<?php
        if (!session()->has('user_id')) {
            redirect("/");
        }
        $user = App\Models\User::where('user_id', session('user_id'))->first(); 
        $username = $user->username;
        $email = $user->email;
        $picture = $user->profilepicture;
   ?>
@extends('layout.master')

@section('content')


    <!--Container-->
    <div class="container" id="container" style="backdrop-filter:contrast(40%); ">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">

                <h2>General Account Settings:</h2>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered">
                        <tr data-target="#updateusername" data-toggle="modal">
                            <td>Username</td>
                            <td> {{$username}}</td>
                        </tr>
                        <tr data-target="#updateemail" data-toggle="modal">
                            <td>Email</td>
                            <td>{{ $email }}</td>
                        </tr>
                        <tr data-target="#updatepassword" data-toggle="modal">
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                        <tr data-target="#updatepicture" data-toggle="modal">
                            <td>Picture</td>
                            <td> <img class='' src="{{$picture}}" /> </td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <!--Update username-->
    <form method="post" id="updateusernameform">
        @csrf
        <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Edit Username:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--update username message from PHP file-->
                        <div id="updateusernamemessage"></div>


                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" maxlength="30"
                                value="<?php echo $username; ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updateusername" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Update email-->
    <form method="post" id="updateemailform">
        @csrf
        <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Enter new email:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Update email message from PHP file-->
                        <div id="updateemailmessage"></div>


                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="50"
                                value="<?php echo $email ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updateusername" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Update password-->
    <form method="post" id="updatepasswordform">
        @csrf
        <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Enter Current and New password:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Update password message from PHP file-->
                        <div id="updatepasswordmessage"></div>


                        <div class="form-group">
                            <label for="currentpassword" class="sr-only">Your Current Password:</label>
                            <input class="form-control" type="password" name="currentpassword" id="currentpassword"
                                maxlength="30" placeholder="Your Current Password">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Choose a password:</label>
                            <input class="form-control" type="password" name="password" id="password" maxlength="30"
                                placeholder="Choose a password">
                        </div>
                        <div class="form-group">
                            <label for="password2" class="sr-only">Confirm password:</label>
                            <input class="form-control" type="password" name="password2" id="password2" maxlength="30"
                                placeholder="Confirm password">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updateusername" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Update picture-->
    <form method="post" enctype="multipart/form-data" id="updatepictureform">
        @csrf
        <div class="modal" id="updatepicture" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            Upload Picture:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Update picture message from PHP file-->
                        <div id="updatepicturemessage"></div>
                
   
             @if(empty($picture)) 
               <div class='image_preview'><img id='previewing' src="{{asset('images/noimage.jpg')}}"/></div>
             @else 
              <div class='image_preview'><img id='previewing' src='$picture' /></div>
            
          @endif
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="picture">Select a picture:</label>
                                <input type="file" name="picture" id="picture">
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updatepicture" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Footer-->
    <div class="footer">
        <div class="container">
            <p>sajid parwez &copy; 2015-<?php  date("Y"); ?>.</p>
        </div>
    </div>
    <!--Spinner-->
    <div id="spinner">
        <img src='{{asset("images/ajax-loader.gif")}}' width="64" height="64" />
        <br>Loading..
    </div>

@endsection

