
<nav role="navigation" class="navbar navbar-custom">
<?php
//   pr($user); 
?>
  
<div class="container-fluid">

    <div class="navbar-header">

          <a class="navbar-brand" href="{{route('index')}}">Car Sharing</a>
          <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>

          </button>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
          <ul class="nav navbar-nav">
              <li class=""><a href="{{route('query')}}">Search</a></li>
            <li><a href="/profile">Profile</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Contact us</a></li>
            <li><a href="{{route('mytrips')}}">My Trips</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#">
                 
                        @if(empty($user['picture']))
                         <div class='image_preview'><img class='previewing2' src='profilepicture/noimage.jpg' /></div>
                        @else
                            <div class='image_preview'><img class='previewing2' src="{{$user->profilepicture}}"/></div>
                        @endif

                   
                  </a>
              </li>
              <li><a href="#"><b> {{ $user->username }}</b></a></li>
           <li><a href='{{route("logout")}}''>Log out</a></li>
          </ul>

      </div>
  </div> 

</nav>