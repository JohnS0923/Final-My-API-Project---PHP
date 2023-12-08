<?php
// start session
session_start();
// $_SESSION['apikey'] = null;
// if api key isnt set, set it to null, otherwise keep the value of key
$_SESSION['apikey'] = isset($_SESSION['apikey']) ? $_SESSION['apikey'] : null;
//if there is a apikey set in get
if(isset($_GET['apikey'])){
    //set the session api key to the entered api key
    $_SESSION['apikey'] = $_GET['apikey'];
}

// print_r($_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
<?php
include "Includes/nav.php";
// get option in get input
$action= filter_input(INPUT_GET, 'option');

switch($action){
    case('createkey'):
        // show an email form 
        include "Includes/email_form.php";
        break;
    case('showkey'):
        // create key and show it
        include "Includes/getkey.php";
        break;
    case('enterapi'):
        // form to enter api
        include "Includes/key_form.php";
        break;
    case('edit'):
        // an edit form 
        include "Includes/edit_form.php";
        break;
    case('addjokeform'):
        //if api isnt enter show form
        if(!isset($_SESSION['apikey']) || $_SESSION['apikey'] == "" ){
            include "Includes/key_form.php";
        }else{//otherwise show form to add joke
            //form to add a joke
            include "Includes/create_form.php";
        }
        break;
    case('addjoke'):
        //javascript to add a new joke
        include "Includes/add_joke.php";
        // show list of jokes
        include "Includes/show_jokes.php";
        break;
    case('editinfo'):
        // javacript api call to make an edit to joke
        include "Includes/save_edit.php";
        // show list of jokes
        include "Includes/show_jokes.php";
        break;
    case('delete'):
        // javacript api call to delete joke
        include "Includes/delete_joke.php";
        // show list of jokes
        include "Includes/show_jokes.php";
        break;
    default:
         // if there isnt a api key entered show form to enter key
        if(!isset($_SESSION['apikey']) || $_SESSION['apikey'] == "" ){
            include "Includes/key_form.php";
        }else{
            // show list of jokes
            include "Includes/show_jokes.php";
        }
        break;
}
    ?>

</body>
</html>