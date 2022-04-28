<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rememberme;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function checkRemeberme()
    {
        if (!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])) {

            list($authentificator1, $authentificator2) = explode(',', $_COOKIE['rememberme']);

            $authentificator2 = hex2bin($authentificator2);

            $f2authentificator2 = hash('sha256', $authentificator2);

            try {
                $remmeber = Rememberme::where("authentificator1", $authentificator1)->get();
            } catch (\Throwable $th) {
                return  '<div class="alert alert-danger">There was an error running the query.</div>';
            }

            if (!$remmeber) {
                return '<div class="alert alert-danger">Remember me process failed!</div>';
            }

            if (!hash_equals($remmeber->f2authentificator2, $f2authentificator2)) {
                return '<div class="alert alert-danger">hash_equals returned false.</div>';
            } else {
                $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));

                $authentificator2 = openssl_random_pseudo_bytes(20);

                $cookieValue = f1($authentificator1, $authentificator2);
                setcookie(
                    "rememberme",
                    $cookieValue,
                    time() + 1296000
                );
                $f2authentificator2 = f2($authentificator2);


                $remmeber->authentificator1 = $authentificator1;
                $remmeber->f2authentificator2 = $f2authentificator2;

                if ($remmeber->save()) {
                    $user = User::where('user_id', $remmeber->user_id)->first();
                    session(['user_id' => $user['user_id'], 'username' => $user['username'], 'email' => $user['email']]);
                    return view('loggeninpage', ['user' => $user]);
                } else {
                    return  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
                }
            }
        } //remmeber me end 

    }



    //sign up

    public function signup(Request $request)
    {

        $missingUsername = '<p><strong>Please enter a username!</strong></p>';
        $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
        $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
        $missingPassword = '<p><strong>Please enter a Password!</strong></p>';
        $invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
        $differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
        $missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
        $missingfirstname = '<p><strong>Please enter your firstname!</strong></p>';
        $missinglastname = '<p><strong>Please enter your lastname!</strong></p>';
        $missingPhone = '<p><strong>Please enter your phone number!</strong></p>';
        $invalidPhoneNumber = '<p><strong>Please enter a valid phone number (digits only and less than 15 long)!</strong></p>';
        $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
        $missinggender = '<p><strong>Please select your gender</strong></p>';
        $missinginformaton = '<p><strong>Please share a few more words about yourself.</strong></p>';


        $errors = '';


        if (empty($request->username)) {
            $errors .= $missingUsername;
        } else {
            $username =  $request->username;
        }
        //Get firstname
        if (empty($request->firstname)) {
            $errors .= $missingfirstname;
        } else {
            $firstname = $request->firstname;
        }
        //Get lastname
        if (empty($request->lastname)) {
            $errors .= $missinglastname;
        } else {
            $lastname = $request->lastname;
        }
        //Get email
        if (empty($request->email)) {
            $errors .= $missingEmail;
        } else {
            $email = $request->email;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= $invalidEmail;
            }
        }
        //Get passwords
        if (empty($request->password)) {
            $errors .= $missingPassword;
        } elseif (!(strlen($request->password) > 6
            and preg_match('/[A-Z]/', $request->password)
            and preg_match('/[0-9]/', $request->password)
        )) {
            $errors .= $invalidPassword;
        } else {
            $password = $request->password;
            if (empty($request->password2)) {
                $errors .= $missingPassword2;
            } else {
                $password2 = $request->password2;
                if ($password !== $password2) {
                    $errors .= $differentPassword;
                }
            }
        }
        //Get phone number
        if (empty($request->phonenumber)) {
            $errors .= $missingPhone;
        } elseif (preg_match('/\D/', $request->phonenumber)) {
            $errors .= $invalidPhoneNumber;
        } else {
            $phonenumber = $request->phonenumber;
        }
        //Get gender
        if (empty($request->gender)) {
            $errors .= $missinggender;
        } else {
            $gender = $request->gender;
        }
        //Get moreinformation
        if (empty($request->moreinformation)) {
            $errors .= $missinginformaton;
        } else {
            $moreinformation = $request->moreinformation;
        }
        //If there are any errors print error
        if ($errors) {
            $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
            return  $resultMessage;
        }


        if (User::where('username', $username)->exists()) {
            return '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
        }

        if (User::where('email', $email)->exists()) {
            return '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';
        }


        //Create a unique  activation code
        $activationKey = bin2hex(openssl_random_pseudo_bytes(16));


        //Insert user details and activation code in the users table

        $user = new User;
        $user->username = $username;
        $user->email =    $email;
        $user->password = bcrypt($password);
        $user->email = $email;
        $user->activation = $activationKey;
        $user->first_name = $firstname;
        $user->last_name = $lastname;
        $user->phonenumber = $lastname;
        $user->gender = $gender;
        $user->moreinformation = $moreinformation;


        if ($user->save()) {
            $message = "Please click on this link to activate your account:\n\n";
            $message .= "http:/put your sute url/activate?email=" . urlencode($email) . "&key=$activationKey";
            // if (mail($email, 'Confirm your Registration', $message, 'From:' . 'developmentisland@gmail.com')) {
            echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
            // }
        }
    }

    //acitivate account
    public function activate(Request $request)
    {

        if (!isset($_GET['email']) || !isset($_GET['key'])) {
            return '<div class="alert alert-danger">There was an error. Please click on the activation link you received by email.</div>';
        }


        $email = $_GET['email'];
        $key = $_GET['key'];



        if (User::where('email', $email)->where('activation', $key)->update(['activation' => 'activated'])) {
            $result = '<div class="alert alert-success">Your account has been activated.</div>
             <a href="/index" type="button" class="btn-lg btn-sucess">Log in<a/>';
        } else {
            $result = '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
        }


        return view('activate', ['result' => $result]);
    }

    //logout


    //login 
    public function login(Request $request)
    {
        // prx('hi');
        $this->checkRemeberme();

        $errors = '';
        $missingEmail = '<p><stong>Please enter your email address!</strong></p>';
        $missingPassword = '<p><stong>Please enter your password!</strong></p>';

        if (empty($request->loginemail)) {
            $errors .= $missingEmail;
        } else {
            $email = $request->loginemail;
        }
        if (empty($request->loginpassword)) {
            $errors .= $missingPassword;
        } else {
            $password = $request->loginpassword;
        }
        //If there are any errors
        if ($errors) {
            //print error message
            $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
            return $resultMessage;
        } else {

            //If the user is not logged in & rememberme cookie exists

            //Run query: Check combinaton of email & password exists
            try {
                $user = User::where([['email', $email], ['activation', 'activated']])->first(); //->toArray();

                $hashedpass =  $user->password ?? '';

                if ($user && Hash::check($password, $hashedpass)) {
                    //log the user in: Set session variables

                    session(['user_id' => $user->user_id, 'username' => $user->username, 'email' => $user->email]);

                    if (empty($request->rememberme)) {
                        return "success";
                    } else {
                        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
                        $authentificator2 = openssl_random_pseudo_bytes(20);

                        $cookieValue = f1($authentificator1, $authentificator2);
                        setcookie("rememberme", $cookieValue, time() + 1296000);

                        //Run query to store them in rememberme table

                        $f2authentificator2 = f2($authentificator2);

                        $expiration = date('Y-m-d H:i:s', time() + 1296000);
                        $rememberme = new Rememberme;
                        $rememberme->authentificator1 = $authentificator1;
                        $rememberme->f2authentificator2 = $f2authentificator2;
                        $rememberme->user_id =  $user->user_id;
                        $rememberme->user_name = $user->username;
                        $rememberme->expires = $expiration;

                        if ($rememberme->save()) {
                            return "success";
                        } else {
                            return '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
                        }
                    }
                } else {

                    return  '<div class="alert alert-danger">Wrong Username or Password</div>';
                }
            } catch (\Throwable $th) {
                '<div class="alert alert-danger">Error running the query!</div>';
            }
        } // -------------end function body---------------


    } // end of class body


    public function forgotPassword(Request $request)
    {
        //Check user inputs
        //Define error messages
        $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
        $invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
        //Get email
        //Store errors in errors variable
        $errors = '';
        if (empty($_POST["forgotemail"])) {
            $errors .= $missingEmail;
        } else {
            $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= $invalidEmail;
            }
        }

        //If there are any errors
        //print error message
        if ($errors) {
            $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
            echo $resultMessage;
            exit;
        }
        //else: No errors
        //Prepare variables for the query
        $email = mysqli_real_escape_string($link, $email);
        //Run query to check if the email exists in the users table
        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result =  DB::raw($sql);
        if (!$result) {
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
        $count = count($result);
        //If the email does not exist
        //print error message
        if ($count != 1) {
            echo '<div class="alert alert-danger">That email does not exist on our database!</div>';
            exit;
        }

        //else
        //get the user_id
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $user_id = $row['user_id'];
        //Create a unique  activation code
        $key = bin2hex(openssl_random_pseudo_bytes(16));
        //Insert user details and activation code in the forgotpassword table
        $time = time();
        $status = 'pending';
        $sql = "INSERT INTO forgotpassword (`user_id`, `rkey`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status')";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>';
            exit;
        }

        //Send email with link to resetpassword.php with user id and activation code

        $message = "Please click on this link to reset your password:\n\n";
        $message .= "http://carsharingwebsitefinal.thecompletewebhosting.com/resetpassword.php?user_id=$user_id&key=$key";
        if (mail($email, 'Reset your password', $message, 'From:' . 'developmentisland@gmail.com')) {
            //If email sent successfully
            //print success message
            echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
        }
    }
}