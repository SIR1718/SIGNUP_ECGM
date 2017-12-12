<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    $nome = $_SESSION['nomecompleto'];
}
session_write_close(); 
?>

<html>
<body>
<h1> Ola <?php echo $nome ?> </h1>
<a href="logout.php"> SAIR DAQUI </a>
</body>
</html>