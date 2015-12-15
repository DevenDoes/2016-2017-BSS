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
                <li><a href="index.html">Submissions</a></li>
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
                    <li><a href="index.html" class="menu-item active">Submissions</a></li>
                </ul>
            </div>
        </nav>
        <span class="nav-trigger" id="nav-trigger">&#9776;</span>
        <main>
            <section>
                <div class="container">
<?php
include_once 'connect.php';
include_once 'errors.php';
//Beings the session or loads appropriate variables
session_start();
/*echo("POST\n");
var_dump($_POST);
echo("SESSION");
var_dump($_SESSION);*/

if(isset($_SESSION["loggedIn"])&& $_SESSION["loggedIn"]){
	header("Location: account.php");
}

error_reporting(0);
$userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : $_SESSION['userEmail'];
$userPass = isset($_POST['userPassword']) ? $_POST['userPassword'] : $_SESSION['userPassword'];
error_reporting(E_ALL);

//TODO: REPLACE THIS CODE WITH YOUR LOGIN PAGE. DANG IT PINTOO (former webmaster) WHY DIDN'T YOU DO YOUR WORK
if (!isset($userEmail)) {
    ?>
	<div class="title">
		<h2>Login</h2>
	</div>
	<div class="content">
		<p>You must log in to access this area of the site. If you are
		not a registered user, <a href="signUp.php">click here</a>
		to sign up</p>
		<form class="loginForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
			<table>
				<tr>
					<td class="fieldName">Email</td>
					<td class="formBox"><input type="text" name="userEmail" size="8"/></td>
				</tr>
				<tr>
					<td class="fieldName">Password</td>
					<td class="formBox"><input type="password" name="userPassword" SIZE="8"/></td>
				</tr>
			</table>
			<input id="submitButton" type="submit" value="Log in!" />
		</form>
	</div>
                
    <?php
    exit();
} else if (!isset($_SESSION['loggedIn']) && isset($userEmail)):
    //Sets the session variables of the username and password
    //TODO: Probably needs better login validation
    $link = dbConnect("Research");
    $email = mysqli_real_escape_string($link, $_POST["userEmail"]);
    $password = mysqli_real_escape_string($link, $_POST["userPassword"]);
    $_SESSION['userEmail'] = $email;
    $_SESSION['loggedIn'] = True;


    //connects to database for checking username and password

    $sql = "SELECT * FROM users WHERE
    email = '$email' AND password = PASSWORD('$password')";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        error('A database error occurred while checking your ' . 'login details.\nIfhis error persists, please ' . 'contact spencer16a@ncssm.edu');
    }

    //Username and or password is incorrect
    if (mysqli_num_rows($result) == 0) {
        unset($_SESSION['userEmail']);
        unset($_SESSION['loggedIn']);
        ?>
<<<<<<< HEAD
		<div class="title">
			<h2>Access Denied</h2>
		</div>
		<div class="content">
			<p>Your user ID or password is incorrect, or you are not a
				registered user on this site. To try logging in again, click
				<a href="<?= $_SERVER['PHP_SELF'] ?>">here</a>. To register for instant
				access, click <a href="signUp.php">here</a>.</p>
		</div>
=======
        <html>
            <!--REPLACE THE CODE HERE WITH YOUR CODE FOR THE ERROR PAGE!-->
            <body>
                <h1> Access Denied </h1>

                <p>Your user ID or password is incorrect, or you are not a
                    registered user on this site. To try logging in again, click
                    <a href="<?= $_SERVER['PHP_SELF'] ?>">here</a>. To register for instant
                    access, click <a href="signUp.php">here</a>.</p>
            </body>
        </html>
>>>>>>> origin/master
        <?php
        exit;
    }else{
		$returnval = mysqli_fetch_array($result);
		$_SESSION["editor"] = intval($returnval["editor"]);
		//error($_SESSION["editor"]);
		header("Location: account.php");
	}

endif;?>


</div>
            </section>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/mobile-nav.js"></script>
    </body>
</html>