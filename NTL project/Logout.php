<?php
session_start();

if(!isset($_SESSION['session']))
		Header("location: 404.html");
else 
{
$servername="localhost";
$username="id4243436_root";
$password="123456789";
$dbname= "id4243436_ntl";
	$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);
	
	$session=$_SESSION['session'];
	
	$sql ="select * from coursera where session='$session'";
	$query = mysqli_query($conn,$sql);
	$userna = mysqli_fetch_array($query);
	$id=$userna['ID'];
	$DeleteSess="UPDATE coursera SET session=NULL WHERE ID='$id'";
	if ($conn->query($DeleteSess)==TRUE)
		{
			session_unset();
			session_destroy();
			mysqli_close($conn);
			header("Location: Login.php");

		}
		else
		{
			echo "Session is still  ";
		}
	

}
?>

