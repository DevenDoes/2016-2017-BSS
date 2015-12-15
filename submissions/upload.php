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

<?php
include 'connect.php';
include 'errors.php';

session_start();


if(!isset($_SESSION["userEmail"])){
	header("Location: loginPage.php");
}
if (isset($_POST['submit'])) {
    session_start();
    $link = dbConnect('Research');
    $directory = "../papers/";
    $fileName = basename($_FILES["paper"]["name"]);
	
    //error($_SESSION['userEmail']);

	var_dump($_POST);
	var_dump($_SESSION);
	echo("FILES");
	var_dump($_FILES);
	//error("");

    if ($_FILES["paper"]["name"] == '') {
        error('You didn\'t upload a file');
    } else if ($_POST["subject"] === '') {
        error("You didn\'t specify a subject");
    }
	$currtime = time();
	$fileName = preg_replace("/\./", "_".$currtime.".", $fileName);
	echo($fileName);
	//error("");
	
	$subject = mysqli_real_escape_string($link, $_POST["subject"]);
	$name = mysqli_real_escape_string($link, $_POST["name"]);
    $sql = "INSERT INTO papers SET
         filename = '$fileName',
         subject = '$subject',
         author = '$_SESSION[userEmail]',
		 name = '$name',
		 time = '$currtime'";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        error('A database error occurred in processing your ' . 'submission.\nIf this error persists, please ' . 'contact spencer16a@ncssm.edu');
    }

//Checks to see if file type is proper. 
    $okExtensions = array('doc', 'txt', 'docx', 'rtf', 'pdf');
    $fileName = $_FILES["paper"]["name"];
	$fileName = preg_replace("/\./", "_".$currtime.".", $fileName);
    $fileExtension = explode('.', $fileName);

    if (in_array(strtolower(end($fileExtension)), $okExtensions)) {

        if (move_uploaded_file($_FILES['paper']['tmp_name'], $directory . $fileName)) {
            //Completion message can remove after testing maybe
			//echo("Oh hey this happens");
            
			//unset($_POST["submit"]);
			header("Location: success.php");
			?>
				<div class="content">
				<p>Awesome! Your paper uploaded!</p>
				</div>
			<?php
			//error("Your paper has been uploaded!");
        } else {
            //Gives an error if it's not
            error("File upload incomplete");
        }
    } else {
        error("Please use an acceptable file format: .doc, .txt, .docx, .rtf or .pdf. ");
    }
	//unset($_POST["submit"]);
	//header("upload.php");

} else {

    ?>
	<div class="title">
		<h2>Upload</h2>
	</div>
	<div class="content">
		<form class="loginForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="4194304?>" />
			<table>
				<tr>
					<td class="fieldName">Name</td>
					<td class="formBox"><input type="text" name="name" size="8" /></td>
				</tr>
				<tr>
					<td class="fieldName">Subject</td>
					<td class="formBox"><input type="text" name="subject" SIZE="8" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="file" name="paper" class="form-control" id="file" /></td>
				</tr>
			</table>
			<input id="submitButton" name="submit" type="submit" value="Submit" />
		</form>
		
		<p>Logged in as <?php echo($_SESSION["userEmail"]); ?><br /><a href="logout.php">Logout?</a></p>
	</div>
    <?php
}?>
</div>
            </section>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/mobile-nav.js"></script>
    </body>
</html>