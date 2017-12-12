<?php
$userdb = "php";
$hostdb = "localhost";
$passdb = "php";
$namedb = "ex_login";
 
$conn = new mysqli($hostdb,$userdb,$passdb,$namedb);

if($conn->connect_errno) {
    //var_dump($conn);
    //echo $conn->connect_error;
    die("erro no accesso à bd");
} else {
   // echo "ok";
}

// a partir daqui temos uma variavel com um ligacao
// $conn

?>