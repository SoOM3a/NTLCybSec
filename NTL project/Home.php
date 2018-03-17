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
        <title> Message System Home</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <style>
            .container{
                margin-top: 50px;
            }
            p{
                text-align: center;
                color: white;
                padding: 30px;
                font-size: 40px;
            }
            .mes{
                color: black;
                padding-left: 30px;
            }
			body
			{
                /* The image used */
                background-image: url("pexels-photo-490411.jpeg");

                /* Full height */
                height: 100%;

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            
         
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <p> <?php
											
													$id= test_input($_REQUEST['id']);
													if(!isset($_SESSION['session']))
															Header("location: 404.html");
													else 
													{
														$session = test_input($_SESSION['session']);
														require_once("config.php"); // DB 

														
														
														
														$sql = "select * from coursera where ID = '$id' AND session ='$session'";
														$query = mysqli_query($conn,$sql);
														$rows = @(mysqli_num_rows($query)) 	or Header("location: 404.html");
														$userna = mysqli_fetch_array($query);
														if($rows == 1 )
														{
															$fname=$userna['F_name'];
															$lname=$userna['L_name'];
															$email=$userna['Email'];
															
															echo  "Welcome " . $fname ;
															// show the results 
														}
														else 
														{
															Header("location: 404.html");
														}
															mysqli_close($conn);

													}

												?>
									</p>

            </header>

            <div class="col-sm-3 col-md-3">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="send.php" class="text-white"><span class="glyphicon glyphicon-folder-close">
                            </span>Send Message</a>
                            </h4>
                        </div>

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"  class="text-white"><span class="glyphicon glyphicon-th">                           
								</span>inbox</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                            <table class="table">
							<?php
									$servername="localhost";
                                    $username="id4243436_root";
                                    $password="123456789";
                                    $dbname= "id4243436_ntl";
									$conn = new mysqli($servername, $username, $password,$dbname) or die("Connect failed: %s\n". $conn -> error);
									$session = test_input($_SESSION['session']);
						
									$sql = "select * from coursera where session ='$session'";
									$query=$conn->query($sql);
									$row=@(mysqli_num_rows($query)) or die("NOTHING TO SHOW");
									$userna= mysqli_fetch_array($query);
									$email="";
									if($row==1)
										$email=$userna['Email'];
									$sql = "select * from messages where reciever ='$email'";
									$query=mysqli_query($conn,$sql);
									while($rows= $query->fetch_assoc())
									{
											  echo  "<tr>" .
                                         "<td>"  . 
                                            "<a href='msg.php?id=" .$rows['ID'] .  "'> " .
                                               " <span> " . $rows['sender'] . "</span>" .
                                                " <div class='mes'> " . $rows['content'] . " </div>" .

                                            " </a> " . 
                                       " </td> " .
                                    "</tr>" ;
									}
									
										
									mysqli_close($conn);
			
									?>	

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="Logout.php" class="text-white"><span class="glyphicon glyphicon-user">
                            </span>Log Out</a>
                            </h4>
                        </div>

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="dump.php" class="text-white"><span class="glyphicon glyphicon-user">
                            </span>Dump DB</a>
                            </h4>
                        </div>

                    </div>

                </div>
            </div











        </div>




            <!-- jQuery CDN -->
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
            <!-- Bootstrap Js CDN -->
            <script src="js/bootstrap.min.js"></script>
    </body>
</html>