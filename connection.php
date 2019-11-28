<?php

$server     = "localhost";
$username   = "root";
$password   = "Hesoyam7351!!";
$db         = "db_user";

// Create a connection
$conn = mysqli_connect( $server, $username, $password, $db );

// Check connection
if (!$conn) {
    die( "Connection failed: " . mysqli_connect_error() );
}

// echo "Connected successfully!";

?>
