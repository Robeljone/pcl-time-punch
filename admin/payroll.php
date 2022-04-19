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
			<div class="alert alert-primary">Payroll Managment</div>
			<div class="modal fade" id="edit_student" tabindex="-1" role="dialog" aria-labelledby="myModallabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content panel-warning">
						<div class="modal-header panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModallabel">Payroll</h4>
						</div>
						<div id="edit_query"></div>
					</div>
				</div>
			</div>
			<div class="well col-lg-12">
				<button class="btn btn-success" type="button" id="new_emp_btn"><span class="fa fa-plus"></span> Add Payroll</button>
				<button class="btn btn-success" type="button" id="new_emp_btn_2"><span class="fa fa-plus"></span> Add Payroll Period</button>
				<br />
				<br />
			</div>
			<br />
			<br />	
			<br />	
		</div>
		
		<div class="modal fade" id="new_employee" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add new payroll</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='employee_frm'>
							<div class ="modal-body">
								<div class="form-group">
									<label>Employee Name</label>
									<input type="hidden" name="id" />
								  <select name="emp_nam" class="form-control" required="required"> 
			      		    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM employee") or die(mysqli_error());
							while($row=$employee_qry->fetch_array())
					     {
						?>
		<option value="<?php echo $row['employee_no']?>"><?php echo  ucwords($row['firstname'].' '.$row['lastname']); ?></option>
						<?php
							}
						?>
			        </select>
								</div>
								<div class="form-group">
									<label>Payroll Period</label>
								<select name="emp_nam" class="form-control" required="required" readonly="readonly"> 
			      		    	      	<?php
							$employee_qry=$conn->query("SELECT * FROM payroll_period") or die(mysqli_error());
							while($row=$employee_qry->fetch_array())
					     {
						?>
		<option value="<?php echo $row['id']?>"><?php echo $row['name']; ?></option>
						<?php
							}
						?>
			        </select>
								</div>
								<div class="form-group">
									<label>Working Days</label>
									<input type="number" name ="middlename" class="form-control" />
								</div>
								<div class="form-group">
									<label>Absent</label>
									<input type="number" name="lastname" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>OT</label>
									<input type="number" name="department" required="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Deduct Amount</label>
									<input type="number" name="deduct" required="required" class="form-control" />
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
							<h4 class="modal-title" id="myModallabel">Add Payroll Period</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form method="POST" action="payroll_save.php">
							<div class ="modal-body">
								<div class="form-group">
									<label>Payroll</label>
								    <input type="text" name="pay_name" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>From</label>
								    <input type="date" name="from" class="form-control" required="required">
								</div>
							    <div class="form-group">
									<label>To</label>
								    <input type="date" name="to" class="form-control" required="required">
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
						url:'delete_employee.php?id='+id,
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
			   $('#new_emp_btn_2').click(function(){
				$('#edit_employee .modal-title').html('Add Payroll Period')
				$('#edit_employee').modal('show')
			})
			$('#new_emp_btn').click(function(){
				$('#new_employee .modal-title').html('Add New Payroll')
				$('#new_employee').modal('show')
			})
		});
    
	</script>
</html>