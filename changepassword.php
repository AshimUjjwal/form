<?php


   include("connect.php");
   include("functions.php");
    
	$error= "";
	
	if(isset($_POST['savepass']))
	{
		
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordConfirm'];
		
	
		if(strlen($password) < 8)
		{
			$error = "Password length must be greater than 8 characters";
		}	
	else if($password !== $confirmPassword)
	{
		$error = "Password does not matched";
	}
	else
		
		{
			$password = md5($password);
			$email = $_SESSION['email'];
			if(mysqli_query($connection, "UPDATE users SET password = '$password' WHERE email= '$email'"))
			{
				$error = "Password changed successfully, <a href='profile.php'>Click here</a> to go to profile page";
			}
		}
		
		
	}
   
   if(logged_in())
	   
	{
		   
	   ?>
	   
	   
	   
	   <!DOCTYPE hmtl>
	   
	   <head>
	   
	   <title>Change Password</title>
	   
	   <link rel = "stylesheet" href = "sheet.css">
	   
	   </head>
	   
	   <body>
	   
	   <div id = "error"><?php echo $error; ?></div>
	   
	   <div id = "wrapper">
	   
	   <div id = "formDiv">
	   
	   <form method = "post" action = "changepassword.php">
	   
	   <label>New Password</label><br>
	   <input type = "password" name = "password" required><br><br>
	   
	   <label>Re-Enter Password</label><br>
	   
	   <input type = "password" name = "passwordConfirm" required><br><br>
	   
	   <input type = "submit" name = "savepass" value = "Confirm">
	   
	   </form>
	   
	   </div>
	   
	   </div>
	   
	  
	   </body>
	   </html>
	   
	  <?php 
	   
	   }else
		   
		   {
			   header("location:profile.php");
		   }
   
   ?>
    