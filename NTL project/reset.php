<?php 
function test_input($data)
{
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
if(!isset($_SESSION))
	{
		session_start();
		ob_start();
	}
 ?>
<html>
<style>  body {
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
         }</style>
    <head>
        <title> Message System login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/registration.css">

    </head>
    <body>



        <div class="container">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title center">
                        <h1 class="title">Reset Password</h1>

                    </div>
                </div>



            </div>

            <div class="login center">
                <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>">

					<div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button name="reset" type="submit" class="btn btn-primary btn-lg btn-block login-button">Continue</button>
                    </div>

                </form>
            </div>



        </div>
    </body>
</html>

<?php
require_once("config.php");
if(isset($_POST['reset']))
{
		$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);
		$user =  test_input($_POST['email']);
		$sql="select * from coursera where Email='$user'";
		$query = mysqli_query($conn,$sql);

		$rows = @(mysqli_num_rows($query)) or die("<b>you entered wronge username or password , check your credintial</b>");
		$userna = mysqli_fetch_array($query);
		if($rows == 1)
		{
			
			$id=$rows['ID'];
			$email=$rows['Email'];
			$fname=$rows['F_name'];
			$lname=$rows['L_name'];
			$pass=$rows['Password'];
			$session=$rows['session'];
			$HASH=md5($id . $email . $fname . $lname . $pass . $session) ;			
			$txt= "https://ntlproject.000webhostapp.com/newpass.php?code=" . $HASH ; 
			$subject = "Account Information";
			"your Password is " . $pass  . "\r\n";
			$headers = "From: admin@ntlproject.com" . "\r\n" . "CC: support@ntlproject.com";
			mail($user,$subject,$txt,$headers);
            echo "sent to " . $user; 
		}
		else
		{
			echo "Email is not found ";
		}
	mysqli_close($conn);
}	

?> 