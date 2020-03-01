<?php


if (isset($_POST["login-submit"])){
  include 'dbms.php';

  $username= mysqli_real_escape_string($conn,$_POST['userName']);
  $password= mysqli_real_escape_string($conn,$_POST['passWord']);


  if(empty($username) || empty($password)){
    header("Location: index.php?error=noinfo");
    exit();
  }
  else{
    $sql = "SELECT * FROM users WHERE username= '$username'";
    $result = mysqli_query($conn,$sql);
    $resultCheck= mysqli_num_rows($result);
    if($resultCheck < 1){
      header("Location: index.php?error=nouserfound");
      exit();
    }else{
      if($row = mysqli_fetch_assoc($result)) {
        //dehashing the passWord
        $hashedPassCheck = password_verify($password,$row['password']);
        if($hashedPassCheck==false){
          header("Location: index.php?error=wrongpassword");
          exit();
        }
        elseif($hashedPassCheck == true){
          //login the user here
          session_start();
          $_SESSION['u_name']=$row['username'];
          $_SESSION['u_fname']=$row['firstname'];
          $_SESSION['u_lname']=$row['lastname'];
          $_SESSION['u_occupation']=$row['occupation'];
          $_SESSION['u_mail']=$row['email'];
          $_SESSION['role']=$row['role'];
          $_SESSION['login']='yes';



          $sql= "SELECT companyId FROM users where username ='$username'";
          $result = $conn->query($sql);
          if ($result-> num_rows >0){
            while($row = $result->fetch_assoc()){
              $myId = $row["companyId"];

            }

          }
          $sql= "SELECT adminId FROM adminNo where adminId='$myId'";
          $result = $conn->query($sql);
          $resultCheck= mysqli_num_rows($result);
           if($resultCheck <1)
          {

            header("Location: myMessageG.php?login=success");
            exit();

          }
          else{
            header("Location: mmyMessage.php?login=success");
            exit();
          }
        }
      }
    }
  }


}
else{
  header("Location: index.php");
  exit();
}
