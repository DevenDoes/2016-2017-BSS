<?php
include 'connect.php';
include 'errors.php';
include "loginPage.php";


if (isset($_POST['submit'])) {
    session_start();
    $link = dbConnect('Research');
    $directory = "../papers/";
    $fileName = basename($_FILES[paper][name]);
    error($_SESSION['userEmail']);


    if ($_FILES[paper][name] == '') {
        error('You didn\'t upload a file');
    } else if ($_POST[subject] === '') {
        error("You didn\'t specify a subject");
    }

    $sql = "INSERT INTO papers SET
         filename = '$fileName',
         subject = '$_POST[subject]',
         author = '$_SESSION[userEmail]'";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        error('A database error occurred in processing your ' . 'submission.\nIf this error persists, please ' . 'contact spencer16a@ncssm.edu');
    }

//Checks to see if file type is proper. 
    $okExtensions = array('doc', 'txt', 'docx', 'rtf', 'pdf');
    $fileName = $_FILES[paper][name];
    $fileExtension = explode('.', $fileName);

    if (in_array(strtolower(end($fileExtension)), $okExtensions)) {

        if (move_uploaded_file($_FILES['paper']['tmp_name'], $directory . $_FILES["paper"]['name'])) {
            //Completion message can remove after testing maybe
            error("Your paper has been uploaded!");
        } else {
            //Gives an error if it's not
            error("File upload incomplete");
        }
    } else {
        error("Please use an acceptable file format: .doc, .txt, .docx, .rtf or .pdf. ");
    }

} else {

    ?>
    <form class="well" id="form2" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <div class="row">
            <div id="fileContainer" class="col-md-8">
                <input type="hidden" name="MAX_FILE_SIZE" value="4194304?>"/>
                <input type='text' name='subject' placeholder="Subject"/>
                <input type="file" name="paper" class="form-control" id="file"/>
                <input type="submit" name="submit" value="   OK   "/>
            </div>
        </div>
    </form>
    <?php
}