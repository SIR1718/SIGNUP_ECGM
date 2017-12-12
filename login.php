<?php
// iniciar sessoes
session_start();

//existe um var $_SESSION['user']
if (isset($_SESSION['user'])) {
    // estou logado
    header("location:index.php");
    exit();
}

// o pedido foi feito por um formulário?
if (isset($_POST['username']) && isset($_POST['password'])) {
    // estabelecer a ligacao à bd
    require_once('connect.php');
   
    $password = $_POST['password'];
    $username = $_POST['username'];

    //$sqlquery = "SELECT * FROM users WHERE username = ? AND pass = ?";
    $sqlquery = "SELECT username, nome, apelido FROM users WHERE username=? && pass=?";
    
    // inicializar prepared statement
    $ps = $conn->prepare($sqlquery);

    // associar os parametros de input
    $ps->bind_param("ss", $username, $password);
 
    // executar
    $ps->execute();

    // associar os parametros de output
    $ps->bind_result($res_username, $res_nome, $res_apelido);
    
    // transfere o resultado da última query : obrigatorio para ter num_rows
    $ps->store_result();

    // iterar / obter resultados
    $ps->fetch();

    if ($ps->num_rows == 1) {
        //existe login válido
        $_SESSION['user'] = $res_username;
        $_SESSION['nomecompleto'] = $res_nome . ' ' . $res_apelido;
        header("location:index.php");
        exit();
    }

    // encerrare e libertar prepared statement
    // encerrar ligação à BD
    $ps->close();
    $conn->close();
}




//encerrar as sessoes
session_write_close();

?>


<html>
<head>
<style>
label {
    display : inline-block;
    width : 120px;
}

input {
    display : block;
    width : 120px;
    margin-bottom : 10px;
}

</style>
</head>

<body>

<form action="login.php" method="POST">

<label for="iuser"> username: </label>
<input type="text" id="iuser" name="username"/>

<label for="ipass"> password: </label>
<input type="password" id="ipass" name="password"/>

<input type = "submit" value="login"/>

</form>
</body>

<p> Crie uma conta nova <a href="signupform.php"> aqui </a></p>


</html>