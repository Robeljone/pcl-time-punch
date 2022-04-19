<?php
include 'db_connect.php';
$timezone = new DateTimeZone('Africa/Nairobi');
	extract($_POST);
	$data= array();
	$d2 = new Datetime("now", $timezone);
	$schdate = $d2->format('Y-m-d');
	$time = $d2->format('H:i:s');
	$qry = $conn->query("SELECT * from employee_schedule where dates='$schdate' ");
    $row = mysqli_fetch_array($qry);
	if($qry->num_rows > 0)
    {
        //echo $row;
        foreach($row as $data)
        {
           $qry2 = $conn->query("SELECT * FROM attendance where employee_id='".$row["emp_id"]."' and  datetime_log='$schdate' and log_type='clock_in' ");
            if($qry2->num_rows < 0)
            {
                echo "test done";
                //$save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values (' ','".$row['emp_id']."','".$row['employee_name']."','Absent')");
            } 
            else
            {
                
            }
        }
        // while($row!=null)
        // {
        //     $qry2 = $conn->query("SELECT * FROM attendance where employee_id='".$row['emp_id']."' and  datetime_log='$schdate' and log_type='clock_in' ");
        //     if($qry2->num_rows < 0)
        //     {
        //         $save_log= $conn->query("INSERT INTO attendance (log_type,employee_id,employee_name,status) values ('','".$row['emp_id']."','".$row['employee_name']."','Absent')");
        //     }  

        // }
        // echo "<script>
        // alert('Database Optimization Done');
        // window.location.href='home.php';
        // </script>";
    }
	else
	{
		echo "<script>
      		alert('Please Check You Date and Time');
      		window.location.href='home.php';
      		</script>";
	}
	;