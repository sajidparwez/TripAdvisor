<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function changeProfilePicture($id, $file, $ext)
    {
        $permanentdestination = storage_path('app/public') . '/profilepicture/' . md5(time()) . "." . $ext;

        if (move_uploaded_file($file, $permanentdestination)) {
            if (!(User::where('user_id', $id)->update(['profilepicture' => $permanentdestination]))) {
                $resultMessage = '<div class="alert alert-warning"Unable to upload file. Please try again later.></div>';
                echo $resultMessage;
            }
        } else {
            $resultMessage = '<div class="alert alert-danger">Unable to update profile picture. Please try again later.</div>';
            echo $resultMessage;
        }
    }


    public function updateemail(Request $request)
    {

        //get user_id and new email sent through Ajax
        $user_id = session('user_id');
        $newemail = $_POST['email'];

        //check if new email exists

        $result = User::where('email', $newemail)->first();

        if ($result) {
            echo "<div class='alert alert-danger'>There is already as user registered with that email! Please choose another one!</div>";
            exit;
        }


        //get the current email
        $result = User::where('user_id', $user_id)->first();


        if ($result) {
            $email = $result->email;
        } else {
            echo "<div class='alert alert-danger'>There was an error retrieving the email from the database</div>";
            exit;
        }

        //create a unique activation code
        $activationKey = bin2hex(openssl_random_pseudo_bytes(16));

        //insert new activation code in the users table
        $sql = "UPDATE users SET activation2='$activationKey' WHERE user_id = '$user_id'";
        if (!User::where('user_id', $user_id)->update(['activation2' => $activationKey])) {
            echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";
            exit;
        } else {
            //send email with link to activatenewemail.php with current email, new email and activation code
            $message = "Please click on this link prove that you own this email:\n\n";
            $message .= "http://carsharingwebsitefinal.thecompletewebhosting.com/activatenewemail.php?email=" . urlencode($email) . "&newemail=" . urlencode($newemail) . "&key=$activationKey";
            if (mail($newemail, 'Email Update for you Online Notes App', $message, 'From:' . 'developmentisland@gmail.com')) {
                echo "<div class='alert alert-success'>An email has been sent to $newemail. Please click on the link to prove you own that email address.</div>";
            }
        }
    }

    public function updateusername(Request $request)
    {


        //get user_id
        $id = session('user_id');

        //Get username sent through Ajax
        $username = $_POST['username'];
        if (!(User::where('user_id', $id)->update(['username' => $username]))) {
            echo '<div class="alert alert-danger">There was an error updating storing the new username in the database!</div>';
        }
    }

    public function updatepicture(Request $request)
    {

        $user_id = session('user_id');

        //error messages to display
        $noFiletoUpload = "<p><strong>Please upload a file!</strong></p>";
        //$fileAlreadyExists = "<p><strong>This file already exists!</strong></p>";
        $wrontFormat = "<p><strong>Sorry, you can only upload pdf and text files!</strong></p>";
        $fileTooLarge = "<p><strong>You can only upload files smaller than 3Mo!</strong></p>";



        //file details
        $name = $_FILES["picture"]["name"];
        $type = $_FILES["picture"]["type"];
        $size = $_FILES["picture"]["size"];
        $fileerror = $_FILES["picture"]["error"];
        $tmp_name = $_FILES["picture"]["tmp_name"];
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        //allowed formats to upload
        $allowedFormats = array("jpeg" => "image/jpeg", "jpg" => "image/jpg", "png" => "image/png");

        $errors = '';
        //check for errors
        if ($fileerror == 4) {
            $errors .= $noFiletoUpload;
        } else {
            //    if(file_exists($permanentdestination)){
            //        $errors .= $fileAlreadyExists;   
            //    }
            if (!in_array($type, $allowedFormats)) {
                $errors .= $wrontFormat;
            } elseif ($size > 3 * 1024 * 1024) {
                $errors .= $fileTooLarge;
            }
        }



        if ($errors) {
            $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
            echo $resultMessage;
        } else {
            $this->changeProfilePicture($user_id, $tmp_name, $extension);
        }

        //print_r($_FILES);
        if ($_FILES["picture"]["error"] > 0) {
            $errors = '<p>There was an error: ' . $_FILES["picture"]["error"] . '</p>';
            $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
            echo $resultMessage;
        } else {
            //    echo "<p>File: ".  $_FILES["picture"]["name"] ."</p>";   
            //    echo "<p>File type: ".  $_FILES["picture"]["type"] ."</p>";   
            //    echo "<p>Temporary location: ".  $_FILES["picture"]["tmp_name"] ."</p>";   
            //    echo "<p>File size: ".  $_FILES["picture"]["size"] ."</p>";   
        }
    } // end of function
}// end of class