<?php 
include "connection.php";
if(isset($_POST['submit']))
{
	$task =$_POST['task'];
	$sql = "INSERT INTO `task` (`id`, `task`) VALUES (NULL, '$task')";
	$mysqli->query($sql);
	echo "<script>
$( document ).load( 'index.php' );
	</script>";
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Todo App 1.0.0</title>
</head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="node_modules/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
<body>
<div class="container">
	<div class="container-fluid">
		<div class="panel panel-default">
  <div class="panel-heading">Dashboard</div>
  <div class="panel-body">
	<form action="" method="post">
	<div class="col-md-2">
	<label for="">Add Task</label>
	</div>

	<div class="col-md-6">
	<input type="text" name="task" class="form-control">
	</div>

	<div class="col-md-2">
	<input type="submit" name="submit" class="btn btn-success" value="Add">
	</div>
</form>

	
	<table class="table">
		<thead>
			<th>#</th>
			<th>Task</th>
			<th>Action</th>
		</thead>
		<tbody>

			<?php
			include "connection.php";
			$sql = "SELECT * FROM task ORDER BY id DESC";
			$res = $mysqli->query($sql);
			$count = mysqli_num_rows($res);
			$i = 0;
			 while($rows=mysqli_fetch_assoc($res))
			 {
			
			 	$i++;
			 	$id=$rows['id'];
			 	$task = $rows['task'];
			 ?>
			 <tr>
			<td><?php echo $i; ?></td>
			 <td><?php echo $task;?></td>
			 <td><a class="btn btn-info btn-md" data-toggle="modal" data-target="#<?php echo $id?>">Edit</button>

			  <a href="delete.php?id=<?php echo $id;?>" class="btn btn-danger">Delete</a></td>
			 </tr>
			<?php } ?>
		</tbody>
	</table>
  </div>
</div>
 	</div>
</div>

	
</body>
</html>

<?php 



?>

<!-- test -->
<!-- <script>
$(document).ready(function()
{
alert ('asd');
});
</script> -->


<!-- Modal -->
<?php
$sqlModal = "SELECT * FROM task";
$res= $mysqli->query($sqlModal); 
while($row = mysqli_fetch_assoc($res))
{
	$idModal =$row['id'];
	$task = $row['task'];

?>
<div id="<?php echo $idModal?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit: <?php echo $task; ?></h4>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post">
        	<div class="row">
        	<div class="col-md-2">
			Task: </div>
			<div class="col-md-6">
			<input type="text" name="modalTask" class="form-control" value="<?php echo $task;?>">
			</div>
			<div class="col-md-2">
			<input type="hidden" name="modalId" value="<?php echo $idModal;?>">
			<input type="submit" name="modalSubmit" class="btn btn-success" value="Edit">

			</div>
			</div>
       </form>
       <?php 
if(isset($_POST['modalSubmit']))
{
	echo $modalTask;
	echo $modalId;
	$modalTask=$_POST['modalTask'];
	$modalId = $_POST['modalId'];

	$sql = "UPDATE task SET task ='$modalTask' WHERE id ='$modalId'";
	$mysqli->query($sql);
	header('Location: index.php');

}




?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>



  </div>
</div>
<?php 
}
?>



<script type="text/javascript" src="node_modules/bootstrap-3.3.7-dist/js/bootstrap.min.js">
	
</script>