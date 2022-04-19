<?php
 require_once 'db_connect.php';
 $name =$_POST['pay_name'];
 $in = $_POST['from'];
 $out = $_POST['to']; 
 $out = $_POST['to']; 
 $out = $_POST['to']; 
 $sql = $conn->query("INSERT INTO payroll (employee_name,department,salary,deduct_amount,ot_pay,net_pay) values ('$name','$dep','$sal','$ded','$ot','$net')");
 if($sql){
 echo "<script>
alert('Payroll is successfully updated');
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
