<?php
// http://localhost/Final%20Project%20My%20API/api.php?createKey=yes&email=jim@gmail.com
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include 'db.php';
global $db;

// api key generation
// if create key and email is not empty
if ( isset($_GET['email']) ) {
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

    echo($apiKey);
}

if(isset($_GET['key'])){
    $option = $_GET['option'];
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
        switch($option){
            case('getall'):
                // sql statement to get all jokes
                $sql ="SELECT * FROM `jokes`";
                $qry =  $db->query($sql);
                $result = $qry->fetchAll();
                echo(json_encode($result));
                break;
            case('getone'):
                $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
                $sql ="SELECT * FROM `jokes` where JokeID = :id";
                // Prepare statement
                $stmt = $db->prepare($sql);

                // Bind the parameter
                $stmt->bindValue(':id', $id);

                // Execute the statement
                $stmt->execute();

                //Execute sql
                $result = $stmt->fetch();
                echo(json_encode($result));
                break;
            case('edit'):
                // get variable info and sanitize them
                $setup = filter_input(INPUT_GET, 'setup', FILTER_SANITIZE_STRING);
                $punchline = filter_input(INPUT_GET, 'punchline', FILTER_SANITIZE_STRING);
                $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);

                $sql ="UPDATE `jokes` SET `Setup` =:setup, `Punchline` =:punchline WHERE JokeID = :id";

                // Prepare statement
                $stmt = $db->prepare($sql);

                // Bind the parameter
                $stmt->bindValue(':id',$id);
                $stmt->bindValue(':setup',$setup);
                $stmt->bindValue(':punchline',$punchline);

                // Execute the statement
                $stmt->execute();

                //Execute sql
                $result = $stmt->fetch();
                break;
            case('add'):
                // get variable info and sanitize them
                $setup = filter_input(INPUT_GET, 'setup', FILTER_SANITIZE_STRING);
                $punchline = filter_input(INPUT_GET, 'punchline', FILTER_SANITIZE_STRING);

                $sql ="INSERT INTO `jokes`(`JokeID`, `Setup`, `Punchline`) VALUES (default,:setup,:punchline)";

                // Prepare statement
                $stmt = $db->prepare($sql);

                // Bind the parameter
                $stmt->bindValue(':setup',$setup);
                $stmt->bindValue(':punchline',$punchline);

                // Execute the statement
                $stmt->execute();

                //Execute sql
                $result = $stmt->fetch();
                break;
            case('delete'):
                $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
                $sql ="DELETE FROM `jokes` WHERE JokeID = :id";
                // Prepare statement
                $stmt = $db->prepare($sql);

                // Bind the parameter
                $stmt->bindValue(':id', $id);

                // Execute the statement
                $stmt->execute();

                //Execute sql
                $result = $stmt->fetch();
                echo(json_encode($result));
                break;

        }
    }//return false
    else{
        echo(json_encode(false));
    }
}


// echo(json_encode("test"));
?>