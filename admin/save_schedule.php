<?php
 require_once 'db_connect.php';
 $name =$_POST['name'];
 $in = $_POST['in'];
 $out = $_POST['out']; 
 $status = $_POST['status'];
 $sql = $conn->query("INSERT INTO schedul (name,time_in,time_out,status) values ('$name','$in','$out','$status')");
 if($sql){
	    	echo "<script>
alert('Schedule is successfully updated');
window.location.href='Schedull.php';
</script>";
		
	}

	 else
	 {
	 	    	echo "<script>
alert('Error updating the Schedule ');
window.location.href='Schedull.php';
</script>";
	 }
	 	echo json_encode($data);
	$conn->close()	;
?>
