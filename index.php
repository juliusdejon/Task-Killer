<?php 
include "connection.php";
if(isset($_POST['submit']))
{
	$task =$_POST['task'];
	$sql = "INSERT INTO `task` (`id`, `task`) VALUES (NULL, '$task')";
	$mysqli->query($sql);
	
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Todo App 1.0.0</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="node_modules/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="node_modules/fonts/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="node_modules/fonts/css/font-awesome.css">
<!-- PNotify -->
<link href="node_modules/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="node_modules/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="node_modules/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
 
  <!--SWEET ALERT PLUGIN-->
<script src="node_modules/sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="plugin/sweetalert-master/dist/sweetalert.css">
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Prime Exam</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
    
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-clog"></i> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
          <ul class="dropdown-menu">
        	
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
	<div class="container-fluid">
		<div class="panel panel-default">
  <div class="panel-heading">Tasks</div>
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

	
	<table class="table" id="dashboardTable">
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
        <form action="edit.php" method="post" id="Edit">
        	<div class="row">
        	<div class="col-md-2">
			Task: </div>
			<div class="col-md-6">
			<input type="text" name="modalTask" class="form-control" value="<?php echo $task;?>">
			</div>
			<div class="col-md-2">
			<input type="hidden" name="modalId" value="<?php echo $idModal;?>">
			<input type="submit" name="modalSubmit" class="btn btn-success" value="Edit" onclick="myFunction()">
		
			</div>
			</div>

       </form>
       <script>
function myFunction() {
    location.reload();
}
</script>


<script type="text/javascript" src="edit.js"></script>
   <!--     <?php 
if(isset($_POST['modalSubmit']))
{

	$modalTask=$_POST['modalTask'];
	$modalId = $_POST['modalId'];

	$sql = "UPDATE task SET task ='$modalTask' WHERE id ='$modalId'";
	$mysqli->query($sql);
	echo "<script>window.location.href('index.php');</script>";
	
}





?> -->
      </div>
      <div id="result"></div>
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
<!-- <script src="node_modules/js/jquery.min.js"> </script> -->
        <script src="node_modules/pnotify/dist/pnotify.js"></script>
                                <script src="node_modules/pnotify/dist/pnotify.buttons.js"></script>
                                <script src="node_modules/pnotify/dist/pnotify.nonblock.js"></script>
