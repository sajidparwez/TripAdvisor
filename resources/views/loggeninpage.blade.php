@extends('layout.master')

@section('content')

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div>
                    <button type="button" class="btn green btn-lg" data-target="#addtripModal" data-toggle="modal">
                        Add trips
                    </button>
                </div>
                <div id="mytrips" class="trips">
                    <!--Ajax Call to php file-->
                </div>
            </div>

        </div>


    <!--Add a trip form-->
    <form method="post" id="addtripform">
        <div class="modal" id="addtripModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel">
                            New trip:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Error message from PHP file-->
                        <div id="result"></div>

                        <!--Google Map-->
                        <div id="googleMap"></div>

                        <div class="form-group">
                            <label for="departure" class="sr-only">Departure:</label>
                            <input type="text" name="departure" id="departure" placeholder="Departure"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="destination" class="sr-only">Destination:</label>
                            <input type="text" name="destination" id="destination" placeholder="Destination"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price" class="sr-only">Price:</label>
                            <input type="number" name="price" id="price" placeholder="Price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="seatsavailable" class="sr-only">Seats available:</label>
                            <input type="number" name="seatsavailable" id="seatsavailable" placeholder="Seats available"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="regular" id="yes" value="Y">Regular</label>
                            <label><input type="radio" name="regular" id="no" value="N">One-off</label>
                        </div>
                        <div class="checkbox checkbox-inline regular">
                            <label><input type="checkbox" value="1" id="monday" name="monday"> Monday</label>
                            <label><input type="checkbox" value="1" id="tuesday" name="tuesday"> Tuesday</label>
                            <label><input type="checkbox" value="1" id="wednesday" name="wednesday"> Wednesday</label>
                            <label><input type="checkbox" value="1" id="thursday" name="thursday"> Thursday</label>
                            <label><input type="checkbox" value="1" id="friday" name="friday"> Friday</label>
                            <label><input type="checkbox" value="1" id="saturday" name="saturday"> Saturday</label>
                            <label><input type="checkbox" value="1" id="sunday" name="sunday"> Sunday</label>
                        </div>
                        <div class="form-group oneoff">
                            <label for="date" class="sr-only">Date: </label>
                            <input name="date" id="date" readonly="readonly" placeholder="Date" class="form-control">
                        </div>
                        <div class="form-group time regular oneoff">
                            <label for="time" class="sr-only">Time: </label>
                            <input type="time" name="time" id="time" placeholder="Time" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" name="createTrip" type="submit" value="Create Trip">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Edit a trip form-->
    <form method="post" id="edittripform">
        <div class="modal" id="edittripModal" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            &times;
                        </button>
                        <h4 id="myModalLabel2">
                            Edit trip:
                        </h4>
                    </div>
                    <div class="modal-body">

                        <!--Error message from PHP file-->
                        <div id="result2"></div>

                        <div class="form-group">
                            <label for="departure2" class="sr-only">Departure:</label>
                            <input type="text" name="departure2" id="departure2" placeholder="Departure"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="destination2" class="sr-only">Destination:</label>
                            <input type="text" name="destination2" id="destination2" placeholder="Destination"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price2" class="sr-only">Price:</label>
                            <input type="number" name="price2" id="price2" placeholder="Price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="seatsavailable2" class="sr-only">Seats available:</label>
                            <input type="number" name="seatsavailable2" placeholder="Seats available"
                                class="form-control" id="seatsavailable2">
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="regular2" id="yes2" value="Y">Regular</label>
                            <label><input type="radio" name="regular2" id="no2" value="N">One-off</label>
                        </div>
                        <div class="checkbox checkbox-inline regular2">
                            <label><input type="checkbox" value="1" id="monday2" name="monday2"> Monday</label>
                            <label><input type="checkbox" value="1" id="tuesday2" name="tuesday2"> Tuesday</label>
                            <label><input type="checkbox" value="1" id="wednesday2" name="wednesday2"> Wednesday</label>
                            <label><input type="checkbox" value="1" id="thursday2" name="thursday2"> Thursday</label>
                            <label><input type="checkbox" value="1" id="friday2" name="friday2"> Friday</label>
                            <label><input type="checkbox" value="1" id="saturday2" name="saturday2"> Saturday</label>
                            <label><input type="checkbox" value="1" id="sunday2" name="sunday2"> Sunday</label>
                        </div>
                        <div class="form-group oneoff2">
                            <input name="date2" id="date2" readonly="readonly" placeholder="Date" class="form-control">
                        </div>
                        <div class="form-group time regular2 oneoff2">
                            <label for="time2" class="sr-only">Time: </label>
                            <input type="time" name="time2" id="time2" placeholder="Time" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" name="updatetrip" type="submit" id="updatetrip"
                            value="Edit Trip">
                        <input type="button" class="btn btn-danger" name="deletetrip" value="Delete" id="deletetrip">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection