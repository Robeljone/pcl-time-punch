<?php
	require_once 'auth.php';
	$fro = $_POST['from'];
	$tod = $_POST['todat'];
?>
<!DOCTYPE html>
<html lang="eng">
	<head>
		<title>Employee List | Employee Attendance Record System</title>
		<?php include('header.php') ?>
	</head>
	<body>
		<?php include('nav_bar.php') ?>
		<div class="container-fluid admin" >
			<div class="alert alert-primary">Employee List</div>
			<div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModallabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content panel-warning">
						<div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModallabel">Edit Employee</h4>
						</div>
						<div id="edit_query"></div>
					</div>
				</div>
			</div>
			<div class = "well col-lg-12">
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Employee Number</th>
							<th>Date</th>
							<th>Log Type</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
	$attendance_qry = $conn->query("SELECT * from attendance where datetime_log between '$fro' and '$tod' ") or die(mysqli_error());
						while($row = $attendance_qry->fetch_array()){
							
					?>	
						<tr>
							<td><?php echo $row['employee_id']?></td>
							<td><?php echo date("F d, Y", strtotime($row['datetime_log']))?></td>
							<?php 
							if($row['log_type'] =="Clock-in"){
								$log = "TIME IN AM";
							}elseif($row['log_type'] =="Lunch-out"){
								$log = "TIME OUT AM";
							}
							elseif($row['log_type'] =="Lunch-in"){
								$log = "TIME IN PM";
							}elseif($row['log_type'] =="Clock-out"){
								$log = "TIME OUT PM";
							}
							?>
							<td><?php echo $log ?></td>
							<td><?php echo date("h:i a", strtotime($row['datetime_log']))?></td>
							<td><center>
                         <button class="btn btn-sm btn-outline-primary edit_employee" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button data-id = "<?php echo $row['id']?>" class = "btn btn-sm btn-outline-danger remove_employee" type="button"><i class = "fa fa-trash"></i></button></center></td>
						</tr>
					<?php
						}
					?>	
					</tbody>
				</table>
			<br />
			<br />	
			<br />	
			</div>
	     	</div>
		<div class="modal fade" id="new_employee" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add new Employee</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='employee_frm'>
							<div class ="modal-body">
								<div class="form-group">
									<label>Employee_No</label>
									<input type="hidden" name="id" />
									<input type="text" name="firstname" required="required" readonly="readonly" class="form-control" />
								</div>
								<div class="form-group">
									<label>Date and Time</label>
									<input type="text" name ="middlename" readonly="readonly" class="form-control" />
								</div>
								<div class="form-group">
									<label>Log-Type</label>
									<select class="form-control" name="logtype">
										<option value="1">Time-IN AM</option>
										<option value="2">Time-OUT AM</option>
										<option value="3">Time-IN PM</option>
										<option value="4">Time-OUT PM</option>
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
					url:'update_attendance.php',
					method:"POST",
					data:$(this).serialize(),
					error:err=>console.log(),
					success:function(resp){
						if(typeof resp !=undefined){
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
						url:'delete_attendance.php?id='+id,
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
					url:'get_attendance.php',
					method:"POST",
					data:{id:$id},
					error:err=>console.log(),
					success:function(resp){
						if(typeof resp !=undefined){
							resp = JSON.parse(resp)
							$('[name="id"]').val(resp.id)
							$("[name=firstname").val(resp.employee_id)
							$('[name="middlename"]').val(resp.datetime_log)
							$('[name="lastname"]').val(resp.log_type)
							$('#new_employee .modal-title').html('Edit Employee')
							$('#new_employee').modal('show')
						}
					}
				})
				
			});
			$('#new_emp_btn').click(function(){
				$('[name="id"]').val('')
				$('[name="firstname"]').val('')
				$('[name="lastname"]').val('')
				$('[name="middlename"]').val('')
				$('[name="department"]').val('')
				$('[name="position"]').val('')
				$('#new_employee .modal-title').html('Add New Employee')
				$('#new_employee').modal('show')
			})
		});
	</script>
</html>