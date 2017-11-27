<?php
include 'connection.php';

$modalId=(isset($_POST['modalId']))?$_POST['modalId']:$_POST['modalId']="";
$modalTask=(isset($_POST['modalTask']))?$_POST['modalTask']:$_POST['modalTask']="";



	
if($modalTask =='')
{
	echo "Enter Task";
}
else{
	$sql = "UPDATE task SET task ='$modalTask' WHERE id ='$modalId'";
	$mysqli->query($sql);
	echo "updated";
	echo "<script>window.location.href('index.php');</script>";
	}