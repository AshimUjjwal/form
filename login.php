<?php

    include("connect.php");
	include("functions.php");
	
	if(logged_in())
		
		{
			header("location:profile.php");
			exit();
		}
	
	 
	
    $error= "";
	
    
    if(isset($_POST['submit']))
    {
	   $email=mysqli_real_escape_string($connection,$_POST['email']);
	   $password=mysqli_real_escape_string($connection,$_POST['password']);
	   $checkBox= isset($_POST['keep']);
	   
	   if(email_exists($email,$connection))
	   
	   {
		
		
		 $result= mysqli_query($connection, "SELECT password FROM users WHERE email= '$email'");
		 $retrievepassword= mysqli_fetch_array($result);
		
		
		 if(md5($password) !==  $retrievepassword['password'])
		 {
			$error = "The password that you've entered is incorrect.";
		 }
		 else
		  
		  {
			  $_SESSION['email']= $email;
			  
			  if($checkBox == "on")
			  {
				  setcookie("email",$email,time()+3600);
			  }
			  
			  header("location:profile.php");
			  
		  }
		
		
			
		
		
		
		
		
		
		
	   }
	    
		else
		{
			$error= "The email address that you've entered doesn't match any account.";
		}
    
	   
	  }
?>

   
 <!DOCTYPE html>  
 <html lang="en-us">
 <head>
 <title>Login</title>
 
 <link rel= "stylesheet" href= "sheet.css"
 
 </head>
 <body>
 <div id="error"><?php echo $error;?></div>
 <div id="wrapper">
 <div id= "menu">
 <a href= "signup.php">Create Account</a>
 <a href= "login.php">Log In</a>
  </div>
 <div id="formDiv">
 <form method="post" action="login.php">          
 <label>E-Mail</label><br>
 <input type="text" name="email" placeholder="email" title="Email-Password" required><br><br>
 <label>Password</label><br>
 <input type="password" name="password" placeholder = "Password" required><br><br>
 
 <input type= "checkbox" name= "keep">
 
 <label>Remember me</label><br><br>
 
 
 <input type="submit" name="submit" value= "Log In">  <br>
 </form>
 </div>
 </div>
 </body>
 </html>