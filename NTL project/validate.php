<?php 
if(!isset($_SESSION))
	{
		session_start();
		ob_start();
	}
function test_inp($data)
{
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
if(!isset($_SESSION['session'])) 
	Header("location: 404.html");
else
{
$session=test_inp($_SESSION['session']);
require_once("config.php");
		$sql="select * from coursera where session='$session'";
		$query= mysqli_query($conn,$sql);
		$row= mysqli_num_rows($query);
		
if($row == 0)
	header("Location: 404.php");
}
?>