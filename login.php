<?php
$title = "Login";
require_once("db.php");
 ?>


 <html>
 <head>
 	<title>Transwestern</title>
 	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 	<script type='text/javascript' src="templates/scripts.js"></script>
 	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

     <link rel="stylesheet" type="text/css" href="templates/css/style.css">
 </head>
 <body>
 	<div class="login">
 		<div class="loginForm">
 			<img src="templates/css/assets/loginLogo.png" />



        <?php
         if ($loggedIn) {
       ?>
           <div class='middle'>
             You are logged in!<br />
             Welcome <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
             <br /><br />
             <a class='button' href='/auction'>Let's Go!</a>
           </div>

       <?php
         } else {
           if ($wrong) {  echo "<div class='middle error'>Sorry - that name / pass combo is incorrect </div"; }
       ?>




        <form action="/login" method="post">
 				<input type="text" name='email' id='loginEmail' placeholder="Email" />
 				<input type="password" name='password' id='loginPassword' placeholder="Password" />
 				<input type="submit" name="submit" id="submit" value="Log In" />
        </form>
        <?php } ?>
 		</div>



 	</div>



 </body>
 </html>
