<?php

//include '/Applications/MAMP/htdocs/HMS/UserFacingSide/users/account.php';

echo $_SESSION["account_name"];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$LoliVriable = "Tupiloksumotrikabiliya";
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$TheFileExtension = basename($_FILES["fileToUpload"]["name"]);
/*
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
} */
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
/*
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $finalUploadedFileName =  basename($_FILES["fileToUpload"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



// assuming file.zip is in the same directory as the executing script.
//$file = '/Applications/MAMP/htdocs/HMS/QuantCongress.zip';

// get the absolute path to $file
$path = pathinfo(realpath($target_file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open($target_file);
if ($res === TRUE) {
  // extract it to the path we determined above
  $zip->setPassword('1234567');
  $zip->extractTo($path);
  $zip->close();
  echo "Faylınız $target_file bu məkana yazılmışdır $path";
} else {
  echo "Sistem faylınızı $target_file aça bilmədi";
}




/*
$newuser = trim($user->data()->fname);
$newuser1 = trim($user->data()->lname);
echo "$newuser";
echo "$newuser1"; */

// Here in this file I can read the user's details from another file, 
// and then file the query from here automatically so that my user won't bother with the 
// uploading procedure. That is if I can. So what is ought to be done here is:
    // 1. Create the database connection
    // 2. Read the user's details from the previous file  /Applications/MAMP/htdocs/HMS/UserFacingSide/users/account.php
    // 3. Then fire the query into the DB which is supposed to store the path to the new file. Since we're going
    //  to store all user uploaded files in a static directry, then we can add that direcory as a default here,
    //  and then add the filename( that is stored in $target_file variable ).

    $fnameOfTheUser =  $_GET['fname'];
    $lnameOfTheUser = $_GET['lname'];
    echo $fnameOfTheUser;
    echo $lnameOfTheUser;


echo "$newuser";
echo "$newuser1";

echo "<button><a href=index.php?filename=".$TheFileExtension."&&fname=".$fnameOfTheUser."&&lname=".$lnameOfTheUser.">Hesaba geri qayıtmaq</a></button>";

//renaming the uploaded file into a new file extension
rename ("$path/$target_file", "$target_file.loli");
?>


