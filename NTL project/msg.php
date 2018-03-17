<?php
	if(!isset($_SESSION))
	{
		session_start();
		ob_start();
	}
   
function test_input($data)
{
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
?>

<html>
    <head>
        <title> Message System Home</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <style>

            body {
                /* The image used */
                background-image: url("pexels-photo-490411.jpeg");

                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .container{
                margin-top: 50px;
            }
            p{
                text-align: center;
                color: white;
                padding: 30px;
                font-size: 40px;
            }
         }

        </style>
    </head>
    <body >
	<?php

 if(!isset($_SESSION['session'])) 
	Header("location: 404.html");
	
else
{
$id=test_input($_REQUEST['id']);
$session=test_input($_SESSION['session']);

require_once("config.php");
		$sql="select * from coursera where session='$session'";
		$query= mysqli_query($conn,$sql);
		$row= mysqli_num_rows($query);
		$data=mysqli_fetch_array($query);
if($row == 0)
	header("Location: 404.html");

	$mail=$data['Email'];
	$sql="select * from messages where ID='$id' ";
	$query=mysqli_query($conn,$sql);
	$row= mysqli_num_rows($query);

	$data=mysqli_fetch_array($query);
	$reciever_mail=$data['reciever'];
	
	if($reciever_mail == $mail && $row > 0 )
	{
		$sql="select * from messages where ID='$id' ";
		$query=mysqli_query($conn,$sql);
		$data=mysqli_fetch_array($query);
		//echo $data['sender'] . " " . $data['content'] ; 
	}
	else 
		header("Location: 404.html");



}
mysqli_close($conn);

?>

        <div class="container ">
            <form>
                <div class="form-group row ">
                    <label for="staticEmail" class="col-sm-2 col-form-label text-white">Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext text-white" id="staticEmail" value="<?php echo $data['sender']; ?>">
                    </div>
                </div>
                <div class="form-group row ">
                    <label  class="col-sm-2 control-label text-white">Message</label>
                    <div class="col-sm-10">


                        <textarea class="form-control " rows="4"   name="inbox"  readonly> <?php echo $data['content'] ; ?> </textarea>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
