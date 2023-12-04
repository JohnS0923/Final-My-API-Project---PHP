<?php
// http://localhost/Final%20Project%20My%20API/api.php?createKey=yes&email=jim@gmail.com
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'db.php';
global $db;

// api key generation
// if create key and email is not empty
if (isset($_GET['createKey']) && isset($_GET['email']) ) {
    $sql = "INSERT INTO `users`(`UserID`, `Email`, `APIKEY`) VALUES (DEFAULT, :email, :apikey)";
    
    // Prepare statement
    $stmt = $db->prepare($sql);

    // Sanitize and bind parameters
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $apiKey = bin2hex(random_bytes(16)); // Generates a 32-character hex string

    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':apikey', $apiKey);

    // Execute the statement
    $stmt->execute();

    echo "worked";
}

if(isset($_GET['key'])){
    $apiKey = $_GET['key'];
    $sql = "SELECT * FROM `users` WHERE APIKEY = :apikey";
    
    // Prepare statement
    $stmt = $db->prepare($sql);

    // Bind the parameter
    $stmt->bindValue(':apikey', $apiKey);

    // Execute the statement
    $stmt->execute();

    //Execute sql
    $result = $stmt->fetch();

    // check to see if there result or not
    if($result){
        echo(json_encode(true));
    }
    else{
        echo(json_encode(false));
    }
}


// echo(json_encode("test"));
?>