<?php 
require_once("validate.php");

function test_input($data)
{
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
?>
<html>
    <head>
        <title> Send your Message </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <style>
            .container{
    margin-top: 100px;
            }
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
    <body>
        <div class="container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" > 
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text" >@</div>

                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                </div>
				<div class="form-group">
                <label for="contantMes">Contan Message</label>
                <div>
                    <textarea class="form-control" id="contantMes" name="contantMes" rows="4"></textarea>
                </div>
            </div>

            <input name="send" class="btn btn-primary btn-lg" type="submit" value="Send">
            </form>

            
        </div>
    </body>
</html>

<?php
require_once("config.php");
	if(isset($_POST['send']))
	{
		$content = test_input($_POST['contantMes']);
		$reciever= test_input($_POST['email']);
		$sql="select * from coursera where Email='$reciever' ";
		$query=mysqli_query($conn,$sql);
		$row=mysqli_num_rows($query);
		if($row ==0)
		{ 
			echo " It's Not valid email address " ;
			header ("Location: send.php");

		}
		else
		{
			$session=$_SESSION['session'];
			$sql="select * from coursera where session='$session'";
			$query= mysqli_query($conn,$sql);
			$row= mysqli_num_rows($query);
			$data=mysqli_fetch_array($query);
			$id=0;
			if($row==1)
			{
				$sender=$data['Email'];
				$id=$data['ID'];
				$sql="INSERT INTO messages (sender , reciever, content) VALUES ('$sender','$reciever','$content') " ;
				if ($conn->query($sql)==TRUE)
				{
					header ("Location: Home.php?id=$id");
				}


				
			}
		}
	}
?>

