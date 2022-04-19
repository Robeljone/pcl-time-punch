<?php
require_once 'db_connect.php';
$id = $_POST['id'];
 $emp_ids = $_POST['emp_id'];
 $dep = $_POST['depart'];
 $emp_names = $_POST['emp_names'];
 $shift = explode('&&',$_POST['shift']);
 $da = $_POST['dates'];
	$delete = $conn->query("DELETE  FROM employee_schedule WHERE `emp_id` = '$emp_ids' AND dates='$da'") or die(mysqli_error());
	if($delete){
$sql = $conn->query("INSERT INTO employee_schedule (emp_id,employee_name,department,dates,shift,clock_in,clock_out) values ('$emp_ids','$emp_names','$dep','$da','$shift[0]','$shift[1]','$shift[2]')");
 if($sql){
			echo "<script>
alert('Schedule For this Employee is successfully updated');
window.location.href='emp_schedule.php';
</script>";
		}
		else
		{
				echo "<script>
alert('Schedule For this Employee Not successfully updated');
window.location.href='emp_schedule.php';
</script>";
		}
	}
	$conn->close();
?>