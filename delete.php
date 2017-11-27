<?php

include "connection.php";
$id = $_GET['id'];
$sql= "DELETE FROM task WHERE id ='$id' ";
$mysqli->query($sql);
header('Location: index.php');
?>