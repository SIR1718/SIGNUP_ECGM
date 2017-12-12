<?php
//echo $_GET['u'];

$testeuser = $_GET['u'];
//$testeuser = "pedro";

require_once('connect.php');


$sql = "SELECT COUNT(username) FROM users WHERE username = '$testeuser'";


$resultado = $conn->query($sql);

$numero =  $resultado->fetch_array();

if ($numero[0] == 1) {
	echo "ocupado";
} else {
	echo "livre";
}

?>