<?php
require_once('link.php');
session_start();
$email = ($_SESSION['user']);
$target_dir = "../images/UserImage/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir.$newfilename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

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

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $data = array();    
    $filename= $newfilename;
    $query = "UPDATE `users` SET `image` = 'images/UserImage/$filename' WHERE `email` = '$email'";
    if($result = mysqli_query($con, $query))  
    {
      $data['status'] = 201;        
      $data['newfilename']=$filename;
      echo json_encode($data);
      // $_SESSION['authenticated']=true;
    }
    else  
    {  
        $data['status'] = 601;
        $data['error'] = $con -> error;
        echo json_encode($data);
    } 
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>