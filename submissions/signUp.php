<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Submissions | Broad Street Scientific</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body class="content-page">
        <div class="mobile-nav" id="mobile-nav">
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="#">Submissions</a></li>
                <li><a href="../contest/index.html">Essay Contest</a></li>
                <li><a href="../archive/index.html">Archive</a></li>
                <li><a href="../staff/index.html">Join the Staff</a></li>
                <li><a href="../contact/index.html">Contact</a></li>
            </ul>
        </div>
        <nav>
            <div class="container">
                <ul>
                    <li>
                        <!-- TITLE ITEM -->
                        <a href="../index.html">Broad Street Scientific</a>
                    </li>
                    <!-- OTHER ITEMS - PLACE IN REVERSE ORDER
                    FROM LEFT TO RIGHT - THEY ARE FLOATED RIGHT
                    SO THIS IS NECESSARY -->
                    <li><a href="../contact/index.html" class="menu-item">Contact</a></li>
                    <li><a href="../staff/index.html" class="menu-item">Join The Staff</a></li>
                    <li><a href="../archive/index.html" class="menu-item">Archive</a></li>
                    <li><a href="../contest/index.html" class="menu-item">Essay Contest</a></li>
                    <li><a href="#" class="menu-item active">Submissions</a></li>
                </ul>
            </div>
        </nav>
        <span class="nav-trigger" id="nav-trigger">&#9776;</span>
        <main>
            <section>
                <div class="container">
                    <div class="title">
                        <h2>Sign Up</h2>
                    </div>
                    <div class="content">
<?php
include 'connect.php';
include 'errors.php';


if(!isset($_POST['signUp'])) {
    ?>
	<form class="loginForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
			<table>
				<tr>
					<td class="fieldName">Email</td>
					<td class="formBox"><input type="text" name="signUpEmail" size="8"/></td>
				</tr>
				<tr>
					<td class="fieldName">Password</td>
					<td class="formBox"><input type="password" name="signUpPassword" SIZE="8"/></td>
				</tr>
			</table>
			<input id="submitButton" type="submit" name="signUp" value="Sign up" />
		</form>
    <?php
}
else {
    //Validate and make sure all fields are set
    if ( $_POST['signUpEmail']==''
        or $_POST['signUpPassword']=='') {
        error('One or more required fields were left blank.\n'.
        'Please fill them in and try again.');
    }
    //Make sure they use an NCSSM email
    else if ((array_pop(explode('@', $_POST['signUpEmail']))) != "ncssm.edu") {
        error("Please use an ncssm email.");
    }
    //Connect to the database. Function defined in connect.php
    $link = dbConnect("Research");
    //Escape information
    $password =mysqli_real_escape_string($link, $_POST["signUpPassword"]);
    $email = mysqli_real_escape_string($link, $_POST["signUpEmail"]);
    
    // Check for existing user with the new id
    $sql = "SELECT * FROM users WHERE
    email = '$email'";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        error('A database error occurred in processing1 your '.
        'submission.\nIf this error persists, please '.
        'contact spencer16a@ncssm.edu');
    }

    //Username already exists
    if (mysqli_num_rows($result)>0) {
        error('A user already exists with your chosen userid.\n'.
        'Please try another.');
    }

    //Adding user to database
      $sql = "INSERT INTO users SET
              password = PASSWORD('$password'),
              email = '$email'";
      $result = mysqli_query($link, $sql);
    if (!$result) {
        error('A database error occurred in processing your '.
        'submission.\nIf this error persists, please '.
        'contact spencer16a@ncssm.edu');
    }
  
    ?>
    <!-- I am not really sure why that form isn't in the body. Consider adding an automatic redirect. !-->
    <body>
        <p><strong>User registration successful!</strong></p>
        <p>To log in, click <a href="loginPage.php">here</a> to return to the login
       page, and enter your new personal email and password.</p>
    </body>
    </html>
    <?php
}?>
                    </div>
				</div>
            </section>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/mobile-nav.js"></script>
    </body>
</html>