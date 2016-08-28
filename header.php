  <html>
  <head>
  	<title><?php echo $title; ?> | TENTT</title>
  	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  	<script type='text/javascript' src="/templates/scripts.js"></script>
    <script type='text/javascript' src='/forms.js'></script>
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="/templates/css/style.css">
  </head>
  <body>
  	<div class='topBar'>
  		<div class='container'>


        <?php if ($needTimer) {
          ?>
  			<div class="clockWrapper">
  				<div class="clock">
  			        <div class="ringWrapper">
  			            <div class="ring1">

  			            </div>
  			            <div class="ring2">

  			            </div>
  			            <div class="mask1">

  			            </div>
  			            <!-- <div class="mask2">

  			            </div> -->
  			        </div>
  			        <div class="clockDisplay">
  			            <div class="clockNums">
  			                <p class="clockNumbers">
  			                    00:00
  			                </p>
  			            </div>
  			        </div>
  			    </div>
  			</div>
        <?php } ?>
  			<div class="userInfo">
  				<div class="userText">
  					<p class="welcome">

              <?php if ($loggedIn) {
                echo "Welcome, " . $_SESSION['first_name'];
              } else {
                echo "Welcome!";
              }
              ?>
  					</p>
  					<div class="userActions">
  						<p>
                <?php if ($loggedIn) {
                  echo '<a href="#">Account</a> | <a href="/logout">Logout</a>';
                } else {
                  echo '<a href="/login">Login</a>';
                }
                ?>

  						</p>
  					</div>
  				</div>
  				<div class="avatar">

  				</div>
  			</div>
  		</div>
  	</div>
    <div class="bodyContent">
