<!DOCTYPE html>
<?php
	require_once 'auth.php';
	require_once 'db_connect.php';
?>
<html lang="eng">
	<head>
		<title>Employee List | Employee Attendance Record System</title>
		<?php include('header.php') ?>
	</head>
	<body>
		<?php include('nav_bar.php') ?>
		<div class="container-fluid admin" >
			<div class="alert alert-primary">Report</div>
			<div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModallabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content panel-warning">
						<div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModallabel">Edit Edit Schedule</h4>
						</div>
						<div id="edit_query"></div>
					</div>
				</div>
			</div>
			<div class="well col-lg-12">
				<form class="form-control" action="export.php" method="post">
				<label >From</label>
				<input type="date" name="from" class="form-control">
				<label >To</label>
				<input type="date" name="to" class="form-control">
				<label>Employee ID</label>
			   <select class="form-control" name="emp_id">
			   	<option value="All">All Employee</option>
			   	<option></option>
								    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM employee") or die(mysqli_error());
							while($row=$employee_qry->fetch_array()){
						?>
							<option value="<?php echo $row['employee_no'] ?>"><?php echo ucwords($row['firstname'].' '.$row['lastname']); ?></option>
						<?php
							}
						?>

								    </select>
				<input type="submit" name="export" class="btn btn-success">  
				</form>
				<br />
				<br />
			</div>
			<br />
			<br />	
			<br />	
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
</html>