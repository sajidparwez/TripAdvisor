@extends('layout.master')

@section('content')

    <div class="row">
       
        <div class="col-md-6 col-md-offset-3">
            @if(!session()->has("user_id")) 
            <button center type="button" class="btn btn-lg green signup " data-toggle="modal" data-target="#signupModal">Sign up</button>          
           @endif
            <h1>Plan your next trip now!</h1>
            <p class="lead">Save Money! Save the Environment!</p>
            <p class="bold">You can save up to 100$ a year using car sharing!
            </p>
            <!--Search Form-->
            <form class="form-inline" method="get" id="searchform">
               @csrf
                <div class="form-group">
                    <label class="sr-only" for="departure">Departure:</label>
                    <input type="text" class="form-control" id="departure" placeholder="Departure" name="departure">
                </div>
                <div class="form-group">
                    <label class="sr-only"></label>
                    <input type="text" class="form-control" id="destination" placeholder="Destination"
                        name="destination">
                </div>
                <input type="submit" value="Search" class="btn btn-lg green" name="search">

            </form>
            <!--Search Form End-->

            <!--Google Map-->
            <div id="googleMap"></div>

            <!--Sign up button-->

          
            <div id="results">
                <!--will be filled with Ajax Call-->
            </div>

        </div>

    </div>



<!--Login form-->
<form method="POST" id="loginform" >
    @csrf
   
    <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                        &times;
                    </button>
                         <h4 id="myModalLabel">
                             Login :  
                        </h4>
                </div>
                <div class="modal-body">

                    <!--Login message from PHP file-->
                    <div id="loginmessage"></div>


                    <div class="form-group">
                        <label for="loginemail" class="sr-only">Email:</label>
                        <input class="form-control" type="email" name="loginemail" id="loginemail"
                            placeholder="Email" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="loginpassword" class="sr-only">Password</label>
                        <input class="form-control" type="password" name="loginpassword" id="loginpassword"
                            placeholder="Password" maxlength="30">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="rememberme" id="rememberme">
                            Remember me
                        </label>
                        <a class="pull-right" style="cursor: pointer" data-dismiss="modal"
                            data-target="#forgotpasswordModal" data-toggle="modal">
                            Forgot Password?
                        </a>
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn green" id="login" name="login" type="submit" value="Login">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
                        data-target="#signupModal" data-toggle="modal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--Sign up form-->
<form method="post" id="signupform">
    @csrf
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 id="myModalLabel">
                        Sign up today and Start using our Online Notes App!
                    </h4>
                </div>
                <div class="modal-body">

                    <!--Sign up message from PHP file-->
                    <div id="signupmessage"></div>

                    <div class="form-group">
                        <label for="username" class="sr-only">Username:</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username"
                            maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="sr-only">Firstname:</label>
                        <input class="form-control" type="text" name="firstname" id="firstname"
                            placeholder="Firstname" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="sr-only">Lastname:</label>
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Lastname"
                            maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email:</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email Address"
                            maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Choose a password:</label>
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Choose a password" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="sr-only">Confirm password</label>
                        <input class="form-control" type="password" name="password2" id="password2"
                            placeholder="Confirm password" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber" class="sr-only">Telephone:</label>
                        <input class="form-control" type="text" name="phonenumber" id="phonenumber"
                            placeholder="Telephone Number" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label><input type="radio" name="gender" id="male" value="male">Male</label>
                        <label><input type="radio" name="gender" id="female" value="female">Female</label>
                    </div>
                    <div class="form-group">
                        <label for="moreinformation">Comments: </label>
                        <textarea name="moreinformation" class="form-control" rows="5" maxlength="300"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn green" name="signup" type="submit" value="Sign up">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--Forgot password form-->
<form method="post" id="forgotpasswordform">
    @csrf
    <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 id="myModalLabel">
                        Forgot Password? Enter your email address:
                    </h4>
                </div>
                <div class="modal-body">

                    <!--forgot password message from PHP file-->
                    <div id="forgotpasswordmessage"></div>


                    <div class="form-group">
                        <label for="forgotemail" class="sr-only">Email:</label>
                        <input class="form-control" type="email" name="forgotemail" id="forgotemail"
                            placeholder="Email" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
                        data-target="signupModal" data-toggle="modal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>



</script>


@endsection