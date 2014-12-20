<?php
session_start();

$_SESSION['operation'] = "+";


header('Location: view_addition.php');

?>