<?php

// Include Database connection
include("db_connect.php");
// Include SimpleXLSXGen library
include("SimpleXLSXGen.php");
$from = $_POST['from'];
$to = $_POST['to'];
$title = "Attendance Report From";
$emp_id = $_POST['emp_id'];
$employees = [
  ['employee_name', 'log_type', 'datetime_log','status']
];
if ($emp_id=='All')
 {
 $id = 0;
$sql = "SELECT * FROM attendance where datetime_log  Between '".$from."' and '".$to."' order by datetime_log asc";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
  foreach ($res as $row)
   {
    $id++;
    $employees = array_merge($employees,array(array($row['employee_name'], $row['log_type'], $row['datetime_log'],$row['status'])));
   }
  $xlsx = SimpleXLSXGen::fromArray($employees);
$xlsx->downloadAs('employees.xlsx'); // This will download the file to your local system

// $xlsx->saveAs('employees.xlsx'); // This will save the file to your server

echo "<pre>";
print_r($employees);
 
}
 else
  {
  		echo "<script>
alert('Report For  ');
window.location.href='report.php';
</script>";
  }
 }
 else
 {
 $id = 0;
$sql = "SELECT * FROM attendance where datetime_log  Between '".$from."' and '".$to."' and employee_id='".$emp_id."' ";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) 
{
  foreach ($res as $row) 
  {
    $id++;
    $employees = array_merge($employees, array(array($row['employee_name'], $row['log_type'], $row['datetime_log'], $row['status'])));
  }
  $xlsx = SimpleXLSXGen::fromArray($employees);
$xlsx->downloadAs('employees.xlsx'); // This will download the file to your local system

// $xlsx->saveAs('employees.xlsx'); // This will save the file to your server

echo "<pre>";
print_r($employees);
 
}
 else
  {
  		echo "<script>
alert('Report For this Employee is not Found with search criteria ');
window.location.href='report.php';
</script>";
  }
 }


