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
                <li><a href="../submissions/index.html">Submissions</a></li>
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
                    <li><a href="../submissions/index.html" class="menu-item active">Submissions</a></li>
                </ul>
            </div>
        </nav>
        <span class="nav-trigger" id="nav-trigger">&#9776;</span>
        <main>
            <section>
                <div class="container">


<?php
include 'connect.php';
include 'errors.php';

session_start();
$link = dbConnect("bss");

if(!$_SESSION['admin']) {
    ?>
    <div class="title">
        <h2>Access Denied</h2>
    </div>
    <?php
}
else {
    ?>
<div class="title">
    <h2>Admin</h2>
    </div>
    <div class="content">
    <?php
    var_dump($_POST);
if(isset($_POST['submit'])){
    $sql = "SELECT email FROM users";
    $query = mysqli_query($link,$sql);
    $userCount = mysqli_num_rows($query);
    echo("<br />USERS<br />");
    for($i=0;$i<$userCount;$i++) {
        $row = mysqli_fetch_assoc($query);
        // var_dump($row);
        echo('<br />');
        $user = $row['email'];
        if($_POST[preg_replace("/\./", "_", $user)]=='1'){
            echo("Adding $user\n");
            $sql = "UPDATE users
            SET editor = 1
            WHERE email = '$user'";
        }else{
            echo("Removing $user\n");
            $sql = "UPDATE users
            SET editor = 0
            WHERE email = '$user'";
        }
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error(mysql_error());
            error('A database error occurred in processing your '.
            'submission.\nIf this error persists, please '.
            'contact delosreyes17m@ncssm.edu');
        }
    }
}else{
  if ($_SESSION["admin"])
  {
      $sql = "SELECT email, editor FROM users";
      $query = mysqli_query($link,$sql);
      $userCount = mysqli_num_rows($query);
      if(!$userCount > 0)
      {
        echo("<h2>No Users</h2>");
      }

      ?>
    <form class="adminForm" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
      <?php

      echo("<table>");
        echo("<tr>");
          echo("<th>");
          echo("User Emails");
          echo("</th>");
          echo("<th>");
          echo("True");
          echo("</th>");
          echo("<th>False</th>");
        echo("</tr>");
        for($i=0;$i<$userCount;$i++)
        {
          $row = mysqli_fetch_assoc($query);
          //var_dump($row);
          echo("<tr><td>");
              echo($row['email']);
              $email = $row['email'];
            echo("</td><td>");
              if($row['editor'])
              {
                echo("<input name='$email' type='radio' value='1' checked>");
                echo("</td><td>");
                echo("<input name='$email' type='radio' value='0'>");
              } else {
                echo("<input name='$email' type='radio' value='1'>");
                echo("</td><td>");
                echo("<input name='$email' type='radio' value='0' checked>");
              }
          echo("</td></tr>");
        }
        echo("</table>"); ?>
        <input id="submitButton" type="submit" name="submit" value="Update" />
        <?php echo("</form>");

  }else{
?>

    <?php


    ?>
    <!-- I am not really sure why that form isn't in the body. Consider adding an automatic redirect. !-->
    <p>Changes submitted!</p>
    <a href="admin.php">Back</a>
    <?php
}}
?>
                    </div>
                </div>
            </section>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/mobile-nav.js"></script>
    </body>
</html>
<?php } ?>
