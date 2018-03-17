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
                        <h1 class="title">Message System</h1>

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

                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button name="login" type="submit" class="btn btn-primary btn-lg btn-block login-button">login</button>
                    </div>
                    <a href="reset.php"><center>Reset Password</center></a>

                </form>
            </div>



        </div>
    </body>
</html>

<?php
    require_once("config.php");

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
	else
			{
			    if(isset($_POST['login']))
                    {
                		$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn ->error);
                		$user =  test_input($_POST['email']);
                		$pass =  md5(test_input($_POST['password']));
                		$sql="select * from coursera where Password='$pass' AND Email='$user'";
                		$query = mysqli_query($conn,$sql);
                
                		$rows = @(mysqli_num_rows($query)) or die("<b>you entered wronge username or password , check your credintial</b>");
                		$userna = mysqli_fetch_array($query);
                		if($rows == 1)
                		{
                			$id=$userna['ID'];
                			$fname=$userna['F_name'];
                			$lname=$userna['L_name'];
                			$email=$userna['Email'];
                			$session=md5($fname . $lname . date("h:i:sa") . $Email ) ;
                			$addsess= "UPDATE coursera SET session='$session' WHERE ID='$id'";
                			if ($conn->query($addsess)==TRUE)
                			{
                				$_SESSION['session']= $session;
                				header ("Location: Home.php?id=$id");
                				ob_end_flush();
                			}
                			else
                			{
                				echo "Session not created ";
                			}
                		}
                		else
                		{
                			echo "<b>you entered wronge username or password , check your credintial</b>";
                			//session_unset();
                			//session_destroy();
                		}
                	mysqli_close($conn);
             }	
        }
if(isset($_POST['login']))
                    {
                		$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn ->error);
                		$user =  test_input($_POST['email']);
                		$pass =  md5(test_input($_POST['password']));
                		$sql="select * from coursera where Password='$pass' AND Email='$user'";
                		$query = mysqli_query($conn,$sql);
                
                		$rows = @(mysqli_num_rows($query)) or die("<b>you entered wronge username or password , check your credintial</b>");
                		$userna = mysqli_fetch_array($query);
                		if($rows == 1)
                		{
                			$id=$userna['ID'];
                			$fname=$userna['F_name'];
                			$lname=$userna['L_name'];
                			$email=$userna['Email'];
                			$session=md5($fname . $lname . date("h:i:sa") . $Email ) ;
                			$addsess= "UPDATE coursera SET session='$session' WHERE ID='$id'";
                			if ($conn->query($addsess)==TRUE)
                			{
                				$_SESSION['session']= $session;
                				header ("Location: Home.php?id=$id");
                				ob_end_flush();
                			}
                			else
                			{
                				echo "Session not created ";
                			}
                		}
                		else
                		{
                			echo "<b>you entered wronge username or password , check your credintial</b>";
                			//session_unset();
                			//session_destroy();
                		}
                	mysqli_close($conn);
    }	

?> 