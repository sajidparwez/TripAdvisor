<?php
//The user is re-directed to this file after clicking the activation link
//Signup link contains two GET parameters: email and activation key
// session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Activation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    h1 {
        color: purple;
    }

    .contactForm {
        border: 1px solid #7c73f6;
        margin-top: 50px;
        border-radius: 15px;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 contactForm">
                <h1>Account Activation</h1>
                {!!$result !!}
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>