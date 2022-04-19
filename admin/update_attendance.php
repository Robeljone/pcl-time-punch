<?php
require_once 'db_connect.php';
$id = $_POST['id'];
$log_ty = $_POST['logtype'];
$save = $conn->query("UPDATE attendance set log_type='$log_ty' where id='$id' ") or die(mysqli_error());
if($save){
						echo json_encode(array('status'=>1,'msg'=>"Data successfully Updated"));
				}	
	$conn->close();
?>