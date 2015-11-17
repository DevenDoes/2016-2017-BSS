<?php
include_once 'connect.php';
include_once 'errors.php';
//Beings the session or loads appropriate variables
session_start();
$userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : $_SESSION['userEmail'];
$userPass = isset($_POST['userPassword']) ? $_POST['userPassword'] : $_SESSION['userPassword'];

//TODO: REPLACE THIS CODE WITH YOUR LOGIN PAGE. DANG IT PINTOO (former webmaster) WHY DIDN'T YOU DO YOUR WORK
if (!isset($userEmail)) {
    ?>
    <!DOCTYPE html>
    <html>
        <body>
            <h1> Login Required </h1>

            <p>You must log in to access this area of the site. If you are
                not a registered user, <a href="signUp.php">click here</a>
                to sign up for instant access!</p>

            <p>

            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                Email: <input type="text" name="userEmail" size="8"/><br/>
                Password: <input type="password" name="userPassword" SIZE="8"/><br/>
                <input type="submit" value="Log in"/>
            </form>
            </p>
        </body>
    </html>
    <?php
    exit();
} else if (!isset($_SESSION['loggedIn']) && isset($userEmail)):
    //Sets the session variables of the username and password
    //TODO: Probably needs better login validation
    $link = dbConnect("Research");
    $email = mysqli_real_escape_string($link, $_POST["userEmail"]);
    $password = mysqli_real_escape_string($link, $_POST["usePassword"]);
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
        <html>
            <!REPLACE THE CODE HERE WITH YOUR CODE FOR THE ERROR PAGE>
            <body>
                <h1> Access Denied </h1>

                <p>Your user ID or password is incorrect, or you are not a
                    registered user on this site. To try logging in again, click
                    <a href="<?= $_SERVER['PHP_SELF'] ?>">here</a>. To register for instant
                    access, click <a href="signUp.php">here</a>.</p>
            </body>
        </html>
        <?php
        exit;
    }

endif;