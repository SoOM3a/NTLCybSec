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
                        <button name="reset" type="submit" class="btn btn-primary btn-lg btn-block login-button">Confirm</button>
                    </div>

                </form>
            </div>



        </div>
    </body>
</html>

<?php
//	ID 	Email 	L_name 	F_name 	Password 	session

require_once("config.php");
$Email="asd";
$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);

if(!isset($_POST['reset']))
{
        $code=$_GET['code'];


		$sql="select * from coursera";
		$query = mysqli_query($conn,$sql);
		$rows = @(mysqli_num_rows($query)) or die("<b>you entered wronge username or password , check your credintial</b>");
		$userna = mysqli_fetch_array($query);
		while($rows= $query->fetch_assoc())
		{
			$id=$rows['ID'];
			$email=$rows['Email'];
			$fname=$rows['F_name'];
			$lname=$rows['L_name'];
			$pass=$rows['Password'];
			$session=$rows['session'];
			if ( md5($id . $email . $fname . $lname . $pass . $session) == $code)
			{
				$Email=$row['Email'];
				break;
			}
		}
}
if(isset($_POST['reset']))
{
		
		if($Email != "")
		{
			$pass=$_POST['password'];
			$confirm=$_POST['confirm'];
			if($pass == $confirm)
			{
			 	$newpass= md5($pass);
			    $sql = "UPDATE coursera SET Password='$newpass' WHERE Email='$Email'";
				if ($conn->query($sql) === TRUE) 
				{
					
					header("Location: Login.php");
				}
				else 
					echo "ERROR FOUND "; 
			}
			else
			{
				echo "the password is not identical " ;
			}
			
		}
		else
		{
			echo "Wronge URL"; // location 404.notfound
		}
	mysqli_close($conn);
}	

?> 