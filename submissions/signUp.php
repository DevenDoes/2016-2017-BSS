<?php
include 'connect.php';
include 'errors.php';


if(!isset($_POST['signUp'])) {
    ?>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
     <input type="text" name="signUpEmail" placeholder="Your NCSSM email">
     <input type="password" name="signUpPassword" placeholder="password">
     <input type="submit" name="signUp" value="   OK   " />
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
        <p>To log in, click <a href="index.php">here</a> to return to the login
       page, and enter your new personal email and password.</p>
    </body>
    </html>
    <?php
}