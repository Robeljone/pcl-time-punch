<!DOCTYPE html>
<?php
	require_once 'auth.php';
	$emp_dep = $_POST['dep'];
	$emp_name = $_POST['emp_nam'];
	$fro = $_POST['from'];
	$tod = $_POST['todat'];
?>
<html lang="eng">
	<head>
		<title>Employee List | Employee Attendance Record System</title>
		<?php include('header.php')

		 ?>
	</head>
	<body>
		<?php include('nav_bar.php') ?>
		<div class="container-fluid admin" >
			<div class="alert alert-primary">Schedule List</div>
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
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Date</th>
							<th>Shift</th>
							<th>Clock-in</th>
							<th>Clock-out</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
	$attendance_qry = $conn->query("SELECT * from employee_schedule WHERE department='$emp_dep' and dates between '$fro' and '$tod' ") or die(mysqli_error());
				
						while($row = $attendance_qry->fetch_array()){
							
					?>
						<tr>
							<td><?php echo $row['emp_id']?></td>
							<td><?php echo $row['dates']?></td>
							<td><?php echo $row['shift']?></td>
							<th><?php echo $row['clock_in'] ?></th>
							<th><?php echo $row['clock_out'] ?></th>
							<td>
								<center>
								 <button class="btn btn-sm btn-outline-primary edit_employee" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button class="btn btn-sm btn-outline-danger remove_employee" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
								</center>
							</td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<br />
			<br />	
			<br />	
		</div>
		
		<div class="modal fade" id="new_employee" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModallabel">Add new Schedule</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form method="POST" action="save_emp_schedule.php">
							<div class ="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="hidden" name="id" />
								    <select class="form-control" name="emp_id">
								    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM employee") or die(mysqli_error());
							while($row=$employee_qry->fetch_array()){
						?>
		<option value="<?php echo $row['employee_no'].'&&'.$row['firstname'].'&&'.$row['lastname'] ?>"><?php echo  ucwords($row['firstname'].' '.$row['lastname']); ?></option>
						<?php
							}
						?>
								    </select>
							     <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
								</div>
								<div class="form-group">
									<label>From-Date</label>
									<input type="Date" name ="dates" required="required" class="form-control" />
								
								</div>
								<div class="form-group">
									<label>To-Date</label>
									<input type="Date" name ="todates" required="required" class="form-control" />
								
								</div>
									<div class="form-group">
									<label>Name</label>
									<input type="hidden" name="id" />
								    <select class="form-control" name="shift">
								    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM schedul") or die(mysqli_error());
							while($row=$employee_qry->fetch_array()){
						?>
			<option value="<?php echo $row['name'].'&&'.$row['time_in'].'&&'.$row['time_out']?>"><?php echo $row['name']?></option>
						<?php
							}
						?>
								    </select>

								</div>
							</div>
							<div class="modal-footer">
								<button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
				<div class="modal fade" id="edit_employee" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModallabel">Add new Schedule</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form method="POST" action="edit_emp_schedule.php">
							<div class ="modal-body">
								<div class="form-group">
									<label>Name</label>
								    <input type="text" name="emp_names" readonly="readonly" class="form-control">
								    <input type="hidden" name="emp_id">
								</div>
								<div class="form-group">
									<label>Department</label>
									<input type="text" name ="depart" readonly="readonly" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Date</label>
									<input type="Date" name ="dates" readonly="readonly" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Schedule</label>
									<input type="hidden" name="id" />
								    <select class="form-control" name="shift">
								    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM schedul") or die(mysqli_error());
							while($row=$employee_qry->fetch_array()){
						?>
							<option value="<?php echo $row['name'].'&&'.$row['time_in'].'&&'.$row['time_out'] ?>"><?php echo $row['name']?></option>
						<?php
							}
						?>
								    </select>
								</div>
							</div>
							<div class="modal-footer">
								<button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#employee_frm').submit(function(e){
				e.preventDefault()
				$('#employee_frm [name="submit"]').attr('disabled',true)
				$('#employee_frm [name="submit"]').html('Saving')
				$.ajax({
					url:'save_employee.php',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp)
					{
						if(typeof resp !=undefined)
						{
							resp = JSON.parse(resp)
							if(resp.status == 1){
								alert(resp.msg);
								location.reload();
							}
						}
					}
				})
			})

			$('body').on('click','.remove_employee',function(){
				var id=$(this).attr('data-id');
				var _conf = confirm("Are you sure to delete this data ?");
				if(_conf == true){
					$.ajax({
						url:'delete_emp_schedule.php?id='+id,
						error:err=>console.log(err),
						success:function(resp){
							if(typeof resp != undefined){
								resp = JSON.parse(resp)
								if(resp.status == 1){
									alert(resp.msg);
									location.reload()
								}
							}
						}
					})
				}
			});
			$('body').on('click','.edit_employee',function(){
				var $id=$(this).attr('data-id');
				$.ajax({
					url:'get_emp_schedule.php',
					method:"POST",
					data:{id:$id},
					error:err=>console.log(),
					success:function(resp){
						if(typeof resp !=undefined){
							resp = JSON.parse(resp)
							$('[name="emp_names"]').val(resp.employee_name)
							$('[name="emp_id"]').val(resp.emp_id)
							$('[name="dates"]').val(resp.dates)
							$('[name="depart"]').val(resp.department)
							$('[name="shift"]').val(resp.shift)
							$('#edit_employee .modal-title').html('Edit Employee Schedule')
							$('#edit_employee').modal('show')
						}
					}
				})
				
			});
			$('#new_emp_btn').click(function(){
				$('[name="emp_id"]').val('')
				$('[name="dates"]').val('')
				$('[name="shift"]').val('')
				$('#new_employee .modal-title').html('Add New Schedule')
				$('#new_employee').modal('show')
			})
		});
	</script>
</html>