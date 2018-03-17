<?php
if(!isset($_SESSION))
	{
		session_start();
		ob_start();
	}

function test_input($data)
{
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
        <title> Message System registration</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/registration.css">

    </head>
    <body>



        <div class="container">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title center">
                        <h1 class="title">Message System</h1>

                    </div>
                </div>



            </div>

            <div class="login center">
                <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>">

                    <div class="form-group">
                        <label for="fname" class="cols-sm-2 control-label"> First Name</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="fname" id="fname"  placeholder="Enter your First Name"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="cols-sm-2 control-label"> Last Name</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="lname" id="lname"  placeholder="Enter your Last Name"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
                            </div>
                        </div>
                    </div>

					
                    <div class="form-group ">
                        <button name="register" type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                    </div>
                    <div class="login-register">
                        <a href="Login.php">Login</a>
                    </div>
                </form>
            </div>



        </div>
    </body>
</html>

<?php 


$servername="localhost";
$username="id4243436_root";
$password="123456789";
$dbname= "id4243436_ntl";
$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);

if(isset($_SESSION['session']))
{
            $session=$_SESSION['session'];
            $sql="select * from coursera where session='$session'";
			$query= mysqli_query($conn,$sql);
			$row= mysqli_num_rows($query);
			$data=mysqli_fetch_array($query);
			$id=$data['ID'];
			if($row==1)
			    header ("Location: Home.php?id=$id");
}

if(isset($_POST['register']))
{
	$fname=test_input($_POST['fname']);
	$lname = test_input($_POST['lname']);
	$email = test_input($_POST['email']);
	$password = md5(test_input($_POST['password']));
	$confirm= md5(test_input($_POST['confirm']));
	if($password != $confirm)
		echo "the 2 password not matches ";
	else
	{
		$check= "select * from coursera where Email='$email'";
		$query = mysqli_query($conn,$check);
		$rows = @(mysqli_num_rows($query));
		if($rows > 0 )
			die("This Email is already registered");
		else 
		{
			$sql="INSERT INTO coursera (F_name, L_name, Email, Password) VALUES ('$fname','$lname','$email','$password')" ; 
			if ($conn->query($sql) === TRUE) 
			{
				echo "you have been registered ";
				echo $fname . "<br>" . $lname . "<br>" . $email . "<br>" . $password ;
				header("Location: Login.php");
			}
			else 
				echo "Error: " . $sql . "<br>" . $conn->error;
			
		}
	}

}

mysqli_close($conn);

?> 
