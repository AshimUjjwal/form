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
	   $firstname= mysqli_real_escape_string($connection,$_POST['fname']);
       
	   $lastname= mysqli_real_escape_string($connection,$_POST['lname']);
	   
	   $email= mysqli_real_escape_string($connection,$_POST['email']);
	   
	   $password= mysqli_real_escape_string($connection,$_POST['password']);
	   
	   $passwordConfirm=mysqli_real_escape_string($connection,$_POST['passwordConfirm']);
	   
	   $image=$_FILES['image'] ['name'];
       
	   $tmp_image=$_FILES['image'] ['tmp_name'];
	   
	   $imageSize=$_FILES['image'] ['size'];
	   
	   $gender= isset($_POST['gender']);
	   
	   $date= date("d D,F Y");
	   
	   $keep = isset($_POST['conditions']);
	   
	   $cap= $_POST['caps'];
	   
	   $code= $_SESSION['cap_code'];
	   
	   //you can use <mark>"keep or conditions"</mark> whatever you like for agree with term and conditions feature..
	   
	    if(strlen($firstname) <3)
	    { 
        $error="First Name is too short";
        }
	    else if(strlen($lastname) <3)
	    {
	    $error="Last Name is too short";	
	    }
	    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	    {
	    $error="Please Enter valid E-mail address";
        }
		else if(email_exists($email,$connection))
		{
			$error = "Already registered with this email address";
		}
	    else if(strlen($password) <8)
	    {
	    $error="Password must be greater than 8 characters";
	    }
	    else if($password !== $passwordConfirm)
	    {
        $error="Password does not match";
	    }
	    else if($image == "") 
	    {
	    $error="Please Upload  your Image";	
	    }
		else if($imageSize > 1048576)
		{
		$error= "Image size must be less than 1 mb";	
		}
		else if($code !== $cap)
		{
			$error= "Please enter valid captcha";
		}
		
		else if(!$keep)
		{
			$error = "You must be agree with terms and conditions";
		}
		else
		{
	       $password = md5($password);
		   $imageExt= explode(".", $image);
		   $imageExtension=$imageExt[1];
		   
		   
		   if($imageExtension == 'PNG' | $imageExtension == 'png' | $imageExtension == 'JPG' | $imageExtension == 'jpg')
		   {
		     $image= rand(0,10000).rand(0,10000).rand(0,10000).time().".".$imageExtension;
		     $insertQuery = "INSERT INTO users(firstname,lastname,email,password,image,gender,date) 
			 VALUES('$firstname','$lastname','$email','$password','$image','$gender','$date')";
		     if(mysqli_query($connection, $insertQuery))
		        {
			       if(move_uploaded_file($tmp_image, "images/$image"))
			      {
				    $error= "You are successfully registered";
			      }
		        }
	   
		 
		   }
	  
           else
		   {
			   
			 $error= "File must be an image";
			   
		   }
		    
		   
	    }
	
	}

?>

   
 <!DOCTYPE html>  

 <html lang="en-us">

 <head>

 <link rel= "stylesheet" href= "sheet.css">
 
 <title>SignUp</title>
 
 </head>
 
 <body>
 
 <div id="error"><?php echo $error;?></div>
 
 <div id="wrapper">
 
 <div id= "menu">
 
 <a href= "signup.php">Create Account</a>
 
 <a href= "login.php">Log In</a>
 
 </div>
 
 <div id="formDiv">
 
 <form method="post" action="signup.php" enctype="multipart/form-data" autocomplete= "off">          
 
 <label>First Name</label><br>
 
 <input type="text" name="fname" required><br><br>
 
 <label>Last Name</label><br>
 
 <input type="text" name="lname" required><br><br>
 
 <label>E-Mail</label><br>
 
 <input type="text" name="email" required><br><br>
 
 <label>Password</label><br>
 
 <input type="password" name="password" required><br><br>
 
 <label>Re-Enter Password</label><br>
 
 <input type="password" name="passwordConfirm" required><br><br>
 
 <label>Image</label><br>
 
 <input type="file" name="image"><br><br>
 
 <label>Gender</label><br>
 
 <input type= "radio" name= "gender" value= "Male"> Male 
 
 <input type= "radio" name= "gender" value= "female"> Female <br><br>
 
 <img src= "captcha.php" required>
 
 <input type= "text" name= "caps" placeholder= "type here" required><br><br>

 <input type = "checkbox" name = "conditions">
 
 <label> I am Agree with Terms and conditions.</label><br><br>
 
  <input type="submit" name="submit" value= "Create Account"><br>
 
 </form>
 
 </div>
 
 </div>
 
 </body>
 
 </html>