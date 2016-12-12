<?php  include '../util/main.php'; ?>
<?php include '../view/header.php'; ?>
<?php include '../login/db.php'; ?>
<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>Llama Llodge</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
body {

    font-family: Corbel, Arial, Helvetica, Verdana, sans-serif;
    font-size: 16px;
    background-image:url(background.jpg);

}
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
		 .inputs {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    background-color: #EAEAEA;
    background: -moz-linear-gradient(top, #FFF, #EAEAEA);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.0, #FFF), color-stop(1.0, #EAEAEA));
    border: 1px solid #CACACA;
    color: #444;
    margin: 0 0 25px;
    padding: 5px 9px;
    width: 260px;
}

         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
			$login = '';
			$password = '';
			
			

				/// SQL ///
				
				$query = "SELECT * FROM users WHERE ((username = :username) && (userpass = :userpass))";
				$statement = $db->prepare($query);
				if(!$statement)
				{
					exit("An error has occured. Prepared statement has failed catastrophically.");
				}
				
				$bind_results = $statement->bindValue(':username', $_SESSION['username']);
				if (!$bind_results)
				{
					exit("Failed to bind values.");
				}
				
				$bind_results = $statement->bindValue(':userpass', $_SESSION['userpass']);
				if (!$bind_results)
				{
					exit("Failed to bind values.");
				}
				
				$workQuery = $statement->execute();
				if(!$workQuery)
				{
					exit("Execution failed.");
				}
				
				$curUser = $statement -> fetch();
				$statement -> closeCursor();
				if($curUser != false)
				{
					
				}
            
				////// end of SQL //////
			
			
			
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == $row['username'] && 
                  $_POST['password'] == $row['userpass']) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = ['username'];
                  
                  echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
		 
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "inputs" 
               name = "username" placeholder = "Enter username" 
               required autofocus></br>
            <input type = "password" class = "inputs"
               name = "password" placeholder = "Enter password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
			<p>
         Click here to <a href = "logout.php" title = "Logout">log out.
		 </p>
         
      </div> 
      
   </body>
   <?php include '../view/footer.php'; ?>
</html>