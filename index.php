<?php 
include "connection.php";
if(isset($_POST['submit']))
{
	$task =$_POST['task'];
	if ($task == '' ) {
		echo "<script>alert('Enter a Task');</script>";
	}
	else {
		$sql = "INSERT INTO `task` (`id`, `task`) VALUES (NULL, '$task')";
		$mysqli->query($sql);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task Killer</title>
<!-- Bootstrap and Jquery -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="favicon.ico" type="image/ico">
</head>
<body>
<!--Navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Prime Exam</a>
			</div>
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
			</div>
		</div>
</nav>
<!-- Container Panel  -->
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
							<input type="text" name="task" class="form-control" autofocus>
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
        <form id="Edit" method="post" action="edit.php">
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
      </div>
      <div id="result"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="js/edit.js"></script>