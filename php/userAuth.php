<?php
require_once 'link.php';

if(isset($_POST['email'])){
$email = mysqli_real_escape_string($con, $_POST['email']);
$result2 = mysqli_query($con, "SELECT `package` FROM `users` WHERE `email` = '$email'");
if (mysqli_num_rows($result2) > 0) {
   while ($row = mysqli_fetch_assoc($result2)) {
      if ($row['package'] == 'paid') {
        $data['status'] = 201;
        $data['email']=$email;
        $data['userType']=$row['package'];
        echo json_encode($data);
      } else {
        $data['status'] = 601;
        $data['email']=$email;
        $data['userType']=$row['package'];
        echo json_encode($data);
   }
}
}
}else{
    $data['status'] = 701;
    echo json_encode($data);
}

?>