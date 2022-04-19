<?php
 require_once 'db_connect.php';
 $id =$_POST['id'];
 $emp_ids = explode('&&',$_POST['emp_id']);
 $shift = $_POST['shift']; 
 $da = $_POST['dates'];
 $da2= $_POST['todates'];
$startTime = strtotime( $da);
$endTime = strtotime( $da2 );
 $both = explode('&&',$_POST['shift']);
 $sql1 = "SELECT * FROM employee_schedule WHERE emp_id='$emp_ids[0]' AND dates='$da' AND shift='$both[0]' ";
 $res =  mysqli_query($conn, $sql1);
 $count = mysqli_num_rows( $res);
 if ($count>0) 
 {
      	echo "<script>
alert('Schedule For this Employee is  registered');
window.location.href='emp_schedule.php';
</script>";
 }
 else
 {
 	$datediff = $endTime - $startTime;
	$count=round($datediff / (60 * 60 * 24));
	$datetosave=$da;
 for ( $i = 0; $i <= $count; $i++ )
    {
    	if($i!=0){
   			$datetosave = date('Y-m-d', strtotime($datetosave. ' + 1 days'));
    	}
   		 $sql = $conn->query("INSERT INTO employee_schedule (emp_id,employee_name,department,dates,shift,clock_in,clock_out) values ('$emp_ids[0]','$emp_ids[1]$emp_ids[2]','$emp_ids[3]','$datetosave','$both[0]','$both[1]','$both[2]')");
 		if($sql){

	  		echo "<script>
      		alert('Schedule For this Employee is successfully registered');
      		window.location.href='emp_schedule.php';
      		</script>";
		}
	  	else{
	  		echo "<script>
      		alert('Schedule For this Employee is Not successfully registered');
      		window.location.href='emp_schedule.php';
     		</script>";
	  	}
	 	echo json_encode($data);        
    }
  
 }

	$conn->close()	;
?>
