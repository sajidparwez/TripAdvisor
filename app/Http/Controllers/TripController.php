<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarshareTrip;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    public function getTrips()
    {

        $sql = "SELECT * FROM carsharetrips WHERE user_id='" . session('user_id') . "'";
        try {
            $result = DB::select(DB::raw($sql));
        } catch (\Throwable $th) {
            throw  $th;
        }
        //print_r($result);
        if (count($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                //check frequency
                if ($row['regular'] == "N") {
                    $frequency = "One-off journey.";
                    $time = $row['date'] . " at " . $row['time'] . ".";
                } else {
                    $frequency = "Regular.";
                    $array = [];
                    if ($row['monday'] == 1) {
                        array_push($array, "Mon");
                    }
                    if ($row['tuesday'] == 1) {
                        array_push($array, "Tue");
                    }
                    if ($row['wednesday'] == 1) {
                        array_push($array, "Wed");
                    }
                    if ($row['thursday'] == 1) {
                        array_push($array, "Thu");
                    }
                    if ($row['friday'] == 1) {
                        array_push($array, "Fri");
                    }
                    if ($row['saturday'] == 1) {
                        array_push($array, "Sat");
                    }
                    if ($row['sunday'] == 1) {
                        array_push($array, "Sun");
                    }
                    $time = implode("-", $array) . " at " . $row['time'] . ".";
                }
                echo
                '<div class="row trip">
                        <div class="col-sm-8 journey">
                            <div><span class="departure">Departure:</span> ' . $row['departure'] . '.</div>
                            <div><span class="destination">Destination:</span> ' . $row['destination'] . '.</div>
                            <div class="time">' . $time . '</div>
                            <div>' . $frequency . '</div>
                        </div>
                        <div class="col-sm-2 price">
                            <div class="price">$' . $row['price'] . '</div>
                            <div class="perseat">Per Seat</div>
                            <div class="seatsavailable">' . $row['seatsavailable'] . ' left</div>
                        </div>
                        <div class="col-sm-2">
                            <button class= "btn green edit btn-lg" data-target="#edittripModal" data-toggle="modal" data-trip_id="' . $row['trip_id'] . '">Edit</button>
                        </div>
                    </div>';
            }
        } else {
            echo '<div class="notrips alert alert-warning">You Have not created any trips yet</div>';
        }
    }

    public function addtrips()
    {

        $missingdeparture = '<p><strong>Please enter your departure!</strong></p>';
        $invaliddeparture = '<p><strong>Please enter a valid departure!</strong></p>';
        $missingdestination = '<p><strong>Please enter your destination!</strong></p>';
        $invaliddestination = '<p><strong>Please enter a valid destination!</strong></p>';
        $missingprice = '<p><strong>Please choose a price per seat!</strong></p>';
        $invalidprice = '<p><strong>Please choose a valid price per seat using numbers only!!</strong></p>';
        $missingseatsavailable = '<p><strong>Please select the number of available seats!</strong></p>';
        $invalidseatsavailable = '<p><strong>The number of available seats should contain digits only!</strong></p>';
        $missingfrequency = '<p><strong>Please select a frequency!</strong></p>';
        $missingdays = '<p><strong>Please select at least one weekday!</strong></p>';
        $missingdate = '<p><strong>Please choose a date for your trip!</strong></p>';
        $missingtime = '<p><strong>Please choose a time for your trip!</strong></p>';

        //Get inputs:
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $price = $_POST["price"];
        $seatsavailable = $_POST["seatsavailable"];
        $regular = $_POST["regular"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $monday = $_POST["monday"];
        $tuesday = $_POST["tuesday"];
        $wednesday = $_POST["wednesday"];
        $thursday = $_POST["thursday"];
        $friday = $_POST["friday"];
        $saturday = $_POST["saturday"];
        $sunday = $_POST["sunday"];
        $errors = '';
        //check coordinates
        if (!isset($_POST["departureLatitude"]) or !isset($_POST["departureLongitude"])) {
            $errors .= $invaliddeparture;
        } else {
            $departureLatitude = $_POST["departureLatitude"];
            $departureLongitude = $_POST["departureLongitude"];
        }

        if (!isset($_POST["destinationLatitude"]) or !isset($_POST["destinationLongitude"])) {
            $errors .= $invaliddestination;
        } else {
            $destinationLatitude = $_POST["destinationLatitude"];
            $destinationLongitude = $_POST["destinationLongitude"];
        }


        //Check departure:
        if (!$departure) {
            $errors .= $missingdeparture;
        }

        //Check destination:
        if (!$destination) {
            $errors .= $missingdestination;
        }
        //Check Price
        if (!$price) {
            $errors .= $missingprice;
        } elseif (preg_match('/\D/', $price)) {
            $errors .= $invalidprice;
        }

        //Check Seats Available
        if (!$seatsavailable) {
            $errors .= $missingseatsavailable;
        } elseif (preg_match('/\D/', $seatsavailable))  // you can use ctype_digit($seatsavailable)
        {
            $errors .= $invalidseatsavailable;
        }

        //Check regular
        if (!$regular) {
            $errors .= $missingfrequency;
        } elseif ($regular == "Y") {
            if (!$monday && !$tuesday && !$wednesday && !$thursday && !$friday && !$saturday && !$sunday) {
                $errors .= $missingdays;
            }
            if (!$time) {
                $errors .= $missingtime;
            }
        } elseif ($regular == "N") {
            if (!$date) {
                $errors .= $missingdate;
            }
            if (!$time) {
                $errors .= $missingtime;
            }
        }

        //if there is an error print error message
        if ($errors) {
            $resultMessage = "<div class='alert alert-danger'>$errors</div>";
            echo $resultMessage;
        } else {
            //no errors, prepare variables for the query
            $tbl_name = 'carsharetrips';

            if ($regular == "Y") {
                //query for a regular trip
                $sql = "INSERT INTO $tbl_name (`user_id`,`departure`, `departureLongitude`, `departureLatitude`, `destination`, `destinationLongitude`, `destinationLatitude`, `price`, `seatsavailable`, `regular`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `time`) VALUES ('" . $_SESSION['user_id'] . "', '$departure','$departureLongitude','$departureLatitude','$destination','$destinationLongitude','$destinationLatitude','$price','$seatsavailable','$regular','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$sunday','$time')";
            } else {
                //query for a one off trip
                $sql = "INSERT INTO $tbl_name (`user_id`,`departure`, `departureLongitude`, `departureLatitude`, `destination`, `destinationLongitude`, `destinationLatitude`, `price`, `seatsavailable`, `regular`, `date`, `time`) VALUES ('" . $_SESSION['user_id'] . "', '$departure','$departureLongitude','$departureLatitude','$destination','$destinationLongitude','$destinationLatitude','$price','$seatsavailable','$regular','$date','$time')";
            }

            try {
                $results = DB::select(DB::raw($sql));
            } catch (\Throwable $th) {
                throw  $th;
            }

            //check if query is successful
            if (count($results) <= 0) {
                echo '<div class=" alert alert-danger">There was an error! The trip could not be added to database!</div>';
            }
        }
    }
}