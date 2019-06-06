<?php

    include("connect.php");
	include("functions.php");
	
	
	if(logged_in())
	{

		
	?>
	

<!DOCTYPE html>
<html>


    <head>

	<link rel = "stylesheet" href = "sheet.css">
    <title>Friendbook</title>

     </head>

<body>	 
  <div id = "wrapper">
  <a href = "changepassword.php" style="float:right; padding:5px; margin-right:20px; background-color:silver; color:black; text-decoration:none">Change Password</a><br><br>
  <a href = "logout.php" style="float:right; padding:5px; margin-right:20px; background-color:silver; color:black; text-decoration:none;">Log Out</a>
    </div>  
 
 
 
 
       </body>

</html>	   
<?php
      	  }else
    {
		
	 header("location:login.php");
	 exit();
	 
	
	}

?>