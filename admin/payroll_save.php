<?php
 require_once 'db_connect.php';
 $name =$_POST['pay_name'];
 $in = $_POST['from'];
 $out = $_POST['to']; 
 $sql = $conn->query("INSERT INTO payroll_period (name,date_from,date_to,status) values ('$name','$in','$out','Active')");
 if($sql){
 echo "<script>
alert('Payroll Period is successfully updated');
window.location.href='payroll.php';
</script>";
		
	}

	 else
	 {
	 	    	echo "<script>
alert('Error updating the payroll period ');
window.location.href='payroll.php';
</script>";
	 }
	 	echo json_encode($data);
	$conn->close()	;
?>
