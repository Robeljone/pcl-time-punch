<?php
include 'db_connect.php';
$timezone = new DateTimeZone('Africa/Nairobi');
	extract($_POST);
	$data= array();
	$d2 = new Datetime("now", $timezone);
	$schdate = $d2->format('Y-m-d');
	$time = $d2->format('H:i:s');
	$qry = $conn->query("SELECT * from employee_schedule where emp_id ='$eno' and dates='$schdate' ");
	if($qry->num_rows > 0){
		$emp = $qry->fetch_array();
		//Add 20 minute to the clockin time
		$late = date('H:i:s',strtotime('+20 minutes',strtotime($emp['clock_in'])));
		$early = date('H:i:s',strtotime('+1 minutes',strtotime($emp['clock_out'])));
		$employee =$emp['employee_name'];
	//Clock check start here 

		//IF THE CURRENT TIME IS GREATER THE EMP IS LATE 
		if($type == 'Clock-in' && $late <= $time)
		{
		// $sql = $conn->query("SELECT employee_id from attendance where  DATE_FORMAT(datetime_log,'%Y%c%d') = '$schdate' ");
		// if($sql)
		//   {
		// 	$data['status'] = 2;
		// 	$data['msg'] = 'Duplicate Punch for The Day';
		//   }
		// else
		//    {
		$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values ('$type','".$emp['emp_id']."','$employee','Late')");
		$log = ' time in this morning';
		    // }
		}
		//IF CHECK-IN TIME IS GREATER THE EMP IS PRESENT 
		elseif($type == 'Clock-in' && $time <= $late)
		{
			// $sql = $conn->query("SELECT employee_id from attendance where  DATE_FORMAT(datetime_log,'%Y%c%d') = '$schdate' ");
			// if($sql)
			//   {
			// 	$data['status'] = 2;
			// 	$data['msg'] = 'Duplicate Punch for The Day';
			//   }
			// else{
				$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values('$type','".$emp['emp_id']."','$employee','Present')");
				$log = ' time in this morning';
				// }
		}
     
		//IF THE CHECK-OUT TIME IS GREATER THE EMP IS LEAVE early
       // 18:35:00<=18:22:10
		elseif($type == 'Clock-out' && $time < $early)
		{
			$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values('$type','".$emp['emp_id']."','$employee','Early')");
			$log = 'Check Out Punch';
		}

        //IF THE CURRENT TIME IS GREATER THE EMP IS LEAVE ontime
        elseif($type == 'Clock-out' && $time > $early)
		{
			$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values('$type','".$emp['emp_id']."','$employee','On-Time')");
			$log = ' Check Out Punch';
		}
      
	//Clock check end here

	//Lunch time start
	    elseif($type == 'Lunch-out')
		{
			$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name) values('$type','".$emp['emp_id']."','$employee')");
			$log = 'Lunch-out Punch';
		}
		elseif($type == 'Lunch-in')
		{
			$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name) values('$type','".$emp['emp_id']."','$employee')");
			$log = 'Lunch-in Punch';
		}
	//Lunch time end here 
		if($save_log)
		    {
				$data['status'] = 1;
				$data['msg'] = $employee.', your '.$log.' has been recorded. <br/>' ;
			}
	}
	else
	{
		$data['status'] = 2;
		$data['msg'] = 'Your Not on Today Schedule Please contact the HR Admin';
	}
	echo json_encode($data);
	$conn->close();