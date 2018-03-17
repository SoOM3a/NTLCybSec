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
    <head>
        <title> Message System login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <style>
            .center{
                margin: 50%  auto;
                margin-top: 100px;
            }
            .btn-jumb{
                margin: 50px;
                text-align: center;
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
            <div class="row main">
                    <div class=" center">
                        <h1 >Message System</h1>

                    </div>
            </div>
            <div class="btn-jumb">
                <button type="button" class="btn btn-primary btn-lg  login-button" onclick=" go_login()" >login</button>
                <button type="button" class="btn btn-primary btn-lg  login-button" onclick=" go_register()">Sign up</button>

            </div>
        </div>
        <script>
            function go_login()
            {
                location.href = "Login.php";
            }
            function go_register()
            {
                location.href = "Register.php";
            }



        </script>

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
?>