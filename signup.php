<?php 
// iniciar sessoes
session_start();

//existe um var $_SESSION['user']
if (isset($_SESSION['user'])) {
    // estou logado
    header("location:index.php");
    exit();
}

unset($_SESSION['lname']);
unset($_SESSION['fname']);
unset($_SESSION['username']);

// posso fazer signup

$valid = true;

$username = "";
$fname = "";
$lname = "";

$pass1 ="";
$pass2 ="";

if (isset($_POST['username'])) {
	$username = $_POST['username'];
} else {
	$valid = false;
}

if (isset($_POST['password1'])) {
	$pass1 = $_POST['password1'];
} else {
	$valid = false;
}

if (isset($_POST['password2'])) {
	$pass2 = $_POST['password2'];
} else {
	$valid = false;
}

if (isset($_POST['lname'])) {
	$lname = $_POST['lname'];
} else {
	$valid = false;
}

if (isset($_POST['fname'])) {
	$fname = $_POST['fname'];
} else {
	$valid = false;
}

if ($pass1 != $pass2) {
	$valid = false;
}


if ($valid == false) {
	$_SESSION['lname']=$lname;
	$_SESSION['fname']=$fname;
	$_SESSION['username']=$username;
    header("location:signupform.php");
	}

    require_once('connect.php');
   

    //$sqlquery = "SELECT * FROM users WHERE username = ? AND pass = ?";
    //$sqlquery = "SELECT username, nome, apelido FROM users WHERE username=? && pass=?";
    $sqlquery = "INSERT INTO users (username, pass, nome, apelido) VALUES(?,?,?,?)";
    
    // inicializar prepared statement
    $ps = $conn->prepare($sqlquery);

    // associar os parametros de input
    $ps->bind_param("ssss", $username, $pass1, $fname, $lname);
 
    // executar
    $ps->execute();

    
    // transfere o resultado da última query : obrigatorio para ter num_rows
    $ps->store_result();

    // iterar / obter resultados
    //$ps->fetch();

    //var_dump($ps);

    if ($ps->affected_rows == 1) {
        //existe login válido
        $_SESSION['user'] = $username;
        $_SESSION['nomecompleto'] = $fname . ' ' . $lname;
        header("location:index.php");
    } else {	
    	$_SESSION['lname']=$lname;
		$_SESSION['fname']=$fname;
		$_SESSION['username']=$username;
    	header("location:signupform.php");
    }


    // encerrare e libertar prepared statement
    // encerrar ligação à BD
    $ps->close();
    $conn->close();
    exit();

?>