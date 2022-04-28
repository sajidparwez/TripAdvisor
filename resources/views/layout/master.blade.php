
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Sharing Website Final</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset("css/custom/styling.css")}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB7yCVYh8I0pFvptntz0-L0spHq_qsEJjc">
    </script>
    <style>
    /*margin top for myContainer*/

    #container {
        margin-top: 120px;
    }

    #notePad,
    #allNotes,
    #done,
    .delete {
        display: none;
    }

    textarea {
        width: 100%;
        max-width: 100%;
        font-size: 16px;
        line-height: 1.5em;
        border-left-width: 20px;
        border-color: #CA3DD9;
        color: #CA3DD9;
        background-color: #FBEFFF;
        padding: 10px;

    }

    .noteheader {
        border: 1px solid grey;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        padding: 0 10px;
        background: linear-gradient(#FFFFFF, #ECEAE7);
    }

    .text {
        font-size: 20px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .timetext {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .notes {
        margin-bottom: 100px;
    }

    #googleMap {
        width: 300px;
        height: 200px;
        margin: 30px auto;
    }

    .modal {
        z-index: 20;
    }

    .modal-backdrop {
        z-index: 10;
    }

    #spinner {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 85px;
        text-align: center;
        margin: auto;
        z-index: 1100;
    }

    .checkbox {
        margin-bottom: 10px;
    }

    .trip {
        border: 1px solid grey;
        border-radius: 10px;
        margin-bottom: 10px;
        background: linear-gradient(#ECE9E6, #FFFFFF);
        padding: 10px;
    }

    .price {
        font-size: 1.5em;
    }

    .departure,
    .destination {
        font-size: 1.5em;
    }

    .perseat {
        font-size: 0.5em;
        /*        text-align:right;*/
    }

    .time {
        margin-top: 10px;
    }

    .notrips {
        text-align: center;
    }

    .trips {
        margin-top: 20px;
    }

    .previewing2 {
        margin: auto;
        height: 20px;
        border-radius: 50%;
    }

    #mytrips {
        margin-bottom: 100px;
    }

    #myContainer {
        margin-top: 50px;
        text-align: center;
        color: black;
    }

    /*header size*/
    #myContainer h1 {
        font-size: 5em;
    }

    .bold {
        font-weight: bold;
    }

    #googleMap {
        width: 100%;
        height: 30vh;
        margin: 10px auto;
    }

    .signup {
        margin-top: 20px;
    }

    #spinner {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 85px;
        text-align: center;
        margin: auto;
        z-index: 1100;
    }

    #results {
        margin-bottom: 100px;
    }

    .driver {
        font-size: 1.5em;
        text-transform: capitalize;
        text-align: center;
    }

    .price {
        font-size: 1.5em;
    }

    .departure,
    .destination {
        font-size: 1.5em;
    }

    .perseat {
        font-size: 0.5em;
    }

    .journey {
        text-align: left;
    }

    .journey2 {
        text-align: right;
    }

    .time {
        margin-top: 10px;
    }

    .telephone {
        margin-top: 10px;
    }

    .seatsavailable {
        font-size: 0.7em;
        margin-top: 5px;
    }

    .moreinfo {
        text-align: left;
    }

    .aboutme {
        border-top: 1px solid grey;
        margin-top: 15px;
        padding-top: 5px;
    }

    #message {
        margin-top: 20px;
    }

    .journeysummary {
        text-align: left;
        font-size: 1.5em;
    }

    .noresults {
        text-align: center;
        font-size: 1.5em;
    }

    .previewing {
        max-width: 100%;
        height: auto;
        border-radius: 50%;
    }

    .previewing2 {
        margin: auto;
        height: 20px;
        border-radius: 50%;
    }


    #container {
        margin-top: 100px;
    }

    #notePad,
    #allNotes,
    #done {
        display: none;
    }

    .buttons {
        margin-bottom: 20px;
    }

    textarea {
        width: 100%;
        max-width: 100%;
        font-size: 16px;
        line-height: 1.5em;
        border-left-width: 20px;
        border-color: #CA3DD9;
        color: #CA3DD9;
        background-color: #FBEFFF;
        padding: 10px;

    }

    tr {
        cursor: pointer;
    }

    #previewing {
        max-width: 100%;
        height: auto;
        border-radius: 50%;
    }

    .previewing2 {
        margin: auto;
        height: 20px;
        border-radius: 50%;
    }

    #spinner {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 85px;
        text-align: center;
        margin: auto;
        z-index: 1100;
    }
    </style>
</head>

<body>
    <!--Navigation Bar-->
   
      @if(session()->has("user_id")) 
         @php
          $user = App\Models\User::where('user_id', session('user_id'))->first();     
         @endphp

        @include("navigationbarconnected");
      @else
        @include("navigationbarnotconnected");
      @endif

    <div class="container-fluid" id="myContainer">
        @yield('content')
    </div>
    <!-- Footer-->
    <div class="footer">
        <div class="container">
            <p>sajid parwez Copyright &copy; 2020- {{date("Y")}} </p>
        </div>
    </div>

    <!--Spinner-->
    <div id="spinner">
        <img src='{{asset("images/ajax-loader.gif")}}' width="64" height="64" />
        <br>Loading..
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset("js/bootstrap.min.js")}}"> </script>
    <script src="{{asset("js/custom/map.js")}}"></script>


<!------- custom scripts ----------------------------------------->
 <script>

//create a geocoder object to use the geocode
var geocoder = new google.maps.Geocoder();
var data;
var root = location.host;

//Ajax Call for the sign up form 
//Once the form is submitted
$("#signupform").submit(function(event){
    $("#signupmessage").hide();
    //show spinner
    $("#spinner").css("display", "block");
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //send them to signup.php using AJAX
    $.ajax({
        url: "{{url('signup')}}",
        type: "POST",
        data: datatopost,
            success: function(data){
                if(data){
                    $("#signupmessage").html(data);
                    //hide spinner
                    $("#spinner").css("display", "none");
                    //show message
                    $("#signupmessage").slideDown();
                }
            },
            error: function(){
                $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                //hide spinner
                $("#spinner").css("display", "none");
                //show message
                $("#signupmessage").slideDown();
                
            }
    
       });
});


// Ajax Call for the forgot password form
// Once the form is submitted
$("#forgotpasswordform").submit(function(event){ 
    //hide message
    $("#forgotpasswordmessage").hide();
    //show spinner
    $("#spinner").css("display", "block");
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();

    //send them to signup.php using AJAX
    $.ajax({
        url:'{{ url("forgot-password") }}',
        type: "POST",
        data: datatopost,
        success: function(data){
            $('#forgotpasswordmessage').html(data);
            //hide spinner
            $("#spinner").css("display", "none");
            //show message
            $("#forgotpasswordmessage").slideDown();
        },
        error: function(){
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            //hide spinner
            $("#spinner").css("display", "none");
            //show message
            $("#forgotpasswordmessage").slideDown();
        }
    
    });

});

//Ajax Call for the search form 
$("#searchform").submit(function(event){
    $("#results").fadeOut();
    $("#spinner").css("display", "block");
    event.preventDefault();
    data = $(this).serializeArray();
    console.log(data);
    
    
    getSearchTripDepartureCoordinates();
    
});
                        
    //define functions
function getSearchTripDepartureCoordinates(){
    geocoder.geocode(
        {
            'address' : document.getElementById("departure").value
        },
        function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                departureLongitude = results[0].geometry.location.lng();
                departureLatitude = results[0].geometry.location.lat();
                data.push({name:'departureLongitude', value: departureLongitude});
                data.push({name:'departureLatitude', value: departureLatitude});
                getSearchTripDestinationCoordinates();
            }else{
                getSearchTripDestinationCoordinates();
            }

        }
    );
}
// get cordinates 
    function getSearchTripDestinationCoordinates(){
        geocoder.geocode(
            {
                'address' : document.getElementById("destination").value
            },
            function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    destinationLongitude = results[0].geometry.location.lng();
                    destinationLatitude = results[0].geometry.location.lat();
                    data.push({name:'destinationLongitude', value: destinationLongitude});
                    data.push({name:'destinationLatitude', value: destinationLatitude});
                    submitSearchTripRequest();
                }else{
                    submitSearchTripRequest();
                }

            }
        );

    }
// submit search
function submitSearchTripRequest(){
    console.log(data);
    $.ajax({
        url:'{{ url("search") }}',
        data: data,
        type: "POST",
        success: function(data2){
            console.log(data);
            if(data2){
                $('#results').html(data2);
                //accordion
                $("#message").accordion({
                    icons: false,
                    active:false,
                    collapsible: true,
                    heightStyle: "content"   
                });
            }
            $("#spinner").css("display", "none");
            $("#results").fadeIn();
    },
        error: function(){
            $("#results").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#spinner").css("display", "none");
            $("#results").fadeIn();

            }
    }); 

}



//Ajax Call for the login form
//Once the form is submitted
 

 $("#loginform").submit(function(event){ 
    event.preventDefault();
    //hide message
    $("#loginmessage").hide();
    //show spinner
    $("#spinner").css("display", "block");

    var datatopost = $(this).serializeArray();

        $.ajax({
            url:'{{ url("login") }}',
            type: "POST",
            data: datatopost,
            success: function(data){
                if (data == "success") {
                    window.location.replace("{{config('constants.APP_URL') }}");
                

                }else{
                    $('#loginmessage').html(data);   
                    //hide spinner
                    $("#spinner").css("display", "none");
                    //show message
                    $("#loginmessage").slideDown();
                        }
                    },
                    error: function(){
                        $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                        //hide spinner
                        $("#spinner").css("display", "none");
                        //show message
                        $("#loginmessage").slideDown();
                        
                    }
            
       });

 });
  </script>

<!------------------------------------------------------------------------------------->
<script>
$(function(){
    //define variables
    var departureLongitude = 0, departureLatitude = 0, destinationLongitude = 0, destinationLatitude = 0;
    var data; var trip;
    
    //get trips
    getTrips();
    
    //create a geocoder object to use the geocode
    var geocoder = new google.maps.Geocoder();
 
    // Fix Map    
    $('#addtripModal').on('shown.bs.modal', function () {
        google.maps.event.trigger(map, "resize");
        });
    
    // Add Trip form: hide All date-time-checkbox inputs
    $('.regular').hide(); $('.oneoff').hide();
    
    // hide/show input depending on whether the trip is a regular or one-off
    var myradio = $('input[name="regular"]');
    myradio.click(function(){
        if ($(this).is(':checked'))
        {
            if($(this).val() == "Y"){
                $('.oneoff').hide(); $('.regular').show();
            }else{
                $('.regular').hide(); $('.oneoff').show();
            }
        }
    }); 
    
    // Edit Trip form: hide All date-time-checkbox inputs
    $('.regular2').hide(); $('.oneoff2').hide();
    
    // hide/show input depending on whether the trip is a regular or one-off
    var myradio2 = $('input[name="regular2"]');
    myradio2.click(function(){
        if ($(this).is(':checked'))
        {
            if($(this).val() == "Y"){
                $('.oneoff2').hide(); $('.regular2').show();
            }else{
                $('.regular2').hide(); $('.oneoff2').show();
            }
        }
    }); 
    
    // Click on Create Trip Button
        $('#addtripform').submit(function(event){
            event.preventDefault();
            $("#result").hide();
            $("#spinner").css("display", "block");
           
            data = $('#addtripform').serializeArray();
            getAddTripDepartureCoordinates();
        });
    
    // Click on Edit Trip Button
    $('#edittripModal').on('show.bs.modal', function (e) {
        $('#result2').html("");
        var $invoker = $(e.relatedTarget);
        $.ajax({
                url: "gettripdetails.php",
                method: "POST",
                data: {trip_id:$invoker.data('trip_id')},
                success: function(data2){
                    trip = JSON.parse(data2);
                    //fill edit trip form inputs using AJAX returned JSON data
                    formatModal();
            },
                error: function(){
                    $('#result2').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                    $('#result2').hide();
                    $('#result2').fadeIn();
        
                }
            
        });
        
        //setup delete button for AJAX Call
        $('#deletetrip').click(function(){
            $.ajax({
                url: "deletetrips.php",
                method: "POST",
                data: {trip_id:$invoker.data('trip_id')},
                success: function(){
                    $('#edittripModal').modal('hide');
                    getTrips();
            },
                error: function(){
                    $('#result2').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                    $('#result2').hide();
                    $('#result2').fadeIn();
                }
            
        });
        });
        
        // Click on Edit Trip Button
        $('#edittripform').submit(function(event){
            $("#result2").hide();
            $("#spinner").css("display", "block");
            event.preventDefault();
            data = $('#edittripform').serializeArray();
            data.push({name: 'trip_id', value: $invoker.data('trip_id')});
            getEditTripDepartureCoordinates();
        });
        
    });
    
    //Calendar Input
    $('input[name="date2"], input[name="date"]').datepicker({
        showAnim: "fadeIn",
        numberOfMonths: 1,
        dateFormat: "D d M, yy",
        minDate: +1,
        maxDate: "+12M",
        showWeek: true
    });
    

//define functions
    function getAddTripDepartureCoordinates(){
        geocoder.geocode(
            {
                'address' : document.getElementById("departure").value
            },
            function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    departureLongitude = results[0].geometry.location.lng();
                    departureLatitude = results[0].geometry.location.lat();
                    data.push({name:'departureLongitude', value: departureLongitude});
                    data.push({name:'departureLatitude', value: departureLatitude});
                    getAddTripDestinationCoordinates();
                }else{
                    getAddTripDestinationCoordinates();
                }

            }
        );
    }

    function getAddTripDestinationCoordinates(){
        geocoder.geocode(
            {
                'address' : document.getElementById("destination").value
            },
            function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    destinationLongitude = results[0].geometry.location.lng();
                    destinationLatitude = results[0].geometry.location.lat();
                    data.push({name:'destinationLongitude', value: destinationLongitude});
                    data.push({name:'destinationLatitude', value: destinationLatitude});
                    submitAddTripRequest();
                }else{
                    submitAddTripRequest();
                }

            }
        );

    }

    function submitAddTripRequest(){
        console.log(data);
        $.ajax({
            url: '{{url("add-trips")}}',
            data: data,
            type: "POST",
            success: function(data2){
                console.log(data);
                if(data2){
                    $('#result').html(data2);
                    $("#spinner").css("display", "none");
                    $("#result").slideDown();
                }else{
                    getTrips();
                    $("#result").hide();
                    $('#addtripModal').modal('hide');
                    $("#spinner").css("display", "none");
                    //empty form
                    $('#addtripform')[0].reset();
                }
        },
            error: function(){
                $("#result").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $("#spinner").css("display", "none");
                $("#result").fadeIn();

    }
        }); 

    }

    function getTrips() {
        $("#spinner").css("display", "block");
        $.ajax({
            url: '{{url("get-trips")}}',
            success: function(data2){
                $("#spinner").css("display", "none");
                $('#mytrips').html(data2);
                $('#mytrips').hide();
                $('#mytrips').fadeIn();
        },
            error: function(){
                $("#spinner").css("display", "none");
                $('#mytrips').html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $('#mytrips').hide();
                $('#mytrips').fadeIn();
    }
        }); 
    }
    
    function formatModal(){
        $('#departure2').val(trip["departure"]);    
        $('#destination2').val(trip["destination"]); 
        $('#price2').val(trip["price"]);    
        $('#seatsavailable2').val(trip["seatsavailable"]);    
        if(trip["regular"] == "Y"){
            $('#yes2').prop('checked', true);
            $('#monday2').prop('checked', trip["monday"] == "1"? true:false);
            $('#tuesday2').prop('checked', trip["tuesday"] == "1"? true:false);
            $('#wednesday2').prop('checked', trip["wednesday"] == "1"? true:false);
            $('#thursday2').prop('checked', trip["thursday"] == "1"? true:false);
            $('#friday2').prop('checked', trip["friday"] == "1"? true:false);
            $('#saturday2').prop('checked', trip["saturday"] == "1"? true:false);
            $('#sunday2').prop('checked', trip["sunday"] == "1"? true:false);
            $('input[name="time2"]').val(trip["time"]);
            $('.oneoff2').hide(); $('.regular2').show();
        }else{
            $('#no2').prop('checked', true);
            $('input[name="date2"]').val(trip["date"]);
            $('input[name="time2"]').val(trip["time"]);
            $('.regular2').hide(); $('.oneoff2').show();
        };
    }
    
    function getEditTripDepartureCoordinates(){
        geocoder.geocode(
            {
                'address' : document.getElementById("departure2").value
            },
            function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    departureLongitude = results[0].geometry.location.lng();
                    departureLatitude = results[0].geometry.location.lat();
                    data.push({name:'departureLongitude', value: departureLongitude});
                    data.push({name:'departureLatitude', value: departureLatitude});
                    getEditTripDestinationCoordinates();
                }else{
                    getEditTripDestinationCoordinates();
                }

            }
        );
        
    }
    
    function getEditTripDestinationCoordinates(){
        geocoder.geocode(
            {
                'address' : document.getElementById("destination2").value
            },
            function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    destinationLongitude = results[0].geometry.location.lng();
                    destinationLatitude = results[0].geometry.location.lat();
                    data.push({name:'destinationLongitude', value: destinationLongitude});
                    data.push({name:'destinationLatitude', value: destinationLatitude});
                    submitEditTripRequest();
                }else{
                    submitEditTripRequest();
                }

            }
        );
    }
    
    function submitEditTripRequest(){
        console.log(data);
        $.ajax({
            url: "updatetrips.php",
            data: data,
            type: "POST",
            success: function(data2){
                console.log(data);
                if(data2){
                    $('#result2').html(data2);
                    $("#spinner").css("display", "none");
                    $("#result2").slideDown();
                }else{
                    getTrips();
                    $("#result2").hide();
                    $('#edittripModal').modal('hide');
                    $("#spinner").css("display", "none");
                    //empty form
                    $('#edittripform')[0].reset();
                }
        },
            error: function(){
                $("#result2").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $("#spinner").css("display", "none");
                $("#result2").fadeIn();

    }
        }); 
    }
    
    

});
</script>

<!-----------------------------------------profile script-------------------------------------->
<script>

    // Ajax call to updateusername.php
$("#updateusernameform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "{{url('updateusername')}}",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updateusernamemessage").html(data);
            }else{
                location.reload();   
            }
        },
        error: function(){
            $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});

// Ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updatepasswordmessage").html(data);
            }
        },
        error: function(){
            $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});



// Ajax call to updateemail.php
$('#loading').hide();
$("#updateemailform").submit(function(event){ 
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to updateusername.php using AJAX
    $.ajax({
        url: "{{url('updateemail')}}",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#updateemailmessage").html(data);
            }
        },
        error: function(){
            $("#updateemailmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});





//Update picture
var file;

$("#updatepictureform").submit(function(event) {
    //hide message
    $("#updatepicturemessage").hide();
    //show spinner
    $("#spinner").css("display", "block");
    event.preventDefault();
    if(!file){
        $("#spinner").css("display", "none");
        $("#updatepicturemessage").html('<div class="alert alert-danger">Please upload a picture!</div>');
            $("#updatepicturemessage").slideDown();
        return false;
    }
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
        if($.inArray(imagefile, match) == -1){
            $("#updatepicturemessage").html('<div class="alert alert-danger">Wrong File Format</div>');
            $("#updatepicturemessage").slideDown();
            $("#spinner").css("display", "none");
            return false;
        }else{
            $.ajax({
                url: "{{url('updatepicture')}}", 
                type: "POST",             
                data: new FormData(this), 
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data){
                    if(data){
                        $("#updatepicturemessage").html(data);
                        //hide spinner
                        $("#spinner").css("display", "none");
                        //show message
                        $("#updatepicturemessage").slideDown();
                        //update picture in the settings
                    }else{
                        location.reload();
                    }

                },
                error: function(){
                    $("#updatepicturemessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                    //hide spinner
                    $("#spinner").css("display", "none");
                    //show message
                    $("#signupmessage").slideDown();

                }
            });
        }

});

// Function to preview image after validation
$(function() {
$("#picture").change(function() {
$("#updatepicturemessage").empty();
file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
    if($.inArray(imagefile, match) == -1){
        $("#updatepicturemessage").html("<div class='alert alert-danger'>Wrong file format!</div>");
        return false;
    }
    else{
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
    }
});
});
function imageIsLoaded(event) {
    console.log(event);
    $('#previewing').attr('src', event.target.result);
};
</script>

<!---------end custom script ---------------------------------------------->




</body>

</html>