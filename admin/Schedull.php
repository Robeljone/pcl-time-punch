<!DOCTYPE html>
<?php
	require_once 'auth.php';
?>
<html lang="eng">
	<head>
		<title>Employee List | Employee Attendance Record System</title>
		<?php include('header.php') ?>
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
				<button class="btn btn-success" type="button" id="new_emp_btn"><span class="fa fa-plus"></span>New-Schedule</button>
				<br />
				<br />
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Time-IN</th>
							<th>Time-Out</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
               	<?php
							$employee_qry=$conn->query("SELECT * FROM schedul") or die(mysqli_error());
							while($row=$employee_qry->fetch_array()){
						?>
						<tr>
							<td><?php echo $row['name']?></td>
							<td><?php echo $row['time_in']?></td>
							<td><?php echo $row['time_out']?></td>
							<td>
								<center>
								 <button class="btn btn-sm btn-outline-primary edit_schedule" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button class="btn btn-sm btn-outline-danger remove_schedule" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
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
						<form method="POST" action="save_schedule.php">
							<div class ="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="hidden" name="id" />
									<input type="text" name="name" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Time-IN</label>
									<input type="time" name ="in" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Time-Out</label>
									<input type="time" name="out" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
									<option class="form-control" value="Active">Active</option>
									<option class="form-control" value="Passive">Passive</option>
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

			$('body').on('click','.remove_schedule',function(){
				var id=$(this).attr('data-id');
				var _conf = confirm("Are you sure to delete this data ?");
				if(_conf == true){
					$.ajax({
						url:'delete_schedule.php?id='+id,
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
			$('body').on('click','.edit_schedule',function(){
				var $id=$(this).attr('data-id');
				$.ajax({
					url:'get_schedule.php',
					method:"POST",
					data:{id:$id},
					error:err=>console.log(),
					success:function(resp){
						if(typeof resp !=undefined){
							resp = JSON.parse(resp)
							$('[name="name"]').val(resp.name)
							$('[name="in"]').val(resp.time_in)
							$('[name="out"]').val(resp.time_out)

							$('#new_employee .modal-title').html('Edit Schedule')
							$('#new_employee').modal('show')
						}
					}
				})
				
			});
			$('#new_emp_btn').click(function(){
				$('[name="name"]').val('')
				$('[name="in"]').val('')
				$('[name="out"]').val('')
				$('#new_employee .modal-title').html('Add New Schedule')
				$('#new_employee').modal('show')
			})
		});
	</script>
</html>